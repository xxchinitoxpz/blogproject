<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\PaymentType;
use App\Models\Sale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SaleController extends Controller
{
    public function showCheckoutForm()
    {
        // Obtener el usuario autenticado
        $user = Auth::user();

        // Obtener el carrito del usuario con los productos
        $cart = Cart::with('products')->where('user_id', $user->id)->first();

        // Calcular el total del carrito y los descuentos
        $cartTotal = $cart->products->sum(function ($product) {
            return $product->price * $product->pivot->quantity;
        });

        $totalDiscount = $cart->products->sum(function ($product) {
            return ($product->price * $product->pivot->quantity) * ($product->discount / 100);
        });

        $finalTotal = $cartTotal - $totalDiscount;

        // Obtener los tipos de pago desde la base de datos
        $paymentTypes = PaymentType::all();

        return view('checkout', compact('cart', 'cartTotal', 'totalDiscount', 'finalTotal', 'paymentTypes'));
    }


    public function createSale(Request $request)
    {
        // Validar la información del formulario
        $request->validate([
            'phone' => 'required|string|max:15',
            'address' => 'required|string|max:255',
            'payment_type_id' => 'required|exists:payment_types,id',
        ]);

        // Obtener el usuario autenticado
        $user = Auth::user();

        // Obtener el carrito del usuario
        $cart = Cart::with('products')->where('user_id', $user->id)->first();

        if (!$cart || $cart->products->isEmpty()) {
            return redirect()->route('checkout.form')->with('error', 'El carrito está vacío.');
        }

        // Crear una nueva venta
        $sale = Sale::create([
            'user_id' => $user->id,
            'payment_type_id' => $request->payment_type_id,
            'phone' => $request->phone,
            'address' => $request->address,
            'total' => $cart->products->sum(function ($product) {
                return $product->price * $product->pivot->quantity;
            }),
        ]);

        // Agregar productos al detalle de la venta
        foreach ($cart->products as $product) {
            $sale->products()->attach($product->id, ['quantity' => $product->pivot->quantity]);
        }

        // Vaciar el carrito del usuario
        $cart->products()->detach();

        // Redirigir a una página de confirmación o mostrar un mensaje de éxito
        return redirect()->route('home')->with('success', 'Venta creada con éxito.');
    }
}

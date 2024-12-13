<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function addToCart(Request $request)
    {
        try {
            // Verifica que el usuario esté autenticado
            $user = Auth::user();
            if (!$user) {
                return response()->json(['message' => 'Usuario no autenticado'], 401);
            }

            // Verifica si el carrito ya existe para este usuario
            $cart = Cart::firstOrCreate(['user_id' => $user->id]);

            // Obtiene el producto y verifica que exista
            $product = Product::find($request->product_id);
            if (!$product) {
                return response()->json(['message' => 'Producto no encontrado'], 404);
            }

            // Verifica si el producto ya está en el carrito
            $existingProduct = $cart->products()->where('product_id', $product->id)->first();

            if ($existingProduct) {
                // Incrementa la cantidad del producto existente en el carrito
                $cart->products()->updateExistingPivot($product->id, [
                    'quantity' => $existingProduct->pivot->quantity + ($request->quantity ?? 1)
                ]);
            } else {
                // Añade el producto al carrito con la cantidad especificada
                $cart->products()->attach($product->id, ['quantity' => $request->quantity ?? 1]);
            }

            return response()->json(['message' => 'Producto añadido al carrito con éxito']);
        } catch (\Exception $e) {
            // Devuelve un mensaje de error y el código 500
            return response()->json(['message' => 'Ocurrió un error inesperado: ' . $e->getMessage()], 500);
        }
    }
    public function getCartProducts()
    {
        // Verifica si el usuario está autenticado
        $user = Auth::user();
        if (!$user) {
            return response()->json(['message' => 'Usuario no autenticado'], 401);
        }

        // Obtiene el carrito del usuario con los productos
        $cart = Cart::with('products')->where('user_id', $user->id)->first();

        if (!$cart) {
            return response()->json(['message' => 'Carrito vacío'], 200);
        }

        // Devuelve los productos en formato JSON
        return response()->json([
            'products' => $cart->products,
            'count' => $cart->products->sum('pivot.quantity'),
            'message' => 'Productos obtenidos con éxito',
        ]);
    }
}

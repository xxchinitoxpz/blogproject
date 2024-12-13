<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
{
    // Obtener el usuario autenticado
    $user = Auth::user();

    // Obtener las ventas del usuario con los productos relacionados
    $orders = Sale::with('products')
                  ->where('user_id', $user->id)
                  ->orderBy('created_at', 'desc')
                  ->get();

    return view('orders.index', compact('orders'));
}

}

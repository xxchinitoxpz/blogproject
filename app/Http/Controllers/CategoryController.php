<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        // Obtiene todas las categorías desde la base de datos
        $categories = Category::all();

        // Retorna la vista con las categorías
        return view('new_arrivals', compact('categories'));
    }
}

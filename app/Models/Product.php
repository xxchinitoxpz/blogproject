<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'price', 'image_path', 'category_id'];

    // Relación: Un producto pertenece a una categoría
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function carts()
{
    return $this->belongsToMany(Cart::class, 'product_cart')
                ->withPivot('quantity')
                ->withTimestamps();
}
}

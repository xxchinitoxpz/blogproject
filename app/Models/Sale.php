<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'payment_type_id',
        'phone',
        'address',
        'total'
    ];

    // Relación con Usuario
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relación con Tipo de Pago
    public function paymentType()
    {
        return $this->belongsTo(PaymentType::class);
    }

    // Relación muchos a muchos con productos
    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_sale')->withPivot('quantity');
    }
}

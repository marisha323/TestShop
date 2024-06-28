<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Basket extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_id',
        'count',
    ];

    // Определяем связь с моделью Product
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}

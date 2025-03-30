<?php

namespace App\Infrastructure\Persistance\Models;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $fillable = ['user_id'];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'cart_product')
            ->withPivot('quantity', 'unit_price');
    }
}

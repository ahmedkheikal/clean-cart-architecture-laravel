<?php

namespace App\Infrastructure\Persistance\Models;

use Illuminate\Database\Eloquent\Model;

class StockMovement extends Model
{
    protected $table = 'product_stock_movements';
    protected $fillable = ['product_id', 'quantity', 'type', 'date'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}   

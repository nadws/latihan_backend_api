<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\stockMovements;

class Product extends Model
{
    protected $fillable = [
        'name',
        'sku',
        'sell_price',
    ];
    protected $appends = ['stock'];

    public function stockMovements()
    {
        return $this->hasMany(StockMovements::class);
    }

    public function getStockAttribute()
    {
        return $this->stockMovements()->sum('quantity');
    }
}

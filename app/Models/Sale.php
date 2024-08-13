<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    protected $fillable = ['product_id', 'quantity', 'total_price', 'sale_date'];

    protected $dates = ['sale_date'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public static function getTotalSales()
    {
        return self::sum('total_price');
    }

    public static function getTodayTransactions()
    {
        return self::whereDate('sale_date', now()->toDateString())->count();
    }
}
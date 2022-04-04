<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductColor extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'id_color', 'id_product', 'price_plus', 'qty'
    ];

    protected $primaryKey = ['id_color', 'id_product'];

    protected $table = 'product_color';
    
    public $incrementing = false;

    public function color()
    {
        return $this->belongsTo(Color::class, 'id_color', 'id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'id_product', 'id');
    }
}

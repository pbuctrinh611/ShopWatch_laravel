<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'name'
    ];

    protected $table = 'color';

    public function product() {
        return $this->belongsToMany(Product::class, 'product_colors', 'id_color', 'id_product');
    }
}

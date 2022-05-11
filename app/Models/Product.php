<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'name', 'warranty', 'price', 'is_waterproof', 'glasses', 'strap', 'watch_case', 
        'image', 'image_detail', 'id_category', 'id_brand', 'description', 'status'
    ];

    protected $table = 'product';

    protected $attributes = [
        'status' => true
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'id_category', 'id');
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class, 'id_brand', 'id');
    }

    public function colors()
    {
        return $this->hasMany(ProductColor::class, 'id_product', 'id');
    }

    public function color() {
        return $this->belongsToMany(Color::class, 'product_colors', 'id_product', 'id_color');
    }

    public function displayStatus()
    {
        return $this->status ? 'Hiển thị' : 'Ẩn';
    }

    public function getBuyableIdentifier($options = null)
    {
        return $this->id;
    }

    public function getBuyableDescription($options = null)
    {
        return $this->name;
    }

    public function getBuyablePrice($options = null)
    {
        return $this->getPriceSell($options['id_color']);
    }

    public function getBuyableWeight($options = null)
    {
        return 0;
    }

    public function getPriceSell($id_color)
    {
        $price_plus = $this->colors()->where('id_color', $id_color)->first()->price_plus;
        return $this->price + $price_plus;
    }

    public function getQty($id_color)
    {
        return $this->colors()->where('id_color', $id_color)->first()->qty;
    }
}

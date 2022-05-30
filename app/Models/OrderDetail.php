<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'id_order', 'id_product', 'id_color', 'color', 'qty', 'unit_cost'
    ];

    protected $table = 'order_details';

    public function product()
    {
        return $this->belongsTo(Product::class, 'id_product', 'id');
    }

    public function getSubTotal()
    {
        return $this->qty * $this->unit_cost;
    }
}

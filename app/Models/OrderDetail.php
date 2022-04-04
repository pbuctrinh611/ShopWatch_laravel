<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'id_order', 'id_product', 'qty' , 'color', 'unit_cost'
    ];

    protected $table = 'order_detail';

    public function product()
    {
        return $this->belongsTo(Product::class, 'id_product', 'id');
    }

    public function getSubTotal()
    {
        return $this->qty * $this->unit_cost;
    }
}

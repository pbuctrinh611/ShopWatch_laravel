<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'name', 'status'
    ];

    protected $table = 'brand';

    protected $attributes = [
        'status' => true
    ];

    public function displayStatus()
    {
        return $this->status ? 'Hiển thị' : 'Ẩn';
    }
}

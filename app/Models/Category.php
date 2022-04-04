<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'name', 'status'
    ];

    protected $table = 'category';

    protected $attributes = [
        'status' => true
    ];

    public function displayStatus() {
        return $this->status ? 'Hiển thị' : 'Ẩn';
    }
}

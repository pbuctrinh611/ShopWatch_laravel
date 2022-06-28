<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    use HasFactory;
    protected $fillable = [
        'code', 'discount', 'qty', 'expiry'
    ];

    protected $table = 'promotion';

    public function user_promotion()
    {
        return $this->hasMany(UserPromotion::class, 'id_promotion', 'id');
    }

}

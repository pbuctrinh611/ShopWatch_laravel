<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Promotion;

class UserPromotion extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_user', 'id_promotion'
    ];

    protected $primaryKey = 'id';

    protected $table = 'user_promotion';

    public function promotion()
    {
        return $this->belongsTo(Promotion::class, 'id_promotion', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }
}

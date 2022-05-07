<?php

namespace App\Models;

use App\Traits\LoadImageTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Blog extends Model
{
    use HasFactory, LoadImageTrait;

    protected $fillable = [
        'title', 'content', 'image'
    ];

    protected $table = 'blog';

    public function getCreatedAtAttribute($date)
    {
        return Carbon::parse($date)->format('d/m/Y H:i:s');;
    }
}

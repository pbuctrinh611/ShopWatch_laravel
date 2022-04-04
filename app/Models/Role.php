<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;
    public const ADMIN = 1;
    public const MANAGER = 2;
    public const SALER = 3;
    public const SHIPPER = 4;
    public const CUSTOMER = 5;

    protected $fillable = [
        'name'
    ];

    protected $table = 'role';

    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'role_permission', 'id_role', 'id_permission');
    }
}

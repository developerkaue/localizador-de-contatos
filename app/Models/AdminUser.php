<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;

class AdminUser extends Model
{
    use HasFactory, HasApiTokens, Notifiable;

    protected $table = 'admin_users';

    protected $fillable = [
        'name', 'latitude', 'longitude', 'owner_id',
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable; 
use Laravel\Sanctum\HasApiTokens;
// use Illuminate\Contracts\Auth\UserProvider;
    
class SystemUser extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable=[
        'prefix',
        'name',
        'username',
        'email', 
        'password', 
        'provider',
        'picture_url',
        'token', 
        // 'provider_id',
        'provider_token',
        'unit',
        'created_by', 
        'updated_by', 
    ];

    protected $hidden = [
        'password',
        'picture_url',
    ];

    protected $casts = [
        'updated_at' => 'date',
        'created_at' => 'date',
        // 'password' => 'hashed',
    ];
    
    // public function getAuthPassword()
    // {
    //     return $this->password;
    // }
}

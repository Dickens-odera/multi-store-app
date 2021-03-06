<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;

    const DRIVER_ROLE           = 'driver';
    const ADMIN_ROLE            = 'admin';
    const CLIENT_ROLE           = 'client';
    const STORE_OWNER_ROLE      = 'store_owner';
    const FIRST_TIMER_CLIENT    = 'first_time_client';
    const REGULAR_CLIENT        = 'regular_client';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function stores(){
        return $this->hasMany(Store::class,'user_id');
    }
    public function products(){
        return $this->hasMany(Product::class, 'user_id');
    }
    public function drivers(){
        return $this->hasMany(Driver::class, 'added_by');
    }
    public function purchases(){
        return $this->hasMany(ProductPurchase::class,'user_id');
    }
}

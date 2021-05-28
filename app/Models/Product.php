<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'products';

    protected $fillable = [
        'name',
        'price',
        'description',
        'slug',
        'user_id',
        'store_id',
        'in_stock',
        'avatar'
    ];

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
    public function store(){
        return $this->belongsTo(Store::class,'store_id');
    }
}

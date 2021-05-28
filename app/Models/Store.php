<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\ProductPurchase;
use App\Models\Product;

class Store extends Model
{
    use HasFactory, SoftDeletes;

    const STATUS_ACTIVE = 'active';
    const STATUS_DEACTIVATED = 'deactivated';

    protected $table = 'stores';

    protected $fillable = [
        'name',
        'description',
        'user_id',
        'status'
    ];

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
    public function purchases(){
        return $this->hasMany(ProductPurchase::class,'store_id');
    }
    public function products(){
        return $this->hasMany(Product::class,'product_id');
    }
}

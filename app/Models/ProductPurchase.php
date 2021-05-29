<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
use App\Models\User;

class ProductPurchase extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'product_purchases';

    protected $fillable = [
        'product_id',
        'user_id',
        'qty',
        'total',
        'store_id',
        'client_type'
    ];
    
    public function customer(){
        return $this->belongsTo(User::class,'user_id');
    }

    public function product(){
        return $this->belongsTo(Product::class,'product_id');
    }
}

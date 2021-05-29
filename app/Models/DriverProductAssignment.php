<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\User;

class DriverProductAssignment extends Model
{
    use HasFactory,SoftDeletes;

    protected $table = 'driver_products';

    protected $fillable = [
        'driver_id',
        'product_id',
        'assigned_by'
    ];

    public function user(){
        return $this->belongsTo(User::class,'assigned_by');
    }
}

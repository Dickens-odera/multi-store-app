<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Driver extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'drivers';
    protected $fillable = [
        'name',
        'email',
        'phone',
        'vehicle_type',
        'added_by'
    ];

    public function vehicle(){
        return $this->hasOne(VehicleType::class,'id','vehicle_type');
    }
    public function user(){
        return $this->belongsTo(User::class,'added_by');
    }
}

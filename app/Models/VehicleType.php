<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class VehicleType extends Model
{
    use HasFactory, SoftDeletes;

    const TYPE_MORTORBIKE = 'mortorbike';
    const TYPE_CAR        = 'car';

    protected $table = 'vehicle_types';

    protected $fillable = [
        'name'
    ];
}

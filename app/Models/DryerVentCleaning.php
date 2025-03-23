<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DryerVentCleaning extends Model
{
    use HasFactory;

    protected $table = 'dryer_vent_cleanings';

    protected $primaryKey = '_id';

    protected $fillable = [
        'dryer_vent_exit_point',
        'price',
        'Created_by',
        'Updated_by',
        'Deleted_at'
    ];
}

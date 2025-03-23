<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AirDuctCleaning extends Model
{
    use HasFactory;

    protected $table = 'air_duct_cleanings';

    protected $primaryKey = '_id';

    protected $fillable = [
        'num_furnace',
        'square_footage_min',
        'square_footage_max',
        'furnace_loc_sidebyside',
        'furnace_loc_different',
        'final_price',
        'Created_by',
        'Updated_by',
        'Deleted_at'
    ];
}

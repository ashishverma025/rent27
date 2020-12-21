<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Vehicle extends Model
{
	public $timestamps = false;

    /**
     * Get the company associated with the vehicle.
     */
    public function company()
    {
        return $this->belongsTo('App\Company');
    }

    /**
     * Get the vehicle type associated with the vehicle.
     */
    public function vehicleType()
    {
        return $this->belongsTo('App\VehicleType');
    }
}

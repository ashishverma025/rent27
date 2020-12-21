<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DealerVehicle extends Model
{
    
    /**
     * Get the vehicle name.
     */
    public function vehicle()
    {
        return $this->belongsTo('App\Vehicle');
    }

    /**
     * Get the images for the vehicle.
     */
    public function images()
    {
        return $this->hasMany('App\DealerVehicleImage');
    }
}

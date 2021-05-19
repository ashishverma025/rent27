<?php

namespace App;

use DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Getquote extends Model {

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id','name', 'email', 'mobile','message','PickingUpLocation','Dropping_Off_Location','PickingUpDate','DroppingOffDate','quote_image'
    ];


}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class Dealer extends Model
{
//    use HasRoles;

    protected $guard_name = 'web';

    /**
     * Get the user that owns the phone.
    */
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}

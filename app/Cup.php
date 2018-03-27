<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cup extends Model
{
    //
	public function user()
    {
        return $this->belongsTo('App\User');
    }
	
	public function preferences()
    {
        return $this->hasMany('App\Preferences');
    }
}

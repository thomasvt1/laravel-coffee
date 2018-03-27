<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Drink extends Model
{
    //
	public function preferences()
    {
        return $this->hasMany('App\Preference');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Preference extends Model
{
    //
	public function cup()
    {
        return $this->belongsTo('App\Cup');
    }
	
	public function drink()
    {
        return $this->belongsTo('App\Drink');
    }
}

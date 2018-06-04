<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PreferenceTimes extends Model
{
    public function preference()
    {
        return $this->belongsTo('App\Preference');
    }
}

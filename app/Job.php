<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{

public function locations()
{
	 return $this->belongsTo('App\JobLocation');
}


public function images()
{
	 return $this->belongsTo('App\JobImage');
}


public function requests()
{
	 return $this->belongsTo('App\JobRequest');
}
    //
}

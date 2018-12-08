<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Poll extends Model
{
	public $timestamps = false;

	public function answers()
	{
		return $this->hasMany('App\Answer');
	}

	public function user()
	{
		return $this->belongsTo('App\User');
	}
}

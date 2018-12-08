<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
	public $timestamps = false;

	public function polls()
	{
		return $this->hasMany('App\Poll');
	}

	public function answers()
	{
		return $this->belongsToMany('App\Answer');
	}
}

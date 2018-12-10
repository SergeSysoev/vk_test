<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
	public $timestamps = false;

	protected $fillable = [
		'id',
		'first_name',
		'screen_name',
		'last_name',
		'country_id',
		'city_id',
		'sex',
		'bdate',
		'photo_50',
	];

	public function polls()
	{
		return $this->hasMany('App\Poll');
	}

	public function answers()
	{
		return $this->belongsToMany('App\Answer');
	}

	public function fullName()
	{
		return $this->first_name . ' ' . $this->last_name;
	}
}

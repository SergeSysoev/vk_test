<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
	public $timestamps = false;

	protected $fillable = ['id', 'title'];

	public function cities()
	{
		return $this->hasMany('App\City');
	}
}

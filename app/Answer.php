<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
	public $timestamps = false;

	protected $fillable = ['poll_id', 'text'];

	public function poll()
	{
		return $this->belongsTo('App\Poll');
	}

	public function users()
	{
		return $this->belongsToMany('App\User');
	}
}

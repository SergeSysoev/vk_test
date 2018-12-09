<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    public $timestamps = false;

	protected $fillable = ['id', 'title', 'country_id'];

    public function country()
    {
    	$this->belongsTo('App\Country');
    }
}

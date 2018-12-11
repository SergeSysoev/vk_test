<?php
/**
 * Created by PhpStorm.
 * User: serge
 * Date: 12/11/18
 * Time: 5:29 PM
 */

namespace App\Http\Helpers;


class AmountHelper
{
	public static function ending($number, $after)
	{
		$cases = array (2, 0, 1, 1, 1, 2);
		return $number.' '.$after[ ($number%100>4 && $number%100<20)? 2: $cases[min($number%10, 5)] ];
	}
}
<?php

namespace App\Utils;

function detectImages($string){
	$pattern = "^<img.+>$";
	$match = preg_match($pattern, $string);
	return $match;
}
<?php 

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

// Random number
function aRand($min, $max) {
	return mt_rand($min * 100, $max * 100) / 100;
}


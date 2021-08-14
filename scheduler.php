<?php

$base_url = 'https://linggar.alfinforwork.my.id/';
// $base_url = 'http://localhost/ta-linggar-rental-mobil/';

function get($url)
{
	// persiapkan curl
	$ch = curl_init();

	// set url 
	curl_setopt($ch, CURLOPT_URL, $url); //"https://www.postman.com/collections/e5fb5a1ae2dca675a70c");

	// return the transfer as a string 
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

	// $output contains the output string 
	$output = curl_exec($ch);

	// tutup curl 
	curl_close($ch);
	return $output;
}

echo get($base_url . 'scheduler');

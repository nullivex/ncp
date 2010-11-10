<?php

date_default_timezone_set('America/Chicago');

function auth($username,$password){
	return array(
		'api_username'	=>	urlencode($username),
		'api_password'	=>	urlencode($password)
	);
}

function send($url,$data,$post=false){

	$curl = curl_init();

	//Enable Redirection/Cookies
	curl_setopt($curl, CURLOPT_FOLLOWLOCATION,true);
	
	//Disable SSL Verification
	curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);

	//Return Data
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

	if($post){
		$post_data = prepare($data,true);
		print_r($post_data);
		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_POST, 1);
		curl_setopt($curl,CURLOPT_POSTFIELDS,$post_data);
	} else {
		$get_data = $url.prepare($data);
		print_r($get_data);
		curl_setopt($curl, CURLOPT_URL, $get_data);
	}

	return curl_exec($curl);

}

function prepare($data,$post=false){
	$out = '';
	foreach($data as $name => $val){
		if($post) $inc = isset($inc) ? '&' : '';
		else $inc = isset($inc) ? '&' : '?';
		$out .= $inc.$name.'='.urlencode($val);
	}
	return $out;
}

<?php
/*
 * NCP - Nginx Control Panel
 *
 * Light, sturdy, stupid simple
 *
 * (c) Nullivex LLC, All Rights Reserved.
 */

function apiCreds($data){
        if(!isset($data['api_username'])) throw new Exception("api: user not found");
        if(!isset($data['api_password'])) throw new Exception("api: password not found");
        return array($data['api_username'],$data['api_password']);
}

function apiAuth($username,$password){
	if(!Config::get('api','enabled')) throw new Exception("api: api disabled");
	if($username != Config::get('api','username')) throw new Exception("api: username invalid");
	if($password != Config::get('api','password')) throw new Exception("api: password invalid");
}

function apiError($msg){
	echo trim($msg);
	exit;
}

function apiOutput($out){
	echo trim($out);
	flush();
}

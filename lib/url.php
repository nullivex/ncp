<?php
/*
 * NCP - Nginx Control Panel
 *
 * Light, sturdy, stupid simple
 *
 * (c) Nullivex LLC, All Rights Reserved.
 */

define('inc','/');

class Url {
	
	static $urls = array(
		'home',
		'domains',
		'domain_create',
		'server',
		'login',
		'logout'
	);

	public static function prep(){
		return Config::get('url','url');
	}

	public static function _all(){
		$urls = array();
		foreach(self::$urls as $func){
			$urls['url_'.$func] = self::$func();
		}
		return $urls;
	}

	public static function home(){
		return self::prep().inc.'index.php';
	}

	public static function domains(){
		return self::prep().inc.'index.php?act=domains';
	}

	public static function domain_create(){
		return self::domains().'&do=create';
	}

	public static function domain_manage($domain_id){
		return self::domains().'&do=manage&domain_id='.$domain_id;
	}

	public static function server(){
		return self::prep().inc.'index.php?act=server';
	}

	public static function login(){
		return self::prep().inc.'index.php?login=true';
	}

	public static function logout(){
		return self::prep().inc.'index.php?logout=true';
	}

}

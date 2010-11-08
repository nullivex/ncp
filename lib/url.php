<?php

define('inc','/');

class Url {
	
	static $urls = array(
		'home',
		'domains',
		'domain_create',
		'config',
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

	public static function config(){
		return self::prep().inc.'index.php?act=config';
	}

	public static function login(){
		return self::prep().inc.'index.php?login=true';
	}

	public static function logout(){
		return self::prep().inc.'index.php?logout=true';
	}

}

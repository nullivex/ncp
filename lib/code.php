<?php
/*
 * NCP - Nginx Control Panel
 *
 * Light, sturdy, stupid simple
 *
 * (c) Nullivex LLC, All Rights Reserved.
 */

class Code {

	static $inst = false;

	public $path;

	public static function _get(){
		if(!self::$inst) self::$inst = new Code();
		return self::$inst;
	}

	public function setPath($path){
		$this->path = $path;
		return $this;
	}

	protected function load($file){
		if(!isset($this->data[$file])) $this->data[$file] = file_get_contents($this->path.'/'.$file);
		return $this->data[$file];
	}

	public function parse($file,$params=array()){
		$data = $this->load($file);
		foreach($params as $tag => $value){
			$rule = '{'.$tag.'}';
			$data = str_ireplace($rule,$value,$data);
		}
		return $data;
	}

}


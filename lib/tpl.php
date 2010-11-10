<?php
/*
 * NCP - Nginx Control Panel
 *
 * Light, sturdy, stupid simple
 *
 * (c) Nullivex LLC, All Rights Reserved.
 */

class Tpl {

	static $inst = false;

	protected $constants;
	protected $lang;
	protected $path;
	protected $theme;
	protected $body;
	protected $tpl;
	protected $file_ext = '.tpl.php';
	protected $holder = 'tpl';
	
	protected function __construct(){
		//Void
	}
	
	public static function _get(){
		if(self::$inst === false) self::$inst = new Tpl();
		return self::$inst;
	}
	
	public function setPath($value){
		$this->path = $value;
		return $this;
	}
	
	public function setConstant($name,$value,$overwrite=true){
		
		if(isset($this->constants[$name]) && $overwrite === false){
			return false;
		}
		
		$this->constants[$name] = $value;
		return true;
		
	}
	
	public function setLang($name,$value){
		$name = "lang_".$name;
		$this->lang[$name] = $value;
	}

	public function setConstants($constants=array(),$overwrite=true){
		if(is_array($constants)){
			foreach($constants AS $name => $value){
				$this->setConstant($name,$value,$overwrite);
			}
		}
	}
	
	public function getConstant($name){
		if(isset($this->constants[$name])){
			return $this->constants[$name];
		}
		else
		{
			return false;
		}
	}
	
	public function getConstants(){
		return $this->constants;
	}
	
	public function getLang($name){
		$names = "lang_".$name;
		if(isset($this->lang[$name])){
			return $this->lang[$name];
		} else {
			return false;
		}
	}
	
	public function addToBody($html){
		$this->body .= $html;
	}
	
	public function resetBody(){
		$this->body = '';
	}
	
	public function parse($file,$section,$tags=array(),$return=false){
		
		$this->load_file($file);
		
		if(isset($this->tpl[$file][$section])){
			
			$data = $this->tpl[$file][$section];
		
			//Replace Tags
			if(is_array($tags) && count($tags) > 0){
				foreach($tags AS $tag => $value){
					
					$tag = (string) strval($tag);
					$value = (string) strval($value);
					
					if(!empty($tag)){
						$rule = '{'.$tag.'}';
						$data = str_ireplace($rule,$value,$data);
					}
					
				}
			}
			
			if($return){
				return $data;
			}
			else
			{
				$this->body .= $data;
			}
			
		}
		
		return false;
		
	}
	
	protected function load_file($file){
		
		if(!isset($this->tpl[$file])){
			include($this->path.'/'.$file.$this->file_ext);
			$holder = $this->holder;
			if(isset($$holder)){
				$this->tpl[$file] = $$holder;
			}
			else
			{
				$this->tpl[$file] = array();
			}
			unset($tpl);
		}
		
	}
	
	protected function parseConstants(){
		
		//url add
		$this->setConstants(Url::_all());
		
		//do parse
		if(is_array($this->constants) && count($this->constants) > 0){
			$constants = $this->constants;
			foreach($constants AS $tag => $value){

				$tag = (string) strval($tag);
				$value = (string) strval($value);

				if(!empty($tag)){
					$rule = '{'.$tag.'}';
					$this->body = str_ireplace($rule,$value,$this->body);
				}

			}
		}
		
	}
	
	public function initConstants(){
		
		//Template Constants
		$this->setConstant('site_name',Config::get('info','site_name'));
		$this->setConstant('uri',Config::get('url','uri'));
		$this->setConstant('url',Config::get('url','url'));
		$this->setConstant('skin_url',Config::get('tpl','theme_path'));
		$this->setConstant('ncp_version',NCP_VERSION);
		$this->setConstant('cur_year',date('Y'));
		$this->setConstant('css',Config::get('tpl','theme_path').'/css');
		$this->setConstant('js',Config::get('url','uri').'/js');
		$this->setConstant('img',Config::get('tpl','theme_path').'/img');
		$this->setconstant('alert','');

		//set delayed alerts
		if(session('delayed_alert')){
			$this->setConstant('alert',$this->getConstant('alert').session('delayed_alert'));
			session('delayed_alert','');
		}

	}
	
	public function output(){
		
		$this->parseConstants();
		$this->parseConstants(); //2nd pass for const in const
		$body = $this->body;
		$this->resetBody();
		return trim($body);

	}
	
}



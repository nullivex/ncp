<?

//this is not a config file

class Config {

	static $inst = false;
	
	public $config;

	public static function _get(){
		if(self::$inst == false) self::$inst = new Config();
		return self::$inst;
	}

	public function setConfig($config){
		$this->config = $config;
	}

	public static function set($sec,$name,$value=null){
		Config::_get()->config[$sec][$name] = $value;
	}

	public static function get($sec,$name=null){
		if($name === null){
			if(!isset(Config::_get()->config[$sec])) throw new Exception("config: sec does not exist: $sec");
			return Config::_get()->config[$sec];
		} else {
			if(!isset(Config::_get()->config[$sec][$name])) throw new Exception("config: var not found: $sec,$name");
			return Config::_get()->config[$sec][$name];
		}
	}

}

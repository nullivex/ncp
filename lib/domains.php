<?php

class Domains {

	public $db;

	public static function _get(){
		return new Domains();
	}

	public function __construct(){
		$this->db = Db::_get();
	}

	public function domainList(){
		$query = $this->db->prepare('select * from domains');
		$query->execute();
		return $query->fetchAll();
	}

	public function createParams(){
		return array(
			'domain'	=>	'',
			'root'		=>	'/var/www',
			'html'		=>	'/html',
			'is_php'	=>	'true',
			'is_ssl'	=>	'true',
			'is_php_checked'	=>	'',
			'is_ssl_checked'	=>	'',
			'is_create_user_checked'	=>	''
		);
	}

	public function create($data){

		if(!isset($data['domain'])) throw new Exception("Domain not set");
		if(!isset($data['root'])) throw new Exception("Root not set");
		if(!isset($data['html'])) throw new Exception("Html folder not set");

		//Setup Path
		$code = Code::_get()->setPath(Config::get('paths','code_nginx'));

		//Create user
		if(isset($data['is_create_user'])){
			run('useradd -m '.$this->user($data['domain']));
		}

		//Setup PHP
		$php = '';
		if(isset($data['is_php'])) $php = $code->parse('php',$data);

		//Setup SSL
		$ssl = '';
		if(isset($data['is_ssl'])) $ssl = $code->parse('ssl',$data);

		//Write Confg
		$data['php'] = $php;
		$data['ssl'] = $ssl;
		$vhost = $code->parse('vhost',$data);
		file_put_contents(Config::get('paths','vhost').'/'.$data['domain'].'.conf');
		
		//Restart Server
		run(Config::get('progs','service').' nginx restart');

	}

}

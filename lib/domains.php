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
			'username'	=>	'',
			'domain'	=>	'',
			'is_php'	=>	'true',
			'is_ssl'	=>	'true',
			'is_php_checked'	=>	'',
			'is_ssl_checked'	=>	''
		);
	}

	public function create($data){

		if(!isset($data['username'])) throw new Exception("Username not set");
		if(!isset($data['domain'])) throw new Exception("Domain not set");

		//Setup Path
		$code = Code::_get()->setPath(Config::get('paths','code_nginx'));

		//Create user
		run('useradd -m '.$data['username']);

		//Create Folders
		$data['root'] = '/home/'.$data['username'].'/'.$data['domain'];
		$data['html'] = '/public_html';
		run('mkdir -p '.$data['root'].$data['html']);
		
		//Setup PHP
		$php = '';
		if(isset($data['is_php'])) $php = $code->parse('php',$data);

		//Setup SSL
		$ssl = '';
		if(isset($data['is_ssl'])) $ssl = $code->parse('ssl',$data);
		
		//Write Config
		$data['php'] = $php;
		$data['ssl'] = $ssl;
		$vhost = $code->parse('vhost',$data);
		file_put_contents(Config::get('paths','vhost').'/'.$data['domain'].'.conf',$vhost);
		
		//Restart Server
		run(Config::get('progs','nginx_init').' restart');

	}

}

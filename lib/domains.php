<?php
/*
 * NCP - Nginx Control Panel
 *
 * Light, sturdy, stupid simple
 *
 * (c) Nullivex LLC, All Rights Reserved.
 */

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
			'ip'		=>	$_SERVER['SERVER_ADDR'],
			'port'		=>	'80',
			'is_php'	=>	'true',
			'is_ssl'	=>	'true',
			'is_php_checked'	=>	'',
			'is_ssl_checked'	=>	''
		);
	}

	public function manageParams($domain_id){
		$query = $this->db->prepare('select * from domains where domain_id = :v_domain_id limit 1');
		$query->execute(array('v_domain_id'=>$domain_id));
		$result = $query->fetch();
		if(!$result['domain_id']) throw new Exception('domain: couldnt locate domain: '.$domain_id);
		return $result;
	}

	public function paramsFromDomain($domain){
		$query = $this->db->prepare('select * from domains where domain = :v_domain limit 1');
		$query->execute(array('v_domain'=>$domain));
		$result = $query->fetch();
		if(!$result['domain_id']) throw new Exception('domain: couldnt locate domain: '.$domain);
		return $result;
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
		run('mkdir -p '.$data['root'].'/ssl');
		run('mkdir -p '.$data['root'].'/logs');
		run('chown -R '.$data['username'].':'.$data['username'].' '.$data['root']);
		
		//Setup PHP
		$php = '';
		if(isset($data['is_php'])){
			$data['is_php'] = 1;
			$php = $code->parse('php',$data);
		} else {
			$data['is_php'] = 0;
		}

		//Setup SSL
		$ssl = '';
		if(isset($data['is_ssl'])){
			$data['is_ssl'] = 1;
			$ssl = $code->parse('ssl',$data);
		} else {
			$data['is_ssl'] = 0;
		}

		if(!isset($data['ip'])) $data['ip'] = $_SERVER['SERVER_ADDR'];
		if(!isset($data['port'])) $data['port'] = 80;
		
		//Write Config
		$data['php'] = $php;
		$data['ssl'] = $ssl;
		$vhost = $code->parse('vhost',$data);
		file_put_contents(Config::get('paths','vhost').'/'.$data['domain'].'.conf',$vhost);

		//Write default file
		$default_page = $code->parse('default_page',array_merge(Tpl::_get()->getConstants(),$data));
		run('echo "'.addslashes($default_page).'" > '.$data['root'].'/'.$data['html'].'/index.html',$default_page);
		
		//Restart Server
		run(Config::get('progs','nginx_init').' restart');

		//Insert into database
		$query = $this->db->prepare("
			insert into domains (domain,username,ip,port,is_php,is_ssl)
			values (:v_domain,:v_username,:v_ip,:v_port,:v_is_php,:v_is_ssl)
		");
		$query->execute(array(
			"v_domain"		=>	$data['domain'],
			"v_username"	=>	$data['username'],
			"v_ip"			=>	$data['ip'],
			"v_port"		=>	$data['port'],
			"v_is_php"		=>	$data['is_php'],
			"v_is_ssl"		=>	$data['is_ssl']
		));

		return $this->db->lastInsertID();
		
	}

	public function edit($data){

		if(!isset($data['username'])) throw new Exception("Username not set");
		if(!isset($data['domain'])) throw new Exception("Domain not set");

		//Setup Path
		$code = Code::_get()->setPath(Config::get('paths','code_nginx'));

		//Setup Folders
		$data['root'] = '/home/'.$data['username'].'/'.$data['domain'];
		$data['html'] = '/public_html';

		//Setup PHP
		$php = '';
		if(isset($data['is_php'])){
			$data['is_php'] = 1;
			$php = $code->parse('php',$data);
		} else {
			$data['is_php'] = 0;
		}

		//Setup SSL
		$ssl = '';
		if(isset($data['is_ssl'])){
			$data['is_ssl'] = 1;
			$ssl = $code->parse('ssl',$data);
		} else {
			$data['is_ssl'] = 0;
		}

		//Write Config
		$data['php'] = $php;
		$data['ssl'] = $ssl;
		$vhost = $code->parse('vhost',$data);
		file_put_contents(Config::get('paths','vhost').'/'.$data['domain'].'.conf',$vhost);

		//Restart Server
		run(Config::get('progs','nginx_init').' restart');

		//Insert into database
		$query = $this->db->prepare("
			update domains set
			domain = :v_domain,
			username = :v_username,
			ip = :v_ip,
			port = :v_port,
			is_php = :v_is_php,
			is_ssl = :v_is_ssl
			where domain_id = :v_domain_id
		");
		$query->execute(array(
			"v_domain_id"	=>	$data['domain_id'],
			"v_domain"		=>	$data['domain'],
			"v_username"	=>	$data['username'],
			"v_ip"			=>	$data['ip'],
			"v_port"		=>	$data['port'],
			"v_is_php"		=>	$data['is_php'],
			"v_is_ssl"		=>	$data['is_ssl']
		));

		return $data['domain_id'];
		
	}

	public function delete($data){
		
		if(!isset($data['domain_id'])) throw new Exception("domain id missing");

		//Get data
		$domain = $this->manageParams($data['domain_id']);
		$domain['root'] = '/home/'.$domain['username'].'/'.$domain['domain'];

		//Remove files
		if(isset($data['files'])){
			run('rm -rf '.$domain['root']);
		}

		//Remove config
		run('rm -f '.Config::get('paths','vhost').'/'.$domain['domain'].'.conf');

		//Restart Server
		run(Config::get('progs','nginx_init').' restart');

		//Remove from database
		$query = $this->db->prepare('delete from domains where domain_id = :v_domain_id');
		$query->execute(array('v_domain_id'=>$domain['domain_id']));

		return 'success';

	}

}

<?php
/*
 * NCP - Nginx Control Panel
 *
 * Light, sturdy, stupid simple
 *
 * (c) Nullivex LLC, All Rights Reserved.
 */

class Server {

	public $db;
	public $required = array(
		"user",
		"worker_processes",
		"pid",
		"worker_connections",
		"access_log",
		"sendfile",
		"keepalive_timeout",
		"tcp_nodelay",
		"gzip",
		"gzip_disable"
	);

	public static function _get(){
		return new Server();
	}

	public function __construct(){
		$this->db = Db::_get();
	}

	public function serverParams(){
		$query = $this->db->prepare('select * from server limit 1');
		$query->execute();
		$result = $query->fetch();
		if(!$result){
			$query = $this->db->prepare('insert into server ()values()');
			$query->execute();
			$query = $this->db->prepare('select * from server limit 1');
			$query->execute();
			$result = $query->fetch();
		}
		$result['server_status'] = run(Config::get('progs','nginx_init').' status');
		return $result;
	}

	public function start(){
		run(Config::get('progs','nginx_init').' start');
	}

	public function stop(){
		run(Config::get('progs','nginx_init').' stop');
	}

	public function restart(){
		run(Config::get('progs','nginx_init').' restart');
	}

	protected function checkRequired($data){
		foreach($this->required as $req){
			if(!isset($data[$req])) throw new Exception("server: $req is required");
		}
	}

	public function edit($data){

		$this->checkRequired($data);

		$code = Code::_get()->setPath(Config::get('paths','code_nginx'));
		$server = $code->parse('server',$data);
		file_put_contents(Config::get('paths','nginx_config'),$server);

		//Restart Server
		run(Config::get('progs','nginx_init').' restart');

		//update database
		$query = $this->db->prepare("
			update server set
			user = :v_user,
			worker_processes = :v_worker_processes,
			error_log = :v_error_log,
			pid = :v_pid,
			worker_connections = :v_worker_connections,
			access_log = :v_access_log,
			sendfile = :v_sendfile,
			keepalive_timeout = :v_keepalive_timeout,
			tcp_nodelay = :v_tcp_nodelay,
			gzip = :v_gzip,
			gzip_disable = :v_gzip_disable
		");
		$query->execute(array(
			"v_user"				=>	$data['user'],
			"v_worker_processes"	=>	$data['worker_processes'],
			"v_error_log"			=>	$data['error_log'],
			"v_pid"					=>	$data['pid'],
			"v_worker_connections"	=>	$data['worker_connections'],
			"v_access_log"			=>	$data['access_log'],
			"v_sendfile"			=>	$data['sendfile'],
			"v_keepalive_timeout"	=>	$data['keepalive_timeout'],
			"v_tcp_nodelay"			=>	$data['tcp_nodelay'],
			"v_gzip"				=>	$data['gzip'],
			"v_gzip_disable"		=>	$data['gzip_disable']
		));

		return $data['domain_id'];

	}

}

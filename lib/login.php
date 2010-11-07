<?php

class Login {

	public $users;
	public $root_user;

	public static function _get($user,$root_user){
		return new Login($user,$root_user);
	}

	public function __construct($users,$root_user){
		$this->users = $users;
		$this->root_user = $root_user;
		session('login_referrer',server('HTTP_REFERER'));
	}
	
	public function check(){
		if(post('login') && get('login')) return $this->process();
		if(!isset($_SESSION['login'])){
			return $this->loginPage();
		} else {
			try {
				$this->verify();
			} catch (Exception $e){
				loginError($e->getMessage());
			}
		}
	}

	protected function verify(){
		if(!session('login_user')) throw new Exception("login: user not found");
		if(!session('login_pass')) throw new Exception("login: pass not found");
		if(!in_array(session('login_user'),array_keys($this->users))) throw new Exception('login: user doesnt exist');
		if(!$this->pass(session('login_pass'),$this->users[session('login_user')],true)) throw new Exception("login: password does not match");
	}

	public function loginPage(){
		Tpl::_get()->parse('login','page');
		output(Tpl::_get()->output());
	}

	protected function process(){
		if(!post('login')) $this->loginPage();
		try {
			$this->auth(post('username'),post('password'));
			$this->start(post('username'),post('password'));
			redirect(session('login_referer'),true);
		} catch(Exception $e){
			loginError($e->getMessage());
		}
	}

	public function auth($user,$pass){
		if(!in_array($user,array_keys($this->users))) throw new Exception('login: user not found');
		if(!$this->pass($pass,$this->users[$user])) throw new Exception('login: pass didnt match');
	}

	protected function pass($crim,$police,$md5=false){
		if(strlen($police) == 32) $md5=true;
		if($md5 && strlen($crim) != 32){
			$crim = md5($crim);
		}
		if($md5 && strlen($police) != 32){
			$police = md5($police);
		}
		if($crim != $police) return false;
		return true;
	}

	protected function start($user,$pass){
		session('login',true);
		session('login_user',$user);
		session('login_pass',md5($pass));
	}

}

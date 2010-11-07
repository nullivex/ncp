<?php

class Login {

	public $users;
	public $root_user;

	public function __construct($users,$root_user){
		$this->users = $users;
		$this->root_user = $root_user;
		session('login_referrer',server('HTTP_REFERER'));
	}
	
	public function check(){
		if(!isset($_SESSION['login'])){
			return $this->loginPage();
		} else {
			try {
				$this->verify();
			} catch (Exception $e){
				loginErrror($e->getMessage());
			}
		}
	}

	protected function verify(){
		if(!session('login_user')) throw new Exception("login: user not found");
		if(!session('login_pass')) throw new Exception("login: pass not found");
		if(!in_array(session('login_user'),array_keys($this->users))) throw new Exception('login: user doesnt exist');
		if($this->pass(session('login_pass')) != $this->pass($this->users[session('login_user')])) throw new Exception("login: password does not match");
	}

	public function loginPage(){
		Tpl::_get()->parse('login');
	}

	protected function proces(){
		if(!post('login')) $this->loginPage();
		try {
			$this->auth(post('username'),post('password'));
			redirect(session('login_referer');
		} catch(Exception $e){
			loginError($e->getMessage());
		}
	}

	public function auth($user,$pass){
		if(!in_array($user,array_keys($this->user))) throw new Exception('login: user not found');
		if(!$this->checkPass($user,$pass)) throw new Exception('login: pass didnt match');
	}
}

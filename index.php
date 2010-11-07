<?php
//ncp -- nginx control panel
//light sturdy, stupid simple

//load config
include_once('config.defaults.php');
include_once('config.php');

//load base libs
require_once('src/func.php');
require_once('lib/login.php');
require_once('lib/db.php');
require_once('lib/tpl.pho');

try {
	//load db connection
	Db::_get($config['db']);

	//do the login requirements
	Login::_get($config['users'],$config['root_user'])->check();

	$act = isset($_GET['act']) ? $_GET['act'] : '';
	switch($act){

		case 'create':
			require_once('src/create.php');		
		break;

		case 'list':
			require_once('src/list.php');
		break;

		default:
			
		break;

	}
} catch(Exception $e){
	sysError($e->getMessage());
}

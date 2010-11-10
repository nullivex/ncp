<?php
/*
 * NCP - Nginx Control Panel
 *
 * Light, sturdy, stupid simple
 *
 * (c) Nullivex LLC, All Rights Reserved.
 */

ob_start();
session_start();

//load config
include_once('../config.defaults.php');
include_once('../config.php');

//set timezone
date_default_timezone_set($config['info']['default_timezone']);

//set root path
define("ROOT",$config['paths']['ncp']);

//load base libs
require_once(ROOT.'/src/func.php');
require_once(ROOT.'/src/api.php');
require_once(ROOT.'/lib/config.php');
require_once(ROOT.'/lib/db.php');
require_once(ROOT.'/lib/code.php');
require_once(ROOT.'/lib/tpl.php');

//extra libs
require_once(ROOT.'/lib/domains.php');

//set constants
define("NCP_VERSION","0.1.0");

try {

	//load config
	Config::_get()->setConfig($config);

	//api auth
	list($username,$password) = apiCreds($_POST);
	apiAuth($username,$password);

	//load db connection
	Db::_get()->setConfig(Config::_get()->get('db'))->connect();

	//load tpl
	Tpl::_get()->setPath(Config::_get()->get('tpl','path'))->initConstants();


} catch (Exception $e){
	apiError($e->getMessage());
}

//api code will start node
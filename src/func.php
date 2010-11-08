<?php

function get($name){
	if(isset($_GET[$name])) return $_GET[$name];
	else return null;
}

function post($name){
	if(isset($_POST[$name])) return $_POST[$name];
	else return null;
}

function server($name){
	if(isset($_SERVER[$name])) return $_SERVER[$name];
	else return null;
}

function session($name,$value=false){
	if($value !== false) $_SESSION[$name] = $value;
	elseif(isset($_SESSION[$name])) return $_SESSION[$name];
	else return null;
}

function req($name){
	if(isset($_REQUEST[$name])) return $_REQUEST[$name];
	else return null;
}

function session_delete(){
	$args = func_get_args();
	foreach($args as $name) unset($_SESSION[$name]);
}

function sysError($msg){
	error($msg);
}

function error($msg){
	echo '<h1>System Error</h1>';
	echo '<p>'.$msg.'</p>';
}

function loginError($msg){
	echo '<div>'.$msg.'</div>';
}

function page_header(){
	Tpl::_get()->parse('header','header');
}

function page_footer(){
	Tpl::_get()->parse('footer','footer');
}

function output($body){
	ob_end_flush();
	echo $body;
	exit;
}

function redirect($url,$meta=false,$time=2){
	if(empty($url)) $url = Config::get('url','url');	
	if(!$meta){
		header("Location: $url");
		output('');
	} else {
		$params = array(
			'url'	=>	$url,
			'time'	=>	$time
		);
		Tpl::_get()->resetBody();
		Tpl::_get()->parse('global','redirect',$params);
		output(Tpl::_get()->output());
	}
}

function run($cmd,&$return=null){
	$output = '';
	$cmd = '/bin/bash -c "/sbin/sudo '.addslashes($cmd).'"';
	exec($cmd,$output,$return);
	$output = implode("\n",$output);
	dolog($cmd.': '.$output);
	return implode("\n",$output);
}

function dolog($msg){
	$msg = date('m/d/y g:i:s').' -- '.$msg;
	$handle = fopen(Config::get('paths','log'),'a');
	fwrite($handle,$msg);
	fclose($handle);
}

function alert($msg,$success=true){
	$class = '';
	if(!$success) $class = 'failure';
	$params['class'] = $class;
	$params['message'] = $msg;
	Tpl::_get()->setConstant('alert',Tpl::_get()->getConstant('alert').Tpl::_get()->parse('global','alert',$params,true));
}


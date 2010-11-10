<?php
/*
 * NCP - Nginx Control Panel
 *
 * Light, sturdy, stupid simple
 *
 * (c) Nullivex LLC, All Rights Reserved.
 */

require_once(ROOT.'/lib/server.php');

page_header();

if(post('edit')){
	try {
		Server::_get()->edit($_POST);
		alert('server updated successfully',true,true);
		redirect(Url::server(),true);
	} catch (Exception $e){
		alert($e->getMessage(),false);
	}
}

if(post('start')){
	try {
		Server::_get()->start();
		alert('server: started succesfully',true);
	} catch (Exception $e){
		alert($e->getMessage(),false);
	}
}

if(post('stop')){
	try {
		Server::_get()->stop();
		alert('server: stopped succesfully',true);
	} catch (Exception $e){
		alert($e->getMessage(),false);
	}
}

if(post('restart')){
	try {
		Server::_get()->restart();
		alert('server: restarted succesfully',true);
	} catch (Exception $e){
		alert($e->getMessage(),false);
	}
}


$params = Server::_get()->serverParams();
$params = array_merge($params,$_POST);

$params['url_server_manage'] = Url::server();
$params['gzip_disable'] = htmlentities($params['gzip_disable']);

Tpl::_get()->parse('server','edit',$params);

page_footer();
output(Tpl::_get()->output());

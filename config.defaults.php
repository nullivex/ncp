<?php
/*
 * NCP - Nginx Control Panel
 *
 * Light, sturdy, stupid simple
 *
 * (c) Nullivex LLC, All Rights Reserved.
 */

$config = array();

//info
$config['info']['site_name'] = 'Nginx Control Panel';
$config['info']['default_timezone'] = 'America/Chicago';

//authentication setup
$config['users'] = array(
	'admin'		=>	'admin'
);
$config['root_user'] = 'admin';

//url
$config['url']['url'] = '';
$config['url']['uri'] = '';

//paths
$config['paths']['ncp'] = dirname(__FILE__);
$config['paths']['vhost'] = '/etc/nginx/vhosts';
$config['paths']['nginx_config'] = '/etc/nginx/nginx.conf';
$config['paths']['code_nginx'] = $config['paths']['ncp'].'/code/nginx';
$config['paths']['log'] = $config['paths']['ncp'].'/logs/ncp.log';

//progs
$config['progs']['service'] = '/usr/bin/service';
$config['progs']['sudo'] = '/usr/bin/sudo';
$config['progs']['nginx_init'] = '/etc/init.d/nginx';

//db
$config['db']['driver'] = 'mysql';
$config['db']['host'] = 'localhost';
$config['db']['port'] = '';
$config['db']['user'] = 'root';
$config['db']['password'] = '';
$config['db']['database'] = 'ncp';

//tpl
$config['tpl']['path'] = 'tpl';
$config['tpl']['theme_path'] = 'theme';

//api
$config['api']['enabled'] = false;
$config['api']['username'] = '';
$config['api']['password'] = '';

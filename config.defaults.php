<?php

$config = array();

//info
$config['info']['site_name'] = 'Nginx Control Panel';

//authentication setup
$config['users'] = array(
	'admin'		=>	'admin'
);
$config['root_user'] = 'admin';

//url
$config['url']['url'] = '/';
$config['url']['uri'] = '/';

//paths
$config['paths']['ncp'] = dirname(__FILE__);
$config['paths']['vhost'] = '/etc/nginx/vhosts';
$config['paths']['nginx_config'] = '/etc/nginx/nginx.conf';

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

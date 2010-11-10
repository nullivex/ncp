<?php
/*
 * NCP - Nginx Control Panel
 *
 * Light, sturdy, stupid simple
 *
 * (c) Nullivex LLC, All Rights Reserved.
 */

require_once(ROOT.'/lib/domains.php');

page_header();

if(post('create')){
	try {
		Domains::_get()->create($_POST);
		alert('domain added successfully',true,true);
		redirect(Url::domains(),true);
	} catch (Exception $e){
		alert($e->getMessage(),false);
	}
}

$params = Domains::_get()->createParams();
$params = array_merge($params,$_POST);

if(post('is_php')) $params['is_php_checked'] = 'checked="checked"';
if(post('is_ssl')) $params['is_ssl_checked'] = 'checked="checked"';

Tpl::_get()->parse('domains','create',$params);

page_footer();
output(Tpl::_get()->output());

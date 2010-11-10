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

if(post('edit')){
	try {
		Domains::_get()->edit($_POST);
		alert('domain edited successfully');
	} catch (Exception $e){
		alert($e->getMessage(),false);
	}
}

if(post('delete')){
	try {
		Domains::_get()->delete($_POST);
		alert('domain: deleted successfully',true,true);
		redirect(Url::domains(),true);
	} catch (Exception $e){
		alert($e->getMessage(),false);
	}
}

$params = Domains::_get()->manageParams($_GET['domain_id']);
$params = array_merge($params,$_POST);

if(post('is_php') || $params['is_php']) $params['is_php_checked'] = 'checked="checked"';
if(post('is_ssl') || $params['is_ssl']) $params['is_ssl_checked'] = 'checked="checked"';

$params['url_domain_manage'] = Url::domain_manage($params['domain_id']);

Tpl::_get()->parse('domains','edit',$params);

page_footer();
output(Tpl::_get()->output());

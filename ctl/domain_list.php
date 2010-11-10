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

$list = Domains::_get()->domainList();
$html = '';
foreach($list as $domain){
	$params = $domain;
	$params['php'] = $domain['is_php'] ? 'Yes' : 'No';
	$params['ssl'] = $domain['is_ssl'] ? 'Yes' : 'No';
	$params['url'] = Url::domain_manage($domain['domain_id']);
	$html .= Tpl::_get()->parse('domains','domain_row',$params,true);
}

$params['domains'] = $html;
Tpl::_get()->parse('domains','domains',$params);

page_footer();
output(Tpl::_get()->output());

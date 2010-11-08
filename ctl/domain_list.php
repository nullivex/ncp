<?php

//dirty controllers
//i think i like these better
//dunno why

require_once(ROOT.'/lib/domains.php');

page_header();

$list = Domains::_get()->domainList();
$html = '';
foreach($list as $domain){
	$html .= Tpl::_get()->parse('domains','domain_row',$domain,true);
}

$params['domains'] = $html;
Tpl::_get()->parse('domains','domains',$params);

page_footer();
output(Tpl::_get()->output());

<?php

$do = isset($_GET['do']) ? $_GET['do'] : null;

switch($do){

	case 'create':
		require_once(ROOT.'/ctl/domain_create.php');
	break;

	case 'manage':
		require_once(ROOT.'/ctl/domain_manage.php');
	break;

	case 'list':
	default:
		require_once(ROOT.'/ctl/domain_list.php');
	break;

}


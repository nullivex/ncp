<?php
/*
 * NCP - Nginx Control Panel
 *
 * Light, sturdy, stupid simple
 *
 * (c) Nullivex LLC, All Rights Reserved.
 */

require('api_common.php');

// setup vars
$data = $_POST;

// setup domains
try {
	if(!isset($data['domain_id']) && isset($data['domain'])){
		$data = array_merge(Domains::_get()->paramsFromDomain($data['domain']));
	}
	apiOutput(Domains::_get()->delete($data));
} catch (Exception $e){
	apiOutput($e->getMessage());
}


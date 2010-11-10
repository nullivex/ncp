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
	$domain_id = Domains::_get()->create($data);
	apiOutput($domain_id);
} catch (Exception $e){
	apiOutput($e->getMessage());
}


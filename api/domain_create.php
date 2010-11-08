<?php

require('api_common.php');

// setup vars
$data = $_POST;

// setup domains
try {
	$domain_id = Domains::_get()->create($data);
	api_output($domain_id);
} catch (Exception $e){
	api_output($e->getMessage());
}


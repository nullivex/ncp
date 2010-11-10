<?php

require('api_test_common.php');

$url = 'http://ncp.dev.nullivex.com:12000';
$call = '/api/domain_delete.php';
$username = 'test';
$password = 'test';

$data = array(
        'domain'        =>      'test.dev.nullivex.com',
        'files'         =>      'true'
);

echo send($url.$call,array_merge(auth($username,$password),$data),true);
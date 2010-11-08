<?php

$tpl = array();

$tpl['header'] = <<<HTML
<html>
<head>
<title>{site_name}</title>
<link rel="stylesheet" type="text/css" href="{css}/main.css" />
</head>
<body>
<h1>{site_name}</h1>
<div class="nav">
	<a href="{url_home}">Home</a>
	<a href="{url_domains}">Domains</a>
	<a href="{url_config}">Configuration</a>
	<a href="{url_logout}">Logout</a>
</div>
{alert}
<div class="content">
HTML;

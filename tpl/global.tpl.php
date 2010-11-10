<?php
/*
 * NCP - Nginx Control Panel
 *
 * Light, sturdy, stupid simple
 *
 * (c) Nullivex LLC, All Rights Reserved.
 */

$tpl = array();

$tpl['redirect'] = <<<HTML
<html>
<head>
<title>Redirecting Page - {site_name}</title>
<meta http-equiv="refresh" content="{time};url={url}" />
</head>
<body>
<h1>Redirecting Page - {site_name}</h1>
<p>If you are not redirected <a href="{url}">Click Here</a></p>
</body>
</html>
HTML;

$tpl['alert'] = <<<HTML
	<div class="alert {class}">
		<p>{message}</p>
	</div>
HTML;

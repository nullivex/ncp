<?php

$tpl = array();

$tpl['redirect'] = <<<HTML
<html>
<head>
<title>Redirecting Page - {site_name}</title>
<meta http-equiv="refresh" content="{time};url={url}" />
</head>
<body>
<h1>Redirecting Page - {site_name}</title>
<p>If you are not redirected <a href="{url}">Click Here</a></p>
</body>
</html>
HTML;

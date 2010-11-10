<?php
/*
 * NCP - Nginx Control Panel
 *
 * Light, sturdy, stupid simple
 *
 * (c) Nullivex LLC, All Rights Reserved.
 */

$tpl = array();

$tpl['page'] = <<<HTML
<html>
<head>
<title>Login to {site_name}</title>
<link rel="stylesheet" type="text/css" href="{css}/main.css" />
</head>
<body>
<h1>Login to {site_name}</h1>
{alert}
<form action="{url_login}" method="post">
<input type="hidden" name="login" value="true" />
<div>Username</div>
<div><input type="text" name="username" value="" /></div>
<div>Password</div>
<div><input type="password" name="password" value="" /></div>
<div><input type="submit" value="Login" /></div>
</form>
<p><small>&copy; {cur_year} {site_name}; All Rights Reserved.</small></p>
</body>
</html>
HTML;

<?php

$tpl = array();

$tpl['page'] = <<<HTML
<html>
<head>
<title>Login to {site_name}</title>
</head>
<body>
<h1>Login to {site_name}</h1>
<form action="index.php?login=true" method="post">
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

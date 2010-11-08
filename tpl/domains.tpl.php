<?php

$tpl = array();

$tpl['domain_row'] = <<<HTML
		<div><a href="{url}">{domain}</a></div>
HTML;

$tpl['domains'] = <<<HTML
	<h2>Domains</h2>
	<div><a href="{url_domain_create}">Create Domain</a></div>
	<div>
		{domains}
	</div>
HTML;

$tpl['create'] = <<<HTML
	<h2>Create Domain</h2>
	<div class="form">
		<form action="{url_domain_create}" method="post">
		<input type="hidden" name="create" value="true" />
		<div>Username</div>
		<div><input type="text" name="username" value="{username}" /></div>
		<div>Domain</div>
		<div><input type="text" name="domain" value="{domain}" /></div>
		<div>
			<input type="checkbox" name="is_php" value="true" {is_php_checked} /> PHP Enabled?
		</div>
		<div>
			<input type="checkbox" name="is_ssl" value="true" {is_ssl_checked} /> SSL Enabled?
		</div>
		<div><input type="submit" value="Create" /></div>
		</form>
	</div>
HTML;

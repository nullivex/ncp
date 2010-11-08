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
		<div>Domain</div>
		<div><input type="text" name="domain" value="{domain}" /></div>
		<div>Root</div>
		<div><input type="text" name="root" value="{root}" /></div>
		<div>Html Folder</div>
		<div><input type="text" name="html" value="{html}" /></div>
		<div>
			Create User? <input type="checkbox" name="creat_user" value="true" {is_create_user_checked} />
		</div>
		<div>
			PHP Enabled? <input type="checkbox" name="is_php" value="true" {is_php_checked} />
		</div>
		<div>
			SSL Enabled? <input type="checkbox" name="is_ssl" value="true" {is_ssl_checked} />
		</div>
		<div><input type="submit" value="Create" /></div>
		</form>
	</div>
HTML;

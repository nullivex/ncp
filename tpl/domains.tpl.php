<?php
/*
 * NCP - Nginx Control Panel
 *
 * Light, sturdy, stupid simple
 *
 * (c) Nullivex LLC, All Rights Reserved.
 */

$tpl = array();

$tpl['domain_row'] = <<<HTML
	<tr>
		<td>{domain_id}</td>
		<td><a href="{url}">{domain}</a></div></td>
		<td>{username}</td>
		<td>{ip}</td>
		<td>{port}</td>
		<td>{php}</td>
		<td>{ssl}</td>
	</tr>
HTML;

$tpl['domains'] = <<<HTML
	<h2>Domains</h2>
	<div><a href="{url_domain_create}">Create Domain</a></div>
	<table cellpadding="10" cellspacing="0" class="browse">
	<tr>
		<th>ID</th>
		<th>Domain</th>
		<th>Username</th>
		<th>IP</th>
		<th>Port</th>
		<th>PHP</th>
		<th>SSL</th>
	</tr>
	{domains}
	</table>
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
		<div>IP</div>
		<div><input type="text" name="ip" value="{ip}" /></div>
		<div>Port</div>
		<div><input type="text" name="port" value="{port}" /></div>
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

$tpl['edit'] = <<<HTML
	<h2>Edit Domain</h2>
	<div class="form">
		<form action="{url_domain_manage}" method="post">
		<input type="hidden" name="edit" value="true" />
		<input type="hidden" name="domain_id" value="{domain_id}" />
		<div>Username</div>
		<div><input type="text" name="username" value="{username}" readonly="readonly" /></div>
		<div>Domain</div>
		<div><input type="text" name="domain" value="{domain}" readonly="readonly" /></div>
		<div>IP</div>
		<div><input type="text" name="ip" value="{ip}" /></div>
		<div>Port</div>
		<div><input type="text" name="port" value="{port}" /></div>
		<div>
			<input type="checkbox" name="is_php" value="true" {is_php_checked} /> PHP Enabled?
		</div>
		<div>
			<input type="checkbox" name="is_ssl" value="true" {is_ssl_checked} /> SSL Enabled?
		</div>
		<div><input type="submit" value="Create" /></div>
		</form>
		<form action="{url_domain_manage}" method="post">
		<input type="hidden" name="delete" value="true" />
		<input type="hidden" name="domain_id" value="{domain_id}" />
		<div><input type="checkbox" name="files" value="1" /> Delete Files? (Cannot be undone)</div>
		<div><input type="submit" value="Delete Domain" /></div>
		</form>
	</div>
HTML;

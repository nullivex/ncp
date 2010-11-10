<?php
/*
 * NCP - Nginx Control Panel
 *
 * Light, sturdy, stupid simple
 *
 * (c) Nullivex LLC, All Rights Reserved.
 */

$tpl = array();

$tpl['edit'] = <<<HTML
	<h2>Manage Server</h2>
	<h4>Current Status</h2>
	<p>{server_status}</p>
	<h4>Power Control</h4>
	<form action="{url_server_manage}" method="post">
	<div>
		<input type="submit" name="start" value="Start" />
		<input type="submit" name="stop" value="Stop" />
		<input type="submit" name="restart" value="Restart" />
	</div>
	</form>
	<h4>Server Settings</h4>
	<div class="form">
		<form action="{url_domain_manage}" method="post">
		<input type="hidden" name="edit" value="true" />
		<input type="hidden" name="domain_id" value="{domain_id}" />
		<table cellpadding="10" cellspacing="0">
		<tr>
			<td valign="top" width="50%">
				<div>User</div>
				<div><input type="text" name="user" value="{user}" /></div>
				<div>Worker Processes</div>
				<div><input type="text" name="worker_processes" value="{worker_processes}" /></div>
				<div>Worker Connections</div>
				<div><input type="text" name="worker_connections" value="{worker_connections}" /></div>
				<div>Error Lg</div>
				<div><input type="text" name="error_log" value="{error_log}" /></div>
				<div>Access Log</div>
				<div><input type="text" name="access_log" value="{access_log}" /></div>
				<div>PID File</div>
				<div><input type="text" name="pid" value="{pid}" /></div>
			</td>
			<td valign="top" width="50%">
				<div>Sendfile</div>
				<div><input type="text" name="sendfile" value="{sendfile}" /></div>
				<div>Keepalive Timeout</div>
				<div><input type="text" name="keepalive_timeout" value="{keepalive_timeout}" /></div>
				<div>TCP No-Delay</div>
				<div><input type="text" name="tcp_nodelay" value="{tcp_nodelay}" /></div>
				<div>Gzip</div>
				<div><input type="text" name="gzip" value="{gzip}" /></div>
				<div>Gzip Disable</div>
				<div><input type="text" name="gzip_disable" value="{gzip_disable}" /></div>
			</td>
		</tr>
		</table>
		<div><input type="submit" value="Update" /></div>
		</form>
	</div>
HTML;

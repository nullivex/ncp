<?php
/*
 * NCP - Nginx Control Panel
 *
 * Light, sturdy, stupid simple
 *
 * (c) Nullivex LLC, All Rights Reserved.
 */

$do = isset($_GET['do']) ? $_GET['do'] : null;

switch($do){

        default:
                require_once(ROOT.'/ctl/server_manage.php');
        break;

}
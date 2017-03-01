<?php
/**
	Project configuration
	
	@author Pierre HUBERT 2017
*/

$config = array();

//App relative path
$config['appRelativePath'] = '/srv/gsAppleHosts';

//Web server relative path
$config['webServerRelativePath'] = "/srv/gsAppleHosts/www/";

//Key storage folder
$config['keyStorageFolder'] = "/srv/gsAppleHosts/store/";

//Enable request logging
$config['requestLogging'] = false;

//Official key server host
$config['officialKeyServerHost'] = "gs.apple.com";

//Official key server name
$host = $config['officialKeyServerDNSname'] = "gs.apple.com";

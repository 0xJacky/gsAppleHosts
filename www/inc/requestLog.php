<?php
/**
	Request logger
	
	@author Pierre HUBERT 2017
*/

//Check if request logging is enabled or not
if(!$config['requestLogging'])
	exit("Logging is disabled, please check your configuration !");

//Prepare logging
$logSource = "Log request with timestamp " . time(). " :\n";
$logSource .= "Client IP address : ".$_SERVER['REMOTE_ADDR']." \n\n";


//Get $_GET infos
ob_start();
print_r($_GET);
$logSource .= "$"."_GET informations: \n".ob_get_contents()."\n\n";
ob_end_clean();

//Get $_POST infos
ob_start();
print_r($_POST);
$logSource .= "$"."_POST informations: \n".ob_get_contents()."\n\n";
ob_end_clean();


//Get request headers informations
$logSource .= "Request headers :\n";
$headers = apache_request_headers();
foreach ($headers as $header => $value) {
	//Add value
	$logSource .= $header.": ".$value."\n";
}
$logSource .= "\nEnd of request headers \n\n";

//Brut post inputs
$brutInputs = file_get_contents("php://input");
$logSource .= "Brut inputs : \n".$brutInputs."\n -- End of brut inputs (last breakline NOT INCLUDED !)";

//Generate target
$logFileTarget = $config['webServerRelativePath']."log/".time()."-".rand(0,10000);

//Write log
file_put_contents($logFileTarget, $logSource);

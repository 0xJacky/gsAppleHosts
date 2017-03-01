<?php
/**
	gs.apple.com requests handler

	@author Pierre HUBERT 2017
*/

//Include configuration
include("config.php");

//Include functions
include("func.php");

//Log request if required
if($config['requestLogging']){
	//Include logging file
	include("requestLog.php");
}

//Check if it is a key request
if($_SERVER['REQUEST_URI'] == "/TSS/controller?action=2"){

	//Get request headers and POST content
	$postData = file_get_contents("php://input");
	$requestHeaders = apache_request_headers();

	//Sha of post data
	$dataSHA1 = sha1($postData);

	//Key storage folder
	$storageFolder = $config['keyStorageFolder'].$dataSHA1."/";

	//Check folder existence
	if(!file_exists($storageFolder)){
		//Create folder
		mkdir($storageFolder);
	}

	//Check if we have already a key in store
	if(!file_exists($storageFolder."responseData")){

		//Save request headers
		$requestHeadersText = "";
		foreach ($requestHeaders as $header => $value) {
			//Add value
			$requestHeadersText .= $header.": ".$value."\n";
		}
		file_put_contents($storageFolder."requestHeaders", $requestHeadersText);

		//Save request post data
		file_put_contents($storageFolder."requestData", $postData);

		//Perform $_GET request on official gs.apple.com
		$requestProtocol = "http";
		$page = "TSS/controller?action=2";
		$host = $config['officialKeyServerHost'];
		$dnsName = $config['officialKeyServerDNSname'];

		//Request
		$requestHeaders = array_merge(array(
			'Accept: */*',
			'Host: '.$dnsName,
			'Connection: Keep-Alive',
			'Content-Type: text/xml; charset="utf-8"',
			'User-Agent: InetURL/1.0',
			'Content-Length: '.strlen($postData),
			'Cache-Control: no-cache',
		));

		//Perform request on official website
		$serverResponse = postCurlRequest($requestProtocol, $page, $host, $requestHeaders, $postData);

		//Check if body is empty
		if($serverResponse['body'] == ""){
			//An error occured
			http_response_code(404);
			exit("An error occured while trying to communicate with Apple server : response empty");
		}

		//Check "SUCESS" message existence
		if(!preg_match("<SUCCESS>", $serverResponse['body'])){
			//An error occured
			http_response_code(401);
			exit("An error occured while trying to communicate with Apple server : not a success");
		}

		//Else we can save result
		//Save response headers
		file_put_contents($storageFolder."responseHeaders", $serverResponse['header']);

		//Save response data
		file_put_contents($storageFolder."responseData", $serverResponse['body']);

		//Show response body on the screen
		echo $serverResponse['body'];
	}
	else{
		//Returns previous request response
		echo file_get_contents($storageFolder."responseData");
	}

	//Quit script
	exit();
}

//Else it is an error
http_response_code(500);
echo "<b>500 : The server was unable to process your request...</b>";

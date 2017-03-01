<?php
/**
 * gs.apple.com Box functions
 *
 * @author Pierre HUBERT
 */

/**
 * Make a POST curl request
 *
 * @param String $requestProtocol Request protocol (http / https)
 * @param String $host The host of the request
 * @param String $page The page of the request
 * @param Array $headers Headers to add to the request
 * @param String $postData Data sent with the request
 * @return Array Request result
 */
function postCurlRequest($requestProtocol, $page, $host, array $headers, $postData){
	//Create request
	$curl = curl_init();

	//Setup url
	$url = $requestProtocol."://".$host."/".$page;
	curl_setopt($curl, CURLOPT_URL,$url);

	//We don't want a direct output
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($curl, CURLOPT_VERBOSE, 1);
	curl_setopt($curl, CURLOPT_HEADER, 1);

	//Setup a timeout
	curl_setopt($curl, CURLOPT_TIMEOUT, 5);

	//Set headers
	curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

	//We want a POST request
	curl_setopt($curl, CURLOPT_POST, 1);

	//Specify post data
	curl_setopt($curl, CURLOPT_POSTFIELDS, $postData);

	//Perform request
	$response = curl_exec($curl);

	//If there is an error, we quit now
	if(curl_errno($curl)){
		http_response_code(500);
		exit("Error with request: " . curl_error($curl));
	}

	//Retrieve headers
	$header_size = curl_getinfo($curl, CURLINFO_HEADER_SIZE);
	$result = array(
		"header" => substr($response, 0, $header_size),
		"body" => substr($response, $header_size)
	);

	//Close request
	curl_close($curl);

	//Return result
	return $result;
}

<?php
/**
 * gs.apple.com service
 * Service functions
 *
 * @author Pierre HUBERT
 */

/**
 * Try to login user
 *
 * @param String $username The username
 * @param String $password Password of the user
 * @return Boolean True or false depending of the success of the operation
 */
function loginUser($username, $password){
	//Check if session has been started
	if(!isset($_SESSION))
		//Start session
		session_start();
	
	if($username == "admin" AND $password == "admin"){
		//Login user
		$_SESSION['adminUser'] = array(
			"fullName" => "admin admin",
			"username" => "admin"
		);

		//Return that everything went good
		return true;
	}

	//Else login failed
	return false;
}

/**
 * Check wether a user is logged in or not
 *
 * @return Boolean True if connected
 */
function checkLogin(){
	//Check if session has been started
	if(!isset($_SESSION))
		//Start session
		session_start();

	//Check if we can get a username
	if(!isset($_SESSION['adminUser']))
		return false;

	//Else user is logged in
	return true;
}

/**
 * Logout user
 */
function logoutUser(){
	//Check if session has been started
	if(!isset($_SESSION))
		//Start session
		session_start();

	//Logout user if there is one connected
	if(isset($_SESSION['adminUser']))
		unset($_SESSION['adminUser']);
}
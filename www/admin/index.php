<?php
/**
 * gs.apple.com Box
 * Admin service
 *
 * @author Pierre HUBERT
 */

//Start session
session_start();

//Include functions
require_once("func.php");
require_once("../inc/func.php");

//Include configuration
require("../inc/config.php");

//Check if user is logged in
if(!checkLogin()){
	//Include login template
	$page = "tpl/login.tpl.php";
}
else {
	//Determine which page to open
	if(isset($_GET['page'])){
		$page = "tpl/".$_GET['page'].".tpl.php";

		if(!file_exists($page))
			$page = "tpl/404.tpl.php";
	}
	else {
		$page = "tpl/home.tpl.php";
	}
}
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!--<link rel='stylesheet' type='text/css' href='https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,400italic'> - No Google dependencie for an internal service ! -->
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/ekko-lightbox.min.css">
<!--    <link rel="stylesheet" type="text/css" href="assets/css/ekko-lightbox-dark.css"> -->
    <link rel="stylesheet" type="text/css" href="assets/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">

    <title>Admin - gs.apple.com box</title>
</head>

<body>

<header id="top">

	<div class="container-fluid">
    
        <div class="row">
        
            <div class="col-lg-4 col-md-12 site-title">
                <h1><a href="./">Admin</a></h1>
                <h2>gs.apple.com host box</h2>
                
            </div>
            
            <div class="col-lg-8 col-md-12 main-menu">
                
                <nav class="navbar navbar-light">
                  <ul class="nav navbar-nav single-page-nav">
                    <li class="nav-item">
                      <a class="nav-link external" href="./?page=home" target="_parent">Home</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link external" href="./?page=log" target="_parent">Log</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link external" href="./?page=keys" target="_parent">Keys</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link external" href="./?page=logout" target="_parent">Logout</a>
                    </li>
                  </ul>
                </nav>
              
            </div>
            
        </div>
        
        <div class="row">
            <div class="col-md-12">
            	<hr class="sigma-hr">
            </div>
        </div>

    </div>
    
</header>
            
<!-- Include page -->
<?php include($page); ?>

<footer>

	<div class="container-fluid">
    
    	<div class="row">
            <div class="col-md-12">
            	<hr class="sigma-hr">
            </div>
        </div>

        <div class="row">
        	<div class="sigma-copyright col-lg-8">
            	<p>Copyright © 2017 Pierre HUBERT</p>
            </div>
            
            <div class="sigma-copyright col-lg-4 single-page-nav text-right">
            	<p><a href="#top">Go to top</a></p>
            </div>
        </div>
        
    </div>   

</footer>

		<script src="assets/js/jquery.min.js"></script>
		<script src="assets/js/bootstrap.min.js"></script>
        <script src="assets/js/ekko-lightbox.min.js"></script>
        <script src="assets/js/jquery.singlePageNav.min.js"></script>
        <script>

            // Prevent console.log from generating errors in IE for the purposes of the demo
            if ( ! window.console ) console = { log: function(){} };

            // The actual plugin
            $('.single-page-nav').singlePageNav({
                offset: $('.single-page-nav').outerHeight(),
                filter: ':not(.external)',
                updateHash: true,
                beforeStart: function() {
                    console.log('begin scrolling');
                },
                onComplete: function() {
                    console.log('done scrolling');
                }
            });
			
			$(document).ready(function ($) {

				// delegate calls to data-toggle="lightbox"
				$(document).delegate('*[data-toggle="lightbox"]', 'click', function(event) {
					event.preventDefault();
					return $(this).ekkoLightbox({
						always_show_close: true
					});
				});

			});
			
        </script>

</body>
</html>
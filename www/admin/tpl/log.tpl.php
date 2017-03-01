<?php
/**
 * Log manager
 *
 * @author Pierre HUBERT
 */

//Check if an empty log request has been made
if(isset($_GET['empty'])){
	//Process deletion
	foreach(glob($config['webServerRelativePath']."log/*") as $file){
		unlink($file); //Delete file
	}

	//Success message
	?><script>alert("Log cleaned !");</script><?php
}

?><section id="home">

	<div class="container-fluid">

        <div class="row sigma-home single-page-nav">
        
        	<div class="col-md-offset-2 col-lg-offset-3 col-lg-6 col-md-8 col-sm-12 text-center">
            	<h1>Empty log</h1>
            	<p>Cleaning log allow to save space and/or make bug tracking easier.</p>
                <a href="./?page=log&empty" class="btn btn-success sigma-start">Empty log</a>
            </div>
            
        </div>
        
	</div>
</section>

<!-- Log listing -->
<section id="logListing">
	<div class="container-fluid">
		<div class="row">
			<p>Available logs list :</p>
			<ul><?php 
			foreach(glob("../log/*") as $file){
				echo "<li><a href='".$file."' target='_blank'>".$file."</a></li>";
			}
			?></ul>
		</div>
	</div>
</section>
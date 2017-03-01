<?php
/**
 * Login page
 *
 * @author Pierre HUBERT
 */

//Check login request
if(isset($_POST['username']) AND isset($_POST['password'])){
	//Try to login user
	if(loginUser($_POST['username'], $_POST['password'])){
		//Login sucessful
		header("Location: ./");
		exit();
	}

	//Else, show an error message
	?><section id="error" style="text-align: center; color: red;">
		Please check your username or your password !
	</section><?php
}

//Show login form
?><section id="contact">

	<div class="container-fluid">

        <div class="row sigma-section-header">
        
            <div class="sigmano col-lg-8 col-md-12">
                
                <form action="./?page=login" method="post" id="contact-form">

                <div class="col-md-6">
                	&nbsp;
                </div>

                <div class="col-md-6" style="text-align: center;">
               		<fieldset class="form-group">
                        <label for="name">Username</label>
                        <input type="text" class="form-control" name="username" id="username" placeholder="Username">
                  	</fieldset>
                  
                 
                 	<fieldset class="form-group">
                        <label for="subject">Password</label>
                        <input type="password" class="form-control" name="password" id="subject" placeholder="Password">
                  	</fieldset>
                  
                  	<button type="submit" class="btn btn-success btn-lg">Login</button>
                </div>  
            	</form>
                
            </div>
            
			<div class="col-lg-4 col-md-12">
        		&nbsp;
            </div>
        </div>
        
	</div>
    
</section>
<?php
/**
 * Log manager
 *
 * @author Pierre HUBERT
 */

//Check if an key download retry request has been performed
if(isset($_GET['retrykey'])){
	if(base64_decode($_GET['retrykey'])){
		if(file_exists(base64_decode($_GET['retrykey'])."/requestData")){
			//Save folder name
			$folderName = base64_decode($_GET['retrykey'])."/";

			//Exit if response already exists
			if(file_exists($folderName."responseData"))
				exit("Something has already been downloaded !");

			//Next, retrieve request data
			$requestData = file_get_contents($folderName."requestData");

			//Perform curl request
			$requestProtocol = "http";
			$page = "TSS/controller?action=2";
			$host = "127.0.0.1";
			$postData = $requestData;
			$headers = array(
				'Accept: */*',
				'Host: gs.apple.com',
				'Connection: Keep-Alive',
				'Content-Type: text/xml; charset="utf-8"',
				'User-Agent: InetURL/1.0',
				'Content-Length: '.strlen($postData),
				'Cache-Control: no-cache',
			);

			$dataDownload = postCurlRequest($requestProtocol, $page, $host, $headers, $postData);

		}
	}
}

?><section id="home">

	<div class="container-fluid">

        <div class="row sigma-home single-page-nav">
        
        	<div class="col-md-offset-2 col-lg-offset-3 col-lg-6 col-md-8 col-sm-12 text-center">
            	<h1>Keys manager</h1>
            	<p>Try to get keys that failed to download.</p>
            </div>
            
        </div>
        
	</div>
</section>

<!-- Log listing -->
<section id="logListing">
	<div class="container-fluid">
		<div class="row">
			<p>Available logs list : (<?php echo(count(glob($config['keyStorageFolder']."*"))); ?>)</p>
			<ul><?php 
			foreach(glob($config['keyStorageFolder']."*") as $folder){

				//Check if isset response key
				$responseExists = (file_exists($folder."/responseData") ? "yes": "<b>No</b>");

				//Give key ID in db
				echo "<li>".$folder." : OK : ".$responseExists;

				//If response is no, offer to try to download key again
				if($responseExists == "<b>No</b>"){
					echo " <a href='./?page=keys&retrykey=".base64_encode($folder)."'>Retry download</a>";
				}

				//Automaticaly download key if required
				if(isset($_GET['auto_download']) AND $responseExists == "<b>No</b>"){
					//Auto redirect in javascript
					echo "<script>location.href='./?page=keys&retrykey=".base64_encode($folder)."&auto_download';</script> Auto-download";
					
					//Remove auto_download param
					unset($_GET['auto_download']);

					exit();
				}

				//Close bullet
				echo "</li>";
			}
			?></ul>
		</div>
	</div>
</section>

<!-- Data download -->
<?php
//Check if there is data download to get
if(isset($dataDownload)){
	echo '<section id="dataDownload"> Data download : <br />';
	print_r($dataDownload);
	echo "</section>";
}

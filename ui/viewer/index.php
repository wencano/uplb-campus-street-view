<?php if(!defined("ACCESS")) die("Direct access not allowed."); 

/**
 * Viewer Page Template File
 *
 * This file contains the HTML for the viewer page. 
 */

?>
<!DOCTYPE html>
<html lang = "en">
<head>
	<meta charset = "UTF-8">
	<title>UPLB Campus Street View</title>
	<!-- Tell the browser to be responsive to screen width -->
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="target-densitydpi=device-dpi, width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no, minimal-ui" />
	<link rel="stylesheet" href="<?php echo $config->viewer_ui ?>vendor/reset.min.css">
	<link rel="stylesheet" href="<?php echo $config->assets ?>bootstrap/bootstrap.min.css" />
	<style> 
		@-ms-viewport { width: device-width; } 
	</style>
	<link rel="stylesheet" href="<?php echo $config->viewer_ui ?>css/style.css" />
	<link rel="stylesheet" href="<?php echo $config->viewer_ui ?>app.css" />
	<!--[if lt IE 9]>
	<script src="<?php echo $config->viewer_ui ?>https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
	<script src="<?php echo $config->viewer_ui ?>https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->
</head>

<body class="hold-transition skin-green sidebar-mini multiple-scenes">

	<!-- panorama goes here -->
	<div id="pano"></div>

	<div id="sceneList">
	  <ul class="scenes"></ul>
	</div>
	
	<!-- navbar -->
	<div id="titleBar">
		<h1 class="sceneNameBrand" href="<?php echo $config->root ?>">UPLB Campus Street View</h1>
		<h1 class="sceneName" href="<?php echo $config->root ?>" style="display: none;">UPLB Campus Street View</h1>
	</div>

	<a href="#" id="autorotateToggle">
		<img class="icon off" src="<?php echo $config->viewer_ui ?>img/play.png">
		<img class="icon on" src="<?php echo $config->viewer_ui ?>img/pause.png">
	</a>

	<a href="#" id="fullscreenToggle">
		<img class="icon off" src="<?php echo $config->viewer_ui ?>img/fullscreen.png">
		<img class="icon on" src="<?php echo $config->viewer_ui ?>img/windowed.png">
	</a>

	<a href="#" id="sceneListToggle">
		<img class="icon off" src="<?php echo $config->viewer_ui ?>img/expand.png">
		<img class="icon on" src="<?php echo $config->viewer_ui ?>img/collapse.png">
	</a>

	<a href="#" id="viewUp" class="viewControlButton viewControlButton-1">
		<img class="icon" src="<?php echo $config->viewer_ui ?>img/up.png">
	</a>
	<a href="#" id="viewDown" class="viewControlButton viewControlButton-2">
		<img class="icon" src="<?php echo $config->viewer_ui ?>img/down.png">
	</a>
	<a href="#" id="viewLeft" class="viewControlButton viewControlButton-3">
		<img class="icon" src="<?php echo $config->viewer_ui ?>img/left.png">
	</a>
	<a href="#" id="viewRight" class="viewControlButton viewControlButton-4">
		<img class="icon" src="<?php echo $config->viewer_ui ?>img/right.png">
	</a>
	<a href="#" id="viewIn" class="viewControlButton viewControlButton-5">
		<img class="icon" src="<?php echo $config->viewer_ui ?>img/plus.png">
	</a>
	<a href="#" id="viewOut" class="viewControlButton viewControlButton-6">
		<img class="icon" src="<?php echo $config->viewer_ui ?>img/minus.png">
	</a>
		
	
	<script src="<?php echo $config->assets ?>misc/jquery-3.3.1.min.js"></script>
	<script src="<?php echo $config->assets ?>bootstrap/bootstrap.min.js"></script>
	<script src="<?php echo $config->assets ?>marzipano/es5-shim.js"></script>
	<script src="<?php echo $config->assets ?>marzipano/eventShim.js"></script>
	<script src="<?php echo $config->assets ?>marzipano/classList.js"></script>
	<script src="<?php echo $config->assets ?>marzipano/requestAnimationFrame.js" ></script>
	<script src="<?php echo $config->assets ?>marzipano/screenfull.min.js" ></script>
	<script src="<?php echo $config->assets ?>marzipano/bowser.min.js" ></script>
	<script src="<?php echo $config->assets ?>marzipano/marzipano.js" ></script>
	
	<script src="<?php echo $config->viewer_ui ?>js/index.js"></script>
	
	
	<!-- Load Config to JS -->
	<script type="text/javascript">
		var Config = <?php echo json_encode( $config )?>;
		$(document).ready(function($){
			
			$.post( Config.api + "viewer/", {}, function(res) {
				res = JSON.parse( res ); 
				
				if(res.success && res.data ) {
					window.APP_DATA = res.data; 
					
					// List Location Scenes
					res.data.scenes.map( function(scene) {
						var sceneLink = ['<li class="text">',
															 '<a href="#" class="scene" data-id="' + scene.id + '">' + scene.name + '</a>',
															'</li>'].join('');
						$(sceneLink).appendTo( $("#sceneList ul") ); 
					});
					
					
					// Run Marzipano
					UPLBCampusStreetViewer();
				}
				
				else {
					alert("ERROR: Unable to fetch data from server.");
				}
				//}
				
				/** 
				catch(e) {
					console.log("ERROR: Unable to process data.");
				}*/
				
				
				
			});
			
			
		});
	</script>
	
</body>
</html>
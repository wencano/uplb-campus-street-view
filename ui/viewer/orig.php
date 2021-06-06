<html>
  <head>
    <title>UPLB Campus Street View</title>
		
    <meta content="">
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="viewport" content="target-densitydpi=device-dpi, width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no, minimal-ui" />
		<style> 
			@-ms-viewport { width: device-width; } 
		</style>
		<link rel="stylesheet" href="vendor/reset.min.css">
		<link rel="stylesheet" href="css/vendor/bootstrap.css">
		<link rel="stylesheet" href="css/style.css">
		<link rel="stylesheet" href="css/index.css">
	
  </head>
  
  <body class = "multiple-scenes">

	<!-- panorama goes here -->
	<div id="pano"></div>

	<div id="sceneList">
	  <ul class="scenes">
	    
	      <a href="#" class="scene" data-id="0-oblation">
	        <li class="text">Oblation Park</li>
	      </a>
	    
	      <a href="#" class="scene" data-id="1-physci">
	        <li class="text">PhySci Building</li>
	      </a>
	    
	      <a href="#" class="scene" data-id="2-physci_lobby">
	        <li class="text">ICS</li>
	      </a>
	    
	      <a href="#" class="scene" data-id="3-pslh">
	        <li class="text">PSLH A</li>
	      </a>
	    
	      <a href="#" class="scene" data-id="4-pslh-b">
	        <li class="text">PSLH B</li>
	      </a>
	    
	      <a href="#" class="scene" data-id="5-icsmh">
	        <li class="text">ICSMH</li>
	      </a>
	    
	      <a href="#" class="scene" data-id="6-icslh4">
	        <li class="text">ICSLH4</li>
	      </a>
	    
	      <a href="#" class="scene" data-id="7-ncas">
	        <li class="text">NCAS</li>
	      </a>
	    
	      <a href="#" class="scene" data-id="8-dhum">
	        <li class="text">DHUM</li>
	      </a>
	    
	      <a href="#" class="scene" data-id="9-ibs">
	        <li class="text">IBS</li>
	      </a>
	    
	      <a href="#" class="scene" data-id="10-iweplh">
	        <li class="text">IWEPLH</li>
	      </a>
	    
	      <a href="#" class="scene" data-id="11-ibslh">
	        <li class="text">IBSLH</li>
	      </a>
	    
	      <a href="#" class="scene" data-id="12-library">
	        <li class="text">Main Library</li>
	      </a>
	    
	      <a href="#" class="scene" data-id="13-mph1">
	        <li class="text">MPH1</li>
	      </a>
	    
	      <a href="#" class="scene" data-id="14-mph2">
	        <li class="text">MPH2</li>
	      </a>
	    
	      <a href="#" class="scene" data-id="15-cpark">
	        <li class="text">Carabao Park</li>
	      </a>
	    
	      <a href="#" class="scene" data-id="16-che_ocs">
	        <li class="text">CHE OCS</li>
	      </a>
	    
	      <a href="#" class="scene" data-id="17-ihnf">
	        <li class="text">IHNF</li>
	      </a>
	    
	      <a href="#" class="scene" data-id="18-math">
	        <li class="text">Math Building</li>
	      </a>
	    
	      <a href="#" class="scene" data-id="19-fpark">
	        <li class="text">Freedom Park</li>
	      </a>
	    
	      <a href="#" class="scene" data-id="20-46521791_1418074501656722_8483447058353618944_n">
	        <li class="text">CAS A2</li>
	      </a>
	    
	      <a href="#" class="scene" data-id="21-che">
	        <li class="text">CHE</li>
	      </a>
	    
	  </ul>
	</div>

		<a href="#" id="autorotateToggle">
		<img class="icon off" src="img/play.png">
		<img class="icon on" src="img/pause.png">
		</a>

		<a href="#" id="fullscreenToggle">
		<img class="icon off" src="img/fullscreen.png">
		<img class="icon on" src="img/windowed.png">
		</a>

		<a href="#" id="sceneListToggle">
		<img class="icon off" src="img/expand.png">
		<img class="icon on" src="img/collapse.png">
		</a>

		<a href="#" id="viewUp" class="viewControlButton viewControlButton-1">
		<img class="icon" src="img/up.png">
		</a>
		<a href="#" id="viewDown" class="viewControlButton viewControlButton-2">
		<img class="icon" src="img/down.png">
		</a>
		<a href="#" id="viewLeft" class="viewControlButton viewControlButton-3">
		<img class="icon" src="img/left.png">
		</a>
		<a href="#" id="viewRight" class="viewControlButton viewControlButton-4">
		<img class="icon" src="img/right.png">
		</a>
		<a href="#" id="viewIn" class="viewControlButton viewControlButton-5">
		<img class="icon" src="img/plus.png">
		</a>
		<a href="#" id="viewOut" class="viewControlButton viewControlButton-6">
		<img class="icon" src="img/minus.png">
		</a>
		
<!-- navbar -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="#"><h3>UPLB Campus Street View</h3></a>
  </nav>
	
	 

  </body>
  
	<script src="js/vendor/jquery-3.3.1.min.js"></script>
	<script src="js/vendor/bootstrap.js"></script>
	<!--script src="js/vendor/es5-shim.js"></script>
	<script src="js/vendor/eventShim.js"></script>
	<script src="js/vendor/requestAnimationFrame.js"</script>
	<script src="js/vendor/marzipano.js"></script> -->
	
  <!--script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script--> <!-- remove comment when deployed/online -->
  <script src="vendor/es5-shim.js"></script>
	<script src="vendor/eventShim.js"></script>
	<script src="vendor/classList.js"></script>
	<script src="vendor/requestAnimationFrame.js" ></script>
	<script src="vendor/screenfull.min.js" ></script>
	<script src="vendor/bowser.min.js" ></script>
	<script src="vendor/marzipano.js" ></script>

	<script src="js/data.js"></script>
	<script src="js/index.js"></script>
  
  
  

</html>

<?php if(!defined("ACCESS")) die("Direct access not allowed."); 

/**
 * Admin Page Template File
 *
 * This file contains the HTML for the admin page. 
 */

?>
<!DOCTYPE html>
<html lang = "en">
<head>
	<meta charset = "UTF-8">
	<title>Admin | UPLB Campus Street View</title>
	<!-- Tell the browser to be responsive to screen width -->
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<link rel="stylesheet" href="<?php echo $config->assets ?>bootstrap/bootstrap.min.css" />
	<link rel="stylesheet" href="<?php echo $config->assets ?>fontawesome/css/all.min.css" />
	<link rel="stylesheet" href="<?php echo $config->assets ?>marzipano/style.css" />
	<link rel="stylesheet" href="<?php echo $config->admin_ui ?>app.css" />
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->
</head>

<body class="hold-transition skin-green sidebar-mini ">
	<div id="app" class="wrapper">
		<div class="modal-open">
			<div id="init-spinner-modal" class="modal fade show" tabIndex="-1" role="dialog" aria-labelledby="myLargeModalLabel"  style="display: block;" >
				<div class="modal-dialog modal-dialog-centered" role="document" >
					<div class="modal-content text-center" style="background: transparent; color: #ffffff; border: none; font-size: 40px;  " >
						<i class="fa fa-lg fa-spinner fa-spin"></i>
					</div>
				</div>
			</div>
			<div class="modal-backdrop fade show"></div>
		</div>
	</div>
	
	
	
	<!-- React Dependencies -->
	<script src="<?php echo $config->assets ?>react/babel.min.js"></script>
	<script src="<?php echo $config->assets ?>react/react.production.min.js"></script>
	<script src="<?php echo $config->assets ?>react/react-dom.production.min.js"></script>
	<script src="<?php echo $config->assets ?>react/react-router.js"></script>
	<script src="<?php echo $config->assets ?>react/react-router-dom.min.js"></script>
	<script src="<?php echo $config->assets ?>react/history.js"></script>
	
	<!-- Bootstrap Dependencies -->
	<script src="<?php echo $config->assets ?>misc/jquery-3.3.1.min.js"></script>
	<script src="<?php echo $config->assets ?>bootstrap/popper.min.js"></script>
	<script src="<?php echo $config->assets ?>bootstrap/bootstrap.min.js"></script>
	
	<!-- General -->
	<script src="<?php echo $config->assets ?>misc/lodash.min.js"></script>
	<script src="<?php echo $config->assets ?>misc/misc.js"></script>
	
	<!-- Marzipano -->
	<script src="<?php echo $config->assets ?>marzipano/es5-shim.js"></script>
	<script src="<?php echo $config->assets ?>marzipano/eventShim.js"></script>
	<script src="<?php echo $config->assets ?>marzipano/classList.js"></script>
	<script src="<?php echo $config->assets ?>marzipano/requestAnimationFrame.js" ></script>
	<script src="<?php echo $config->assets ?>marzipano/screenfull.min.js" ></script>
	<script src="<?php echo $config->assets ?>marzipano/bowser.min.js" ></script>
	<script src="<?php echo $config->assets ?>marzipano/marzipano.js" ></script>
	
	<!-- Load Config to JS -->
	<script type="text/javascript">
		window.Config = <?php echo json_encode( $config )?>;
		window.Link = ReactRouterDOM.Link;
		window.browserHistory = History.createBrowserHistory(); 
		window.Router = ReactRouter.Router;
		window.Route = ReactRouter.Route;
		window.IndexRoute = ReactRouter.IndexRoute;
		window.Switch = ReactRouter.Switch; 
		window.AppState = {
			locations: {
				filters: {
					name: ""
				}
			}
		}
		
	</script>
	
	<!-- Load JSX Files (transpiled to regular JS from ES6 using babel) -->
	<script type="text/babel" src="<?php echo $config->admin_ui ?>helpers.js"></script>
	<script type="text/babel" src="<?php echo $config->admin_ui ?>jsx/App.jsx"></script>
	<script type="text/babel" src="<?php echo $config->admin_ui ?>jsx/404.jsx"></script>
	<script type="text/babel" src="<?php echo $config->admin_ui ?>jsx/Header.jsx"></script>
	<script type="text/babel" src="<?php echo $config->admin_ui ?>jsx/Spinner.jsx"></script>
	<script type="text/babel" src="<?php echo $config->admin_ui ?>jsx/Modal.jsx"></script>
	<script type="text/babel" src="<?php echo $config->admin_ui ?>jsx/FAQs.jsx"></script>
	<script type="text/babel" src="<?php echo $config->admin_ui ?>jsx/About.jsx"></script>
	<script type="text/babel" src="<?php echo $config->admin_ui ?>jsx/Login.jsx"></script>
	<script type="text/babel" src="<?php echo $config->admin_ui ?>jsx/Locations.jsx"></script>
	<script type="text/babel" src="<?php echo $config->admin_ui ?>jsx/Upload.jsx"></script>
	<script type="text/babel" src="<?php echo $config->admin_ui ?>jsx/HotspotLink.jsx"></script>
	<script type="text/babel" src="<?php echo $config->admin_ui ?>jsx/HotspotInfo.jsx"></script>
	<script type="text/babel" src="<?php echo $config->admin_ui ?>jsx/Editor.jsx"></script>
	<script type="text/babel" src="<?php echo $config->admin_ui ?>main.js"></script>
	
	
</body>
</html>
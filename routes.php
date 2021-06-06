<?php if(!defined("ACCESS")) die("Direct access not allowed."); 

/**
 * UPLB Campus Street View
 * Routes
 * 
 * Define routes and corresponding function or component.
 */


/**
 * Viewer Page Route 
 * - Load Viewer
 */

$app->get('/', function() use ($config, $db, $app) {
	
	ob_start();
	require( FSVIEWER . "/index.php" );
	$html = addslashes(ob_get_contents());
	ob_end_clean();
	
	return stripslashes( $html );
}); 


/**
 * Admin Page Route
 * - Load Admin 
 */
$app->get( '/admin/', function()  use ($config, $db, $app) {
	
	ob_start();
	require( FSADMIN . "index.php" );
	$html = addslashes(ob_get_contents());
	ob_end_clean();
	
	return stripslashes( $html );
}); 


$app->get( '/test/', function() {
	$dir = FSUPLOADS . "10000/1/b/0/0.jpg";
	echo $dir . "<br />";
	echo  is_dir( $dir ) ? 'directory' : 'not directory';
	die();
});

/**
 * API Routes
 */
$app->post( '/api/', 'Auth' );
$app->post( '/api/locations/', 'Locations' );
$app->post( '/api/locations/simpleList/', 'Locations' );
$app->post( '/api/locations/item/', 'Locations' );
$app->post( '/api/locations/upload/', 'Locations' );
$app->post( '/api/locations/save/', 'Locations' );
$app->post( '/api/locations/remove/', 'Locations' );	
$app->post( '/api/viewer/', 'Viewer' );	// Load Locations List for Viewer
<?php 

/** Database Access */
define('DB_NAME', 'uplb_campus_view'); 
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_HOST', 'localhost');
define('DB_CHARSET', 'utf8');
define('DB_COLLATE', '');
define('DB_PREFIX', 'csv_');

/** Files */
define("DS", DIRECTORY_SEPARATOR); 
define("FSROOT", dirname(__FILE__) );
define("FSLIBS", FSROOT.DS."libs/");
define("FSCOM", FSROOT.DS."components/");
define("FSUPLOADS", FSROOT.DS."uploads/");
define("FSADMIN", FSROOT.DS."ui/admin/");
define("FSVIEWER", FSROOT.DS."ui/viewer/");

/** Config - Links */
define("UIROOT", '/uplb-campus-street-view/');
$config = new stdClass();
$config->root 	=	UIROOT;
$config->viewer 	=	UIROOT;
$config->admin 	=	UIROOT . 'admin/';
$config->api		=	UIROOT . 'api/';
$config->assets		=	UIROOT . 'ui/assets/';
$config->admin_ui			=	UIROOT . 'ui/admin/';
$config->viewer_ui		=	UIROOT . 'ui/viewer/';
$config->uploads		=	UIROOT . 'uploads/';
$config->version = '1.0.0'; 
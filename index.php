<?php
/**
 * UPLB Campus Street View 
 * Entry Point
 *
 * This is the entry point for the app. It matches the GET and POST request URLs to specified sections (admin, api, and viewer) then load the corresponding function. 
 */ 

// Start PHP session and standardize server timezone 
session_start();
date_default_timezone_set("UTC"); 

// Prevent direct access to other PHP files
DEFINE('ACCESS', 'site'); 


// Load Dependencies
require(dirname(__FILE__) . '/config.php');
require( FSLIBS . 'db.php' );
require( FSLIBS . 'helpers.php' );
require( FSLIBS . 'component.php' );
require( 'app.php' );


// Initialize DB and App
$db 	= new Database();
$app 	= new App(); 
 
// Get Routes
include( FSROOT . "/routes.php" );
 
/**
 * Run App
 */
$app->run(); 
<?php if(!defined("ACCESS")) die("Direct access not allowed."); 

/**
 * Class App
 * 
 * This class is the main app controller class. It stores the routes and corresponding functions defined in index.php
 *
 * @package UPLBCampusStreetView
 */
class App {
	
	
	/** 
	 * Component Variables
	 */
	public $db, $session, $users = array(), $user, $getRoutes = [], $postRoutes = [], $events, $request, $response, $headers = array();
	
	
	/**
	 * Constructor
	 * 
	 */
	public function __construct() {
		global $config, $db;
		$fullpath 			= $_SERVER['REQUEST_URI'];
		$root						= str_replace( 'index.php', '',  strtok( $_SERVER['SCRIPT_NAME'], '?' ) );
		$this->root 		= $root; 
		$this->path 		= str_replace( $root, '/', strtok( $fullpath, '?' ) );
		$this->params 	= explode("/", trim( $this->path, "/" ) );
		$this->config		= $config; 
		$this->method		= $_SERVER['REQUEST_METHOD'];
		$this->session_key = empty( $_REQUEST['session_key'] ) ? null : $_REQUEST['session_key'];
		$this->session 	= (object)array();
		$this->user 		= (object)array( "id" => 0, "name" => "Guest", "type" => "guest" );
		$this->db				= $db;
		$this->getdata 	= $_GET;
		$this->postdata = $_POST;
		$this->request = $_REQUEST;
		
				
		// Set Session User
		if( !empty( $this->session_key ) ) {
			
			$session = (object)$this->db->getRow( "#__sessions", "*", array( array( 'session_key', $this->session_key ) ) ); 
			
			// Find session
			// If session is found, set user and session data
			if(!empty( $session->user_id ) ) {
				$this->session 	= $session;
				$this->user = (object)$this->db->getRow( '#__users', '*', array( array( 'id', $session->user_id ) ) );
				unset($this->user->pass);
			}
		}
			
		
		// Set API
		$this->_allowCORS();
		
	}
	
	/**
	 * Function to define get routes 
	 *
	 * @param string $path 
	 * @param mixed $callback
	 */
	public function get( $path, $callback ) {
		$this->getRoutes[ $path ] = $callback;
	}
	
	/**
	 * Post
	 */
	public function post( $path, $callback ) {
		$this->postRoutes[ $path ] = $callback;
	}
	
	
	/**
	 * Run 
	 */
	public function run() {
		
		$fn = '';
		
		// Find Callback in GET list
		if( $this->method == 'GET' && isset($this->getRoutes[ $this->path ]) )
			$fn = $this->getRoutes[ $this->path ];
		
		// Find Callback in POST list
		else if( $this->method == 'POST' && isset($this->postRoutes[ $this->path ]) )
			$fn = $this->postRoutes[ $this->path ];
			
		
		// If no callback is found in / and /admin/
		if ( empty( $fn ) && strpos( $this->path, '/api/' ) === false ) {
			$ui_route = strpos( $this->path, '/admin/' ) > -1 ? '/admin/' : '/'; 
			$fn = isset( $this->getRoutes[ $ui_route ] ) ? $this->getRoutes[ $ui_route ] : null;
		}
		
		
		// If no callback is found in API route
		if( empty( $fn ) ) {
			$this->response = [ 'error' => 'Component not found.', 'component' => $fn, 'route' => $this->path ];
		}
		
		// Load Component
		else {
			
			if( is_callable( $fn ) ) $this->response = call_user_func( $fn );
			
			else {
				sleep(.8);
				$file = FSCOM . $fn . "/index.php";
				if( file_exists( $file ) ) {
					require_once( $file );
					$className = $fn . "Controller";
					$this->response = $className::getInstance()->run();
				}
				else {
					$this->response = [ 'error' => 'Component not found.', 'component' => $fn, 'path' => $this->path ];
				}
			}
			
		}
		
		if( is_object($this->response) || is_array($this->response) ) $this->response = json_encode( $this->response );
		$this->_render();
		
	}

	
	/**
	 * Allow Cross Origin (CORS)
	 */
	protected function _allowCORS() {
			$this->headers['Access-Control-Allow-Origin'] 	= empty( $_SERVER['HTTP_ORIGIN'] ) ? '' : $_SERVER['HTTP_ORIGIN'];
			$this->headers['Access-Control-Allow-Methods'] 	= "GET, POST, PUT";
			$this->headers['Access-Control-Max-Age'] 				= 1000;
			$this->headers['Access-Control-Allow-Headers']	= "Content-Type, Authorization, X-Requested-With";
	}
	
	
	/**
	 * Check User
	 */
	public static function hasUser() { return !empty( self::$user ); }
	
	
	
	/**
	 * Render
	 */
	protected function _render() {
		
		// Add Headers
		foreach($this->headers as $k=>$v) 
			header( $k . ": " . $v );
		
		// Output HTML
		echo $this->response; 
		exit(0);
	}

	
}
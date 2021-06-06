<?php if(!defined("ACCESS")) die("Direct access not allowed."); 

/**
 * Component Parent Class 
 *
 * Component controllers can use this class to inherit some initializations. Follows singleton pattern to ensure only single instance is loaded.
 */
class ComponentController {
 
	// Global App Vars
	public $config, $settings, $db, $session_key, $session, $user, $path, $params, $root;
	
	// Private Vars
	public $_name = "Component", $_task = "list", $_items, $_item, $res = ['success'=>false, 'message'=>''];
	public $_table = "", $_filters = [], $_wheres = [], $_fields = "", $_sort = [], $_limit = "";
	
	// Protected Vars 
	protected static $instance; 
	
	
	/**
	 * Parent constructor
	 *
	 * VERY IMPORTANT: Must be private! Otherwise we can create new father instance in it's Child class.
	 */
	private function __construct() {
		global $config, $settings, $app;
		
		
		$this->config = $config;
		$this->settings = $settings; 
		$this->db = $app->db;
		$this->session_key = $app->session_key;
		$this->session = $app->session;
		$this->user = $app->user;
		$this->path = $app->path;
		$this->params = $app->params;
		$this->root = $app->root;
		$this->getdata = !empty( $app->getdata ) ? $app->getdata : [];
		$this->postdata = !empty( $app->postdata ) ? $app->postdata : [];
		$this->request = !empty( $app->request ) ? $app->request : [];
		
		
		// Set Task
		$this->_task = !empty($app->params) && !empty($app->params[2]) ? $app->params[2] : 'list';
		
		// Filters
		$this->_filters = !empty($this->postdata['filters']) && is_array( $this->postdata['filters'] ) ? $this->postdata['filters'] : [];
		
		$this->res = (object)$this->res;
		
	}
	
	
	/**
	 * Get $_GET Data
	 */
	public function getQuery( $key = '', $default = '') {
		if(!empty($key)) {
			if(isset($this->getdata[$key])) return $this->getdata[$key];
			else return $default;
		}
		else return $this->getdata; 
	}
	
	
	/**
	 * Get $_POST Data
	 */
	public function getPost( $key = '', $default = '') {
		if(!empty($key)) {
			if(isset($this->postdata[$key])) return $this->postdata[$key];
			else return $default;
		}
		else return $this->postdata; 
	}
	
	
	/**
	 * Get $_REQUEST Data
	 */
	public function getRequest( $key = '', $default = '' ) {
		if(!empty($key)) {
			if(isset($this->request[$key])) return $this->request[$key];
			else return $default;
		}
		else return $this->request; 
	}
	
	
	/**
	 * Singleton Instance Checker
	 */
	public static function getInstance() {
		// must use static::$instance, can not use self::$instance, self::$instance will always be Father's static property 
		if (! static::$instance instanceof static) {
			static::$instance = new static();
		}
		return static::$instance;
	}
	
	
	/**
	 * Default Run Method
	 */
	public function run() {
		
		
		// Default (list)
		if( $this->_task == 'list' ) $task = 'getItems';
		
		// Get Item
		else if ($this->_task == 'item' ) $task = 'getItem';
		
		// Get Task
		else $task = $this->params[2];
		
		// Run Task
		$this->res = $this->$task();
		
		return $this->res; 
		
	}
	
	
	/**
	 * Access Control
	 */
	public function isNot( $user_type ) { 
		if( is_array( $user_type ) ) return !in_array( $this->user->type, $user_type );
		else return $this->user->type != $user_type; 
	}
	
	public function is( $user_type ) { 
		if( is_array( $user_type ) ) return in_array( $this->user->type, $user_type );
		else return $this->user->type == $user_type; 
	}
	
	
	/**
	 * Task: Default/List
	 *
	 * List all the data. 
	 */
	public function getItems( $wheres = [] ) {
		
		// Set Filter Query
		if( !empty($this->_wheres ) ) $wheres = $this->_wheres;
		
		// Set Filter Query from raw list
		else if( empty($wheres) && !empty($this->_filters) )
			foreach( $this->_filters as $field => $v )
				$wheres[] = [ $field, $v, 'like' ];
		
		// Get Simple List
		$this->res->items = $this->db->getData( $this->_table, $this->_fields, $wheres, $this->_sort, $this->_limit );
		$this->res->success = true;
		
		
		return $this->res;
	}

	
	/**
	 * Task: Edit
	 *
	 * Retrieve single record as well as associated data.
	 */
	public function getItem($id = 0, $wheres = []) {
		
		$id = !empty( $this->getdata['id'] ) ? $this->getdata['id'] : $id;
		$wheres = empty($wheres) ? [ ['id', $id] ] : $wheres;
		
		// Set Filter Query
		if( !empty($this->_wheres ) ) $wheres = $this->_wheres;
		
		// Set Filter Query from raw list
		else if( empty($wheres) && !empty($this->_filters) )
			foreach( $this->_filters as $field => $v )
				$wheres[] = [ $field, $v, 'like' ];
		
		// Get Item
		$this->res->item = $this->db->getRow( $this->_table, $this->_fields, $wheres );
		
		if(!empty($this->res->item)) $this->res->success = true;
		
		return $this->res;
	}
	
	
	/** 
	 * Task: Single
	 *
	 * Same as edit
	 */
	public function single($id=0) {
		return $this->getItem($id);
	}
	 
	 
	/**
	 * Task: Update
	 *
	 * Insert/Update new data
	 */
	public function update($id=0,$data=[]) {
		
		if( empty($data['id']) ) $data['id'] = $this->db->insertData( '#__users', $data );
		else $this->res->status = $this->db->updateData('#__users', $data, [ [ 'id', $data['id'] ] ] );
		
		$this->res->success = true;
		
		return $this->res;
	}
	
	
	/**
	 * Task: Upsert
	 *
	 * Same as update task
	 */
	public function upsert($id=0, $data=[]) {
		return $this->update($id, $data);
	}

	
	/**
	 * Task: Remove / Delete
	 *
	 * Remove record(s).
	 */
	public function remove($id=0) {
		
		if( is_array( $id ) ) $this->res->status = $this->db->deleteData($this->_table, [ ['id', $id, 'in'] ] );
		else $this->res->status = $this->db->deleteData($this->_table, [ ['id', $id] ] );
		$this->res->success = true;
		
		return $this->res;
	}
	
	
	/**
	 * Clone Res 
	 */
	public function res() {
		return json_decode( json_encode( $this->res ) ); 
	}
	
	
	/**
	 * User Check
	 */
	public function hasUser() { return !empty($this->user) && !empty( $this->user->id ); }
	public function getUserType() { if( !empty($this->user) && !empty($this->user->type) ) return $this->user->type; return "guest";}
	public function isAdmin() { return $this->getUserType() === 'admin'; }
	public function isGuest() { return $this->getUserType() === 'guest';}
	
	
	/**
	 * Restrict Clone
	 */
	final protected function __clone(){}
	
}
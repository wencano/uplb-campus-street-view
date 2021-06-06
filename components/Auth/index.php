<?php if(!defined("ACCESS")) die("Direct access not allowed."); 


/**
 * Authentication Controller
 *
 * session, login, logout
 */
class AuthController extends ComponentController {
	
	
	/**
	 * Default
	 */
	public function run() {
		
		// Work Around for Reset
		if( !empty($this->_task) && $this->_task != 'list' ) {
			$task = $this->_task;
			return $this->$task(); 
		}
		
		
		// Default Function 
		$res = (object)['success' => false, 'message' => 'User not found.'];
		$task			= empty( $_POST['task'] ) ? '' : $_POST['task'];
		
		// Task: Login
		if( $task == 'login' ) $res = $this->login();
		
		// Task: Logout
		else if ($task == 'logout' ) $res = $this->logout();
		
		// Task: Check Session
		else $res = $this->checkSession();
		
		return $res;
		
	}
	
	
	/**
	 * Task: Check Session
	 */
	public function checkSession() {
		$res = $this->res();
		
		if( !empty( $this->user->id ) ) {
			$res->user				= $this->user;
			$res->success = true;
			$res->message =	"API Data Retrieved.";
		}
		
		return $res; 
		
	}
	
	
	/**
	 * Task: Login
	 */
	public function login() {
		
		$res 			= new stdClass();
		
		$u				= (object)array(
			"email" => empty( $_POST['email'] ) ? "" : $_POST['email'],
			"pass" 	=> empty( $_POST['pass'] ) ? "" : md5( $_POST['pass'] )
		);
		
		// Find User
		$where = array( 
			array( 'email', $u->email ),
			array( 'pass', $u->pass ), 
			array( 'status', 1 )
		);
		$user = (object)$this->db->getRow( '#__users', '*', $where );
		
		// Create Session and add to User
		if(!empty($user->id) ) {
			
			$session = (object)array(
				"session_key" 	=> Helpers::uniqidReal(25),
				"user_id"			=> $user->id, 
				"timein"			=> date("c"),
				"last"				=> date("c"),
				"timeout"			=> ""
			);
			
			$this->db->insertData( "#__sessions", (array)$session );
			
			// Response User
			unset( $user->pass );
			
			$res->user 		= $user;
			$res->session = $session;
			$res->session_key = $session->session_key;
			$res->success	= true;
			$res->message	= "Login successful.";
		}
		
		else {
			$res->success = false;
			$res->message = "Login failed.";
		}
		
		return $res;
		
	}
	
	
	/**
	 * Logout
	 */
	public function logout() {
		$session_key = empty($_POST['session_key']) ? $this->session->session_key : $_POST['session_key'];
		return [ 'req' => $_POST, 'success' => $this->db->updateData( "#__sessions", ["timeout" => date("c" )], [ ["session_key", $session_key ] ] ) ];
	}
	
	
}
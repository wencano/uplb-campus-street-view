<?php if(!defined("ACCESS")) die("Direct access not allowed."); 

/**
 * Locations Controller
 *
 */
class LocationsController extends ComponentController {
	
	public $_name = "Locations";
	public $_table = "#__locations";
	
	
	/**
	 * Run
	 */
	public function run() {
		return parent::run();
		
	}
	
	
	/**
	 * Simple List
	 */
	public function simpleList() {
		
		$res = $this->res();
		
		// Ensure Admin Access; 
		if(!$this->is('admin')) return false; 
		
		// Get Locations
		$locations = $this->db->getData( 
			'#__locations', 
			'',
			[],
			['name', 'asc']
		);
		$locations = empty($locations) ? [] : $locations;
		
		// Format Locations
		foreach($locations as $k=>$loc) {
			
			$loc['levels'] = json_decode( $loc['levels'], true );
			$loc['initialViewParameters'] = json_decode( $loc['initialViewParameters'], true );
			
			$locations[$k] = $loc;
		}
		
		$res->success = true; 
		$res->locations = $locations;
		return $res; 
			
	}
	
	
	/**
	 * Task: Default / List
	 */
	public function getItems( $filters = [] ) {
		$res = $this->res();
		
		// Ensure Admin Access; 
		if(!$this->is('admin')) return $res; 
		
		// Get Locations
		$locations = $this->db->getData( 
			'#__locations', 
			'',
			[],
			['name', 'asc']
		);
		$locations = empty($locations) ? [] : $locations;
		
		// Format Locations
		foreach($locations as $k=>$loc) {
			
			$loc['levels'] = json_decode( $loc['levels'], true );
			$loc['initialViewParameters'] = json_decode( $loc['initialViewParameters'], true );
			
			// Get Hotspots
			$loc['num_links'] = (float)$this->db->getVar( '#__link_hotspots', 'COUNT(id)', [ ['location_id', $loc['id'] ] ] );
			$loc['num_info'] = (float)$this->db->getVar( '#__info_hotspots', 'COUNT(id)', [ ['location_id', $loc['id'] ] ] );
			
			$locations[$k] = $loc; 
			
		}
		
		$res->success = true;
		$res->locations = $locations;
		return $res;
		
	}
	
	

	
	/**
	 * Get Single
	 */
	public function getItem( $id = 0, $filters = []) {
		$res = $this->res;
		
		// Verify User
		if(!$this->is('admin')) return $res; 
		
		// Verify Location ID
		$id = $this->getPost('id', 0);
		if(empty($id)) return $res; 
		
		// Get Locations
		$location = $this->db->getRow( 
			'#__locations', 
			'',
			[ ['id', $id ] ],
			['name', 'asc']
		);
		$location = empty($location) ? [] : $location;
		
		// Format Location
		$location['levels'] = json_decode( $location['levels'], true );
		$location['initialViewParameters'] = json_decode( $location['initialViewParameters'], true );
		
		// Get Hotspots
		$links = $this->db->getData( '#__link_hotspots', '', [ ['location_id', $location['id'] ] ] );
		$location['linkHotspots'] = empty($links) ? [] : json_decode( json_encode( $links ), true );
		
		$info = $this->db->getData( '#__info_hotspots', '', [ ['location_id', $location['id'] ] ] );
		$location['infoHotspots'] = empty($info) ? [] : json_decode( json_encode( $info ), true ); 
	
		$res->success = true;
		$res->location = $location;
		return $res;
		
	}
	
	
	/**
	 * Upload
	 */
	public function upload( ) {
		$res = $this->res();
		$file = $_FILES['file']; 
		
		$location = [
			"name" => $this->getPost('name', ''),
			"id" => $this->getPost('id', 0)
		]; 
		
		$res->file = $file;
		
		// Extract Archive
		if( $file['tmp_name'] ) {
			
			$zip = new ZipArchive;
			if ($zip->open( $file["tmp_name"] ) === TRUE) {
				$zip->extractTo( FSROOT . "/temp/" );
				$zip->close();
				$res->success = true;
			} else {
				$res->message = "ERROR: Cannot read the ZIP file.";
				$res->success = false;
			}
			
			// If Success, Copy ZIP tiles 
			if( $res->success ) {
				$source = FSROOT . "/temp/app-files/tiles";
				Helpers::cpy( $source, FSROOT . "/uploads", "newname" );
				Helpers::deleteDirContents( FSROOT . "/temp/" );
			}
			
		}
		
		// Insert New Location
		if( $location['id'] == 'new' ) {
			
			unset($location['id']);
			$location['levels'] = '[{"tileSize":256,"size":256,"fallbackOnly":true},{"tileSize":512,"size":512},{"tileSize":512,"size":1024},{"tileSize":512,"size":2048}]';
			$location['faceSize'] = 2048;
			$location['initialViewParameters'] = '{"pitch":0,"yaw":0,"fov":1.5707963267948966}'; 
			$location['date_created'] = date("Y-m-d H:i:s");
			
			$location['id'] = $this->db->insertData( '#__locations', $location );
			
			rename( FSUPLOADS . "newname", FSUPLOADS . $location['id'] );
			
			$res->location = $location;
			$res->success = true; 
		}
		
		
		
		
		return $res; 
		
	}
	
	
	
	/**
	 * Save
	 */
	public function save() {
		$res = $this->res();
		
		// Process Data
		$location = $this->getPost('location');
		
		$res->location = $location;
		
		if(empty( $location['id'] ) || $location['id'] == 'new') return $res; 
		
		// Update Location
		$update = [
			"name" => $location['name']
		];
		$this->db->updateData('#__locations', $update, [ ['id', $location['id']] ] );
		
		
		// Link Hotspots
		$linkHotspots = empty($location['linkHotspots']) ? [] : $location['linkHotspots'];
		unset($location['linkHotspots']);
		$linkHotspotsId = Helpers::flatten( $linkHotspots, 'id' );
		
		// Delete Links With Different ID
		$this->db->deleteData('#__link_hotspots', [ ['location_id', $location['id']], ['id', $linkHotspotsId, 'not_in']] );
		
		// Update Link Hotspots
		foreach($linkHotspots as $link) {
			
			if( strpos( $link['id'], 'new') === false ) {
				$this->db->updateData( '#__link_hotspots', $link,[ ['id', $link] ] );
			}
			
			else {
				unset($link['id']);
				$this->db->insertData( '#__link_hotspots', $link  );
			}
		}
		
		
		// Info Hotspots
		$infoHotspots = empty($location['infoHotspots']) ? [] : $location['infoHotspots'];
		unset($location['infoHotspots']);
		$infoHotspotsId = Helpers::flatten( $infoHotspots, 'id' );
		
		// Delete Links With Different ID
		$this->db->deleteData('#__info_hotspots', [ ['location_id', $location['id']], ['id', $infoHotspotsId, 'not_in']] );
		
		// Update Info Hotspots
		foreach($infoHotspots as $info) {
			
			if( strpos( $info['id'], 'new') === false ) {
				$this->db->updateData( '#__info_hotspots', $info,[ ['id', $info] ] );
			}
			
			else {
				unset($info['id']);
				$this->db->insertData( '#__info_hotspots', $info  );
			}
		}
		
		
		$res->success = true; 
		$res->location = $location; 
		
		return $res; 
	}
	
	
	
	/**
	 * Delete
	 */
	public function remove($id=0) {
		$res = $this->res();
		
		// Verify User
		$res->validate = "user_type";
		if(!$this->is('admin') ) return $res; 
		
		// Get ID
		$id = $this->getPost('id', 0);
		
		// Validate ID
		if(empty($id)) return $res; 
		
		// Numeric
		else if( is_numeric( $id ) ) {
			
			$this->db->deleteData( '#__info_hotspots', [ ['location_id', $id] ] );
			$this->db->deleteData( '#__link_hotspots', [ ['location_id', $id] ] );
			$this->db->deleteData( '#__link_hotspots', [ ['target', $id] ] );
			$this->db->deleteData( '#__locations', [ ['id', $id] ] );
			
			// Delete Files
			$dir = FSUPLOADS . "/" . $id . "/";
			if(is_dir($dir)) {
				Helpers::deleteDirContents($dir);
				rmdir($dir); 
			}
			
		}
		
		return $res; 
	}
	
	
}
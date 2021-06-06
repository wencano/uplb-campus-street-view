<?php if(!defined("ACCESS")) die("Direct access not allowed."); 

/**
 * Class ViewerController
 *
 */
class ViewerController extends ComponentController {
	
	public $_name = "Locations";
	public $_table = "#__locations";
	
	
	/**
	 * Get Location Items
	 *
	 * @param	array	$filters 	Location list filters
	 * @return object To be formatted to JSON 
	 */
	public function getItems( $filters = [] ) {
		
		$res = $this->res();
		$res->data = [ 
			"name" => "Project Title",
			"settings" => [
				"mouseViewMode" => "drag",
				"autorotateEnabled" => true,
				"fullscreenButton" => true,
				"viewControlButtons" => true
			],
			"scenes" => []
		];
		
		$locations = $this->db->getData('#__locations', '', [], [ 'name', 'asc'] );
		$locations = empty($locations) ? [] : $locations;
		
		// Format
		foreach($locations as $k=>$loc) {
			
			$loc['levels'] = json_decode( $loc['levels'], true );
			$loc['initialViewParameters'] = json_decode( $loc['initialViewParameters'], true );
			
			// Get Hotspots
			$links = $this->db->getData( '#__link_hotspots', '', [ ['location_id', $loc['id'] ] ] );
			$loc['linkHotspots'] = empty($links) ? [] : json_decode( json_encode( $links ), true );
			
			$info = $this->db->getData( '#__info_hotspots', '', [ ['location_id', $loc['id'] ] ] );
			$loc['infoHotspots'] = empty($info) ? [] : json_decode( json_encode( $info ), true ); 
			
			$locations[$k] = $loc; 
			
		}
		
		//echo "<pre>" . print_r( $locations, true ) . "</pre>"; 
		$res->data['scenes'] = $locations; 
		$res->success = true; 
		return $res;
		
	}
	
}
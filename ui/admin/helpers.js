const Helpers = {
	
	to: ( path ) => {
		path = path || ''; 
		browserHistory.push( Config.admin + path )
	}
	
}
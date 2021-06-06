/**
 * Locations Form 
 */
class Locations extends React.Component {
	
	constructor(props) {
		super(props);
		
		this.state = {
			filters: {
				"name": ""
			},
			locations: []
		}; 
		
		this.getItems = this.getItems.bind(this);
		
		
	}
	
	
	/**
	 * Get Locations
	 */
	getItems(loading) {
		let _this = this;
		let state = this.state; 
		let props = this.props; 
		
		if(loading) _this.props.setLoading(true);
		
		$.post( Config.api + 'locations/', {session_key: this.props.appdata.session_key}, function(res) {
			
			try {
				res = JSON.parse(res);
				if(res && res.success ) {
					state.locations = res.locations; 
					_this.setState(state);
				}
			}
			
			catch(e) {
				console.log("ERROR: ", e);
			}
			
			if(loading) _this.props.setLoading(false);
			
		});
		
		
	}
	
	
	/**
	 * Remove Location
	 */
	remove(id) {
		let _this = this; 
		if(!id || !confirm('Are you sure you want to delete this location?') ) return false; 
		
		$.post( Config.api + 'locations/remove/', {session_key: this.props.appdata.session_key, id: id}, function(res) {
			_this.getItems();
		}); 
		
	}
	
	
	
	render() {
		
		
		if(this.props.appdata.user.id ) {
			
			let state = this.state; 
			
			return (
				<div className="container">
					<div className="row">
						<div className="col-sm-12 col-md-12 col-lg-12 mx-auto">
							
							<div className="page-header clearfix" style={{marginTop: 50, marginBottom: 30 }} >
								<h2 className="float-left" >Manage Locations </h2>
								<div className="float-right">
									<a href="javascript:;" onClick={(e)=>this.getItems(true)} className="btn btn-outline-secondary" title="Refresh Locations List" ><i className="fa fa-undo"></i></a>&nbsp;
									<button type="button" className="btn btn-primary" onClick={(e)=>this.props.setModal(Upload, {getLocations: this.getItems} )} ><i className="fa fa-plus-circle"></i> Add</button>
								</div>
							</div>
							
							<table className="table table-striped">
								<thead>
									<tr>
										<th>Location Name</th>
										<th  style={{textAlign: 'center'}}>Info Hotspots</th>
										<th  style={{textAlign: 'center'}}>Link Hostspots</th>
										<th></th>
									</tr>
								</thead>
								<tbody>
								
									{state.locations && state.locations.length ? state.locations.map( (location, i) => {
										return (
											<tr key={i} >
												<td><Link to={Config.admin + "locations/"+ location.id + "/" }>{location.name} </Link></td>
												<td style={{textAlign: 'center'}}>{location.num_info}</td>
												<td  style={{textAlign: 'center'}}>{location.num_links}</td>
												<td style={{textAlign: 'right'}} >
													<a href="javascript:;" onClick={(e)=>this.remove(location.id)} title={"Delete Location"}><small><i className="fa fa-trash"></i></small></a>
												</td>
											</tr>
										)
									} ) : 
										<tr>
											<td colSpan={4}>No locations found. <a href="javascript:;" onClick={(e)=>this.getItems()}>Check Again</a></td>
										</tr>
									}
									
								</tbody>
							</table>
							
						</div>
					</div>
				</div>
			);
			
		}
		
		else {
			return null; 
		}
	}
	
	componentWillMount() {
		this.props.setPage('');
		if(this.props.appdata.user.id) this.getItems();
	}
	
	componentDidMount() {
		let _this = this;
		setTimeout( ()=>{
			if( !_this.state.locations || !_this.state.locations.length ) 
				this.getItems();
		}, 300 ); 
	}
	
}

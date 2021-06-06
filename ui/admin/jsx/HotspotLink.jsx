class HotspotLink extends React.Component {
	
	constructor(props) {
		super(props);
		
		this.state = {
			hotspot: _.cloneDeep( this.props.params.hotspot ),
			locations: null
		}
		
		this.getLocations = this.getLocations.bind(this);
		this.formChange = this.formChange.bind(this);
		this.update = this.update.bind(this);
		this.remove = this.remove.bind(this);
		
	}
	
	getLocations() {
		let _this = this;
		
		$.post( Config.api + "locations/simpleList/", {session_key: window.localStorage.getItem('csv_session_key') }, function(res) {
				res = JSON.parse( res ); 
				
				if(res.success && res.locations ) {
					_this.state.locations = res.locations;
					_this.setState( _this.state );
				}
				
				else {
					alert("ERROR: Unable to fetch data from server.");
				}
			}
		); 
	}
	
	formChange(e) {
		let state = this.state;
		console.log( "UPDATE LINK ", state.hotspot, e.target.name, e.target.value  );
		state.hotspot[ e.target.name ] = e.target.value;
		this.setState(state);
	}
	
	
	
	update() {
		let _this = this;
		_this.props.params.update(null, 'update_link', {hotspot: _this.state.hotspot, el: _this.props.params.el} );
		_this.props.closeModal();
	}
	
	
	remove() {
		let _this = this;
		
		if(!confirm('Are you sure you want to remove this link?')) return false; 
		
		_this.props.params.update(null, 'remove_link', { hotspot: _this.props.params.hotspot, el: _this.props.params.el } );
		_this.props.closeModal();
		
		
	}
	
	
	
	render() {
		
		let hotspot = this.state.hotspot; 
		let locations = this.state.locations; 
		console.log("Rotation " + hotspot.rotation );
		return ( 
			<div className="modal-dialog" role="document">
				<div className="modal-content">
					<div className="modal-header">
						<h5 className="modal-title">{ hotspot.id.indexOf('new') > -1 ? "Edit" : "Add" } Link Hotspot</h5>
						<button type="button" className="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div className="modal-body">
						{locations ? 
							<form>
								<div className="form-group">
									<label  htmlFor="location_rotation">Icon Direction:</label>
									<div style={{width: 160}}>
										<select className="form-control" value={hotspot.rotation} onChange={(e)=>this.formChange(e)} name="rotation" >
											<option value={0}>North</option>
											<option value={0.7854}>North East</option>
											<option value={1.5708}>East</option>
											<option value={2.3562}>South East</option>
											<option value={3.1416}>South</option>
											<option value={3.9270}>South West</option>
											<option value={4.7123}>West</option>
											<option value={5.4978}>North West</option>
										</select>
									</div>
								</div>
								<div className="form-group">
									<label htmlFor="location_target">Target Location (<Link to={Config.admin + "locations/" + hotspot.target+"/"}><i className="fa fa-external-link-alt" onClick={(e)=>{ $("#global-modal").modal('hide'); } }></i></Link>):</label>
									<select id="location_target" defaultValue={hotspot.target} onChange={(e)=>this.formChange(e)} name="target" className="form-control" >
										<option value="">-Not Assigned-</option>
										{locations && locations.length ? locations.map( (location, i) => {
											return (
												<option key={i} value={location.id}>{location.name}</option>
											);
										}) 
											: null 
										}
									</select>
								</div>
							</form> : null
						}
						
					</div>
					<div className="modal-footer " style={{justifyContent: 'flex-end'}}>
						<Link to={Config.admin} role="button" className="btn btn-outline-secondary btn-lg" data-dismiss="modal"> Cancel</Link>
						<button className="btn btn-lg btn-outline-danger ext-uppercase" onClick={(e)=>this.remove(e)} >Remove</button>
						<button className="btn btn-lg btn-success ext-uppercase" onClick={(e)=>this.update(e)} >Update</button>
					</div>
				</div>
			</div>
		)
	}
	
	
	
	componentWillMount(){
		this.getLocations();
	}
	
}
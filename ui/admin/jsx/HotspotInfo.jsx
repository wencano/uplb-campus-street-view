class HotspotInfo extends React.Component {
	
	constructor(props) {
		super(props);
		
		this.state = {
			hotspot: _.cloneDeep( this.props.params.hotspot )
		}
		
		this.formChange = this.formChange.bind(this);
		this.update = this.update.bind(this);
		this.remove = this.remove.bind(this);
		
	}
	
	formChange(e) {
		let state = this.state;
		state.hotspot[ e.target.name ] = e.target.value;
		this.setState(state);
	}
	
	
	
	update() {
		let _this = this;
		_this.props.params.update(null, 'update_info', {hotspot: _this.state.hotspot, el: _this.props.params.el} );
		_this.props.closeModal();
	}
	
	
	remove() {
		let _this = this;
		
		if(!confirm('Are you sure you want to remove this link?')) return false; 
		
		_this.props.params.update(null, 'remove_info', { hotspot: _this.props.params.hotspot, el: _this.props.params.el } );
		_this.props.closeModal();
		
		
	}
	
	
	
	render() {
		
		let hotspot = this.props.params.hotspot; 
		let locations = this.state.locations; 
		
		return ( 
			<div className="modal-dialog" role="document">
				<div className="modal-content">
					<div className="modal-header">
						<h5 className="modal-title">{ hotspot.id.indexOf('new') > -1 ? "Edit" : "Add" } Info Hotspot</h5>
						<button type="button" className="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div className="modal-body">
						
						<form>
							<div className="form-group">
								<label htmlFor="hotspot_title">Title:</label>
								<input type="text" className="form-control" id="hotspot_title" placeholder="0" defaultValue={hotspot.title} onChange={(e)=>this.formChange(e)} name="title" />
							</div>
							<div className="form-group">
								<label htmlFor="hotpost_text">Text:</label>
								<textarea className="form-control" id="hotpost_text" placeholder="0" defaultValue={hotspot.text} onChange={(e)=>this.formChange(e)} name="text" rows={10}/>
							</div>
						</form>
						
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
	
	
}
class Upload extends React.Component {
	
	constructor(props) {
		super(props);
		
		this.state = {
			location: {
				id: 'new',
				name: ''
			},
			uploading: false
		}
		
		this.formChange = this.formChange.bind(this);
		this.upload = this.upload.bind(this);
		
	}
	
	formChange(e) {
		let state = this.state;
		state.location[ e.target.name ] = e.target.value;
		this.setState(state);
	}
	
	upload() {
		let _this = this;
		let state = this.state; 
		
		let inputFile =  document.getElementById('location_file');
		
		// Validate File Name
		if( state.location.name.trim() == '' || !inputFile.files.length ) {
			alert("ERROR: Please enter a name and upload a Marzipano formatted ZIP file. ");
			return false; 
		}
		
		_this.props.setLoading(true);
		_this.state.uploading = true;
		_this.setState(_this.state);
		
			
		// Send File
		let formData = new FormData();
		
		formData.append( "file", inputFile.files[0] );
		formData.append( "id", state.location.id );
		formData.append( "name", state.location.name );
		
		// Upload File
		$.ajax({
			url: Config.api + 'locations/upload/',
			type: 'POST',
			data: formData,
			cache: false,
			dataType: 'json',
			processData: false, // Don't process the files
			contentType: false, // Set content type to false as jQuery will tell the server its a query string request
			success: function(res, textStatus, jqXHR) {
				
				if( res && res.success && res.location ) {
					// _this.props.params.getLocations();
					Helpers.to( 'locations/' + res.location.id + "/" );
					_this.props.closeModal();
				}
				
			}, 
			error: function(res) {
				console.log("ERROR: ", res);
			}
		}); 
		
	}
	
	
	render() {
		
		return ( 
			<div className="modal-dialog" role="document">
				<div className="modal-content">
					<div className="modal-header">
						<h5 className="modal-title">Upload Marzipano ZIP file</h5>
						<button type="button" className="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div className="modal-body">
						<form>
							<div className="form-group">
								<label htmlFor="location_name">Location Name:</label>
								<input type="text" className="form-control" id="location_name" placeholder="Location Name" onChange={(e)=>this.formChange(e)} name="name" />
							</div>
							<div className="form-group">
								<label htmlFor="location_file">ZIP File:</label>
								<input type="file" className="form-control" id="location_file"  />
								<small className="form-text text-muted">Process your panorama or 360 image using <a href="http://www.marzipano.net/tool/" target="_blank">Marzipano tool</a> then export to ZIP archive (no need to add links and info hotspots). Upload the exported ZIP file here.</small>
							</div>
						</form>
					</div>
					
					{this.state.uploading ? 
						<div className="modal-footer " style={{justifyContent: 'flex-end'}}>
							<div className="mr-auto">
								<span><i className="fa fa-spinner fa-spin"></i> Uploading...</span>
							</div>
							
							<button  role="button" className="btn btn-outline-secondary btn-lg btn-disabled" > Cancel</button>
							<button className="btn btn-lg btn-success ext-uppercase btn-disabled" ><i className="fa fa-cloud-upload-alt"></i> Upload File</button>
						</div> : 
						<div className="modal-footer " style={{justifyContent: 'flex-end'}}>
							
							<Link to={Config.admin} role="button" className="btn btn-outline-secondary btn-lg" data-dismiss="modal"> Cancel</Link>
							<button className="btn btn-lg btn-success ext-uppercase" onClick={(e)=>this.upload(e)} ><i className="fa fa-cloud-upload-alt"></i> Upload File</button>
						</div>
					}
				</div>
			</div>
		)
	}
	
}
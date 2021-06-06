/**
 * Editor Form 
 */
class Editor extends React.Component {
	
	
	/**
	 * Component Constructor
	 */
	constructor(props) {
		super(props);
		
		this.state = {
			location: {
				id: 0,
				name: 'Location Not Found'
			},
			scene: null
		}
		
		// Bind component context to functions
		this.formChange = this.formChange.bind(this);
		this.getItem = this.getItem.bind(this);
		this.update = this.update.bind(this);
		this.save = this.save.bind(this);
		this.loadViewer = this.loadViewer.bind(this);
		this.createInfoHotspotElement = this.createInfoHotspotElement.bind(this);
		this.createLinkHotspotElement = this.createLinkHotspotElement.bind(this);
		this.addInfoHotspot = this.addInfoHotspot.bind(this);
		this.addLinkHotspot = this.addLinkHotspot.bind(this);
		
		
	}
	
	
	/**
	 * Get Item
	 *
	 * Get location item from database using AJAX.
	 *
	 * @param mixed id 
	 */
	getItem(id) {
		let _this = this; 
		let state = this.state;
		
		this.props.setLoading(true);
		
		$.post(Config.api + 'locations/item/', {session_key: this.props.appdata.session_key, id: id}, function(res) {
			res = JSON.parse(res);
			
			if(res && res.success ) {
				
				state.location = res.location; 
				_this.setState(state);
				
				_this.loadViewer();
				
			}
			_this.props.setLoading(false);
			
		});
	}
	
	
	/**
	 * Store Form Data
	 */
	formChange(e) {
		let state = this.state;
		
		state.location[ e.target.name ] = e.target.value;
		this.setState(state);
	}
	
	
	
	/**
	 * Update
	 */
	update(e, mode, data ) {
		let _this = this;
		let state = this.state;
		
		
		/**
		 * Update Link Hotspot
		 */
		if( mode == 'update_link' ) {
			
			// state.location.linkHotspots = _.filter( state.location.linkHotspots, (h) => (h.id != data.hotspot.id) );
			for(var i = 0; i < state.location.linkHotspots.length; i++) {
				if( state.location.linkHotspots[i].id == data.hotspot.id ) {
					state.location.linkHotspots[i] = data.hotspot; 
					break; 
				}
			}
			
			if( data.el ) $(data.el).remove();
			
			var element = _this.createLinkHotspotElement(data.hotspot);
      state.scene.hotspotContainer().createHotspot(element, { yaw: data.hotspot.yaw, pitch: data.hotspot.pitch });
			
			_this.setState(state);
		}
		
		
		/** 
		 * Remove Link Hotspot
		 */
		else if( mode == 'remove_link' ) {
			
			state.location.linkHotspots = _.filter( state.location.linkHotspots, (h) => (h.id != data.hotspot.id) );
			if( data.el ) $(data.el).remove();
			
			
			_this.setState(state);
		}
		
		
		/**
		 * Update Info Hotspot
		 */
		else if( mode == 'update_info' ) {
			
			for(var i = 0; i < state.location.infoHotspots.length; i++) {
				if( state.location.infoHotspots[i].id == data.hotspot.id ) {
					state.location.infoHotspots[i] = data.hotspot; 
					break; 
				}
			}
			
			if( data.el ) $(data.el).remove();
			
			var element = _this.createInfoHotspotElement(data.hotspot);
      state.scene.hotspotContainer().createHotspot(element, { yaw: data.hotspot.yaw, pitch: data.hotspot.pitch });
			
			_this.setState(state);
		}
		
		
		/** 
		 * Update Info Hotspot
		 */
		else if( mode == 'remove_info' ) {
			
			state.location.infoHotspots = _.filter( state.location.infoHotspots, (h) => (h.id != data.hotspot.id) );
			if( data.el ) $(data.el).remove();
			
			
			_this.setState(state);
		}
		
		
	}
	
	
	/**
	 * Save Update
	 */
	save() {
		let _this = this;
		let state = this.state; 
		_this.props.setLoading(true);
		
		$.post( Config.api + "locations/save/", {session_key: _this.props.appdata.session_key, location: state.location}, function(res) {
			
			_this.getItem( state.location.id );
			
			_this.props.setLoading(false);
			
		}); 
		
		
	}
	
	
	/**
	 * Load Marzipano Viewer
	 */
	loadViewer() {
		let _this = this; 
		let state = this.state; 
		let location = this.state.location; 
		
		// Initializing DOM element(div.pano)
		var panoElement = document.getElementById('pano');
		var viewerOpts = {
			controls: {
				mouseViewMode: 'drag'    // drag|qtvr
			}
		};

		var viewer = new Marzipano.Viewer(panoElement, viewerOpts)

		//Initialize Scene
		var levels = [
			{ tileSize: 256, size: 256, fallbackOnly: true },
			{ tileSize: 512, size: 512 },
			{ tileSize: 512, size: 1024 }
		];
		
		if( location.levels ) levels = location.levels; 

		var geometry = new Marzipano.CubeGeometry(levels);
		var location_files = Config.uploads + location.id; 
		
		var source = Marzipano.ImageUrlSource.fromString( location_files + "/{z}/{f}/{y}/{x}.jpg", {
			cubeMapPreviewUrl: location_files + "/preview.jpg"
		});

		var initialView = {
			yaw: 90 * Math.PI/180,
			pitch: -30 * Math.PI/180,
			fov: 90 * Math.PI/180
		};
		if( location.initialViewParameters ) initialView = location.initialViewParameters; 

		var limiter = Marzipano.RectilinearView.limit.traditional(location.faceSize, 1100*Math.PI/180, 120*Math.PI/180);

		var view = new Marzipano.RectilinearView(initialView, limiter);

		var scene = viewer.createScene({
			source: source,
			geometry: geometry,
			view: view,
			pinFirstLevel: true
		});
		
		scene.switchTo({
			transitionDuration: 1000
		});
		
		// Create link hotspots.
    location.linkHotspots.forEach(function(hotspot) {
      var element = _this.createLinkHotspotElement(hotspot);
      scene.hotspotContainer().createHotspot(element, { yaw: hotspot.yaw, pitch: hotspot.pitch });
    });

    // Create info hotspots.
    location.infoHotspots.forEach(function(hotspot) {
      var element = _this.createInfoHotspotElement(hotspot);
      scene.hotspotContainer().createHotspot(element, { yaw: hotspot.yaw, pitch: hotspot.pitch });
    });

		state.scene = scene;
		_this.setState(state);
		
	}
	
	
	/**
	 * Add Info Hotspot
	 */
	addInfoHotspot( type ) {
		let _this = this;
		let state = this.state;
		let hotspot = {
			id: 'new'  + (new Date()).getMilliseconds() ,
			location_id: state.location.id,
			yaw: state.scene._view._yaw,
			pitch: state.scene._view._pitch,
			title: 'Temp',
			text: 'Text goes here...'
		}
		
		state.location.infoHotspots.push( hotspot );
		_this.setState(state);
		
		var element = _this.createInfoHotspotElement(hotspot);
    state.scene.hotspotContainer().createHotspot(element, { yaw: hotspot.yaw, pitch: hotspot.pitch });
		$(element).trigger('click');
	}
	
	
	/**
	 * Add Link Hotspot
	 */
	addLinkHotspot( type ) {
		let _this = this;
		let state = this.state;
		let hotspot = {
			id: 'new-' + (new Date()).getMilliseconds(),
			location_id: state.location.id,
			yaw: state.scene._view._yaw,
			pitch: state.scene._view._pitch,
			rotation: 0,
			target: 0
		}
		
		state.location.linkHotspots.push( hotspot );
		_this.setState(state);
		
		var element = _this.createLinkHotspotElement(hotspot);
    state.scene.hotspotContainer().createHotspot(element, { yaw: hotspot.yaw, pitch: hotspot.pitch });
		$(element).trigger('click');
		
	}
	
	
	/**
	 * Create Link Hotspot
	 */
	createLinkHotspotElement(hotspot ) {
	
		let _this = this; 
	
		// Create wrapper element to hold icon and tooltip.
		var wrapper = document.createElement('div');
		wrapper.classList.add('hotspot');
		wrapper.classList.add('link-hotspot');

		// Create image element.
		var icon = document.createElement('img');
		icon.src = Config.viewer_ui + 'img/link.png';
		icon.classList.add('link-hotspot-icon');

		// Set rotation transform.
		var transformProperties = [ '-ms-transform', '-webkit-transform', 'transform' ];
		for (var i = 0; i < transformProperties.length; i++) {
			var property = transformProperties[i];
			icon.style[property] = 'rotate(' + hotspot.rotation + 'rad)';
		}

		// Add click event handler.
		wrapper.addEventListener('click', function() {
			_this.props.setModal(HotspotLink, {el: this, hotspot: hotspot, update: _this.update } );
		});

		// Prevent touch and scroll events from reaching the parent element.
		// This prevents the view control logic from interfering with the hotspot.
		_this.stopTouchAndScrollEventPropagation(wrapper);

		// Create tooltip element.
		var tooltip = document.createElement('div');
		tooltip.classList.add('hotspot-tooltip');
		tooltip.classList.add('link-hotspot-tooltip');
		// tooltip.innerHTML = findSceneDataById(hotspot.target).name;

		wrapper.appendChild(icon);
		wrapper.appendChild(tooltip);

		return wrapper;
	}

	createInfoHotspotElement(hotspot) {
		let _this = this; 
		
		// Create wrapper element to hold icon and tooltip.
		var wrapper = document.createElement('div');
		wrapper.classList.add('hotspot');
		wrapper.classList.add('info-hotspot');

		// Create hotspot/tooltip header.
		var header = document.createElement('div');
		header.classList.add('info-hotspot-header');

		// Create image element.
		var iconWrapper = document.createElement('div');
		iconWrapper.classList.add('info-hotspot-icon-wrapper');
		var icon = document.createElement('img');
		icon.src = Config.viewer_ui + 'img/info.png';
		icon.classList.add('info-hotspot-icon');
		iconWrapper.appendChild(icon);

		// Create title element.
		var titleWrapper = document.createElement('div');
		titleWrapper.classList.add('info-hotspot-title-wrapper');
		var title = document.createElement('div');
		title.classList.add('info-hotspot-title');
		title.innerHTML = hotspot.title;
		titleWrapper.appendChild(title);

		// Create close element.
		var closeWrapper = document.createElement('div');
		closeWrapper.classList.add('info-hotspot-close-wrapper');
		var closeIcon = document.createElement('img');
		closeIcon.src = Config.viewer_ui + 'img/close.png';
		closeIcon.classList.add('info-hotspot-close-icon');
		closeWrapper.appendChild(closeIcon);

		// Construct header element.
		header.appendChild(iconWrapper);
		header.appendChild(titleWrapper);
		header.appendChild(closeWrapper);

		// Create text element.
		var text = document.createElement('div');
		text.classList.add('info-hotspot-text');
		text.innerHTML = hotspot.text;

		// Place header and text into wrapper element.
		wrapper.appendChild(header);
		wrapper.appendChild(text);
		
		wrapper.addEventListener('click', function() {
			_this.props.setModal(HotspotInfo, {el: this, hotspot: hotspot, update: _this.update } );
		});
		
		/**
		// Create a modal for the hotspot content to appear on mobile mode.
		var modal = document.createElement('div');
		modal.innerHTML = wrapper.innerHTML;
		modal.classList.add('info-hotspot-modal');
		document.body.appendChild(modal);

		var toggle = function() {
			wrapper.classList.toggle('visible');
			modal.classList.toggle('visible');
		};

		// Show content when hotspot is clicked.
		wrapper.querySelector('.info-hotspot-header').addEventListener('click', toggle);

		// Hide content when close icon is clicked.
		modal.querySelector('.info-hotspot-close-wrapper').addEventListener('click', toggle);
		*/ 
		
		
		// Prevent touch and scroll events from reaching the parent element.
		// This prevents the view control logic from interfering with the hotspot.
		this.stopTouchAndScrollEventPropagation(wrapper);

		return wrapper;
	}


	// Prevent touch and scroll events from reaching the parent element.
	stopTouchAndScrollEventPropagation(element, eventList) {
		var eventList = [ 'touchstart', 'touchmove', 'touchend', 'touchcancel',
											'wheel', 'mousewheel' ];
		for (var i = 0; i < eventList.length; i++) {
			element.addEventListener(eventList[i], function(event) {
				event.stopPropagation();
			});
		}
	}
	
	
	
	/**
	 * Component Render
	 */
	render() {
		let state = this.state; 
		let location = this.state.location; 
		
		return (
			<div className="container">
				<div className="row">
					<div className="col-sm-12 col-md-12 col-lg-12 mx-auto">
						
						<div className="page-header clearfix" style={{marginTop: 50, marginBottom: 0 }} >
							{ location.id ? <textarea type="text" defaultValue={location.name} onChange={(e)=>this.formChange(e)} name="name" style={{border: 'none', fontSize: '2rem', color: '#000', padding: 2, background: 'transparent', width: 600 }} rows={1} /> : <h2 className="float-left">Location Not Found</h2> }
							<div className="float-right">
								
								<a href="javascript:;" className="btn btn-success" onClick={(e)=>this.save()} ><i className="fa fa-cloud-upload-alt"></i> Save</a>&nbsp;
								<Link to={Config.admin} className="btn btn-outline-secondary">Close</Link>
							</div>
						</div>
						
						<div id="pano-wrapper" style={{display: 'block', position: 'relative', height: 560, background: '#000'}} >
							<div id="pano" ></div>
						</div>
						
						<div style={{margin: '20px 0', textAlign: 'center'}}>
							<a href="javascript:;" className="btn btn-secondary" onClick={(e)=>this.addInfoHotspot() } ><i className="fa fa-info"></i> Add Info</a>&nbsp;
							<a href="javascript:;" className="btn btn-secondary" onClick={(e)=>this.addLinkHotspot() } ><i className="fa fa-chevron-up"></i> Add Link</a>
						</div>
						
					</div>
					
				</div>
			</div>
		);
	}
	
	componentWillMount() {
		
		if( this.props.match.params && this.props.match.params.id ) {
			this.getItem(this.props.match.params.id);
		}
	}
	
	componentDidMount() {
		
		
	}
	
	
	componentWillReceiveProps(props) {
		
		if( JSON.stringify( this.props ) != JSON.stringify(props) ) {
			
			this.getItem( props.match.params.id );
			
		}
		
		
	}
	
}




class App extends React.Component {
	
	/**
	 * Constructor
	 */
	constructor(props) {
		super(props);
		
		this.state = {
			session_key:	window.localStorage.getItem('csv_session_key'),
			userDefault: {
				id: 0,
				type: 'guest',
				name: 'Guest User'
			},
			user: null,
			slug: '',
			UIModal: null
		}
		
		this.state.user = _.cloneDeep( this.state.userDefault );
		
		this.getData = this.getData.bind(this);
		this.setLoading = this.setLoading.bind(this);
		this.setModal = this.setModal.bind(this);
		this.afterModalClose = this.afterModalClose.bind(this);
		this.login = this.login.bind(this);
		this.logout = this.logout.bind(this);
		this.setPage = this.setPage.bind(this);
	}
	
	
	/**
	 * Get Data from Server
	 */
	getData() {
		let _this = this;
		let data = _this.state;
		_this.setLoading(true);
		$.post( Config.api, { session_key: this.state.session_key }, function(res) {
			
			res = JSON.parse(res);
			
			if( res.success ) {
				
				data.user 			= res.user;
				_this.setState(data);
			}
			
			_this.setLoading(false);
		});
		
	}
	
	
	/**
	 * Set Loading
	 */
	setLoading(loading) {
		this.state.loading = loading == null ? !state.loading : loading;
		this.setState(this.state);
	}
	
	
	
	/**
	 * Set Modal
	 */
	setModal( ModalChild, params ) {
		
		if( ModalChild ) {
			this.state.UIModal = {
				ModalChild: ModalChild,
				params: params
			}
		}
		
		else {
			this.state.UIModal = null;
		}
		
		this.setState(this.state);
		
	}
	
	closeModal() {
		$("#global-modal").modal('hide');
	}
	
	/**
	 *  After Modal Close
	 */
	afterModalClose() {
		this.setModal(null);
	}
	
	
	
	/**
	 * Login
	 */ 
	login(e, u) {
		
		if(e){ e.preventDefault(); e.stopPropagation(); }
		let _this = this;
		let state = this.state; 
		
		// Validate 
		if( u.email.trim() == '' || u.pass.trim() == '' ) {
			alert("ERROR: Please enter email and password.");
			return false; 
		}
		
		this.setLoading(true);
		
		$.post( Config.api, {email: u.email, pass: u.pass, task: 'login'}, function(res) {
			console.log("LOGIN ", res); 
			res = JSON.parse(res);
			
			if(res && res.success) {
				window.localStorage.setItem( 'csv_session_key', res.session_key );
				
				state.session_key = res.session_key; 
				state.user = res.user;
				_this.setState(state);
				
				Helpers.to();
				
			}
			else if ( res && !res.success ) alert("ERROR: User not found.");
			else console.log(raw);
			
			_this.setLoading(false);
			
		});
		
	}
	
	
	/**
	 * Logout
	 */
	logout(e) {
		if(e){ e.preventDefault(); e.stopPropagation(); }
		let _this = this; 
		let state = this.state; 
		
		this.setLoading(true);
		
		// Send Logout
		$.post( Config.api, {task: 'logout', session_key: this.state.session_key}, function(res) {
			
			res = JSON.parse(res);
			if(res && res.success ) {
				window.localStorage.setItem( 'csv_session_key', null );
				
				// Update User
				state.session_key	= null;		
				state.user = _.cloneDeep( state.userDefault );
				
				_this.setState( state ); 
				Helpers.to( 'login/' );
				_this.setLoading(false);
			}
		});
		
		
		
	}
	
	
	/**
	 * Upload File
	 */
	uploadFile(e) {
		let state = this.state; 
		
		alert("UPLOADING FILE!!!");
		
		/** 
		$.post( 
			Config.api + "locations/upsert/",
			{ 
				session_key: state.user.session_key,
				id: 'new',
				name: 'Oble Park',
				file: File
			}, 
			function(res) {
				console.log(res);
				alert("UPLOADED FILE!");
				
			}
		)*/
		
		
	}
	
	
	setPage(slug) {
		
		this.state.slug = slug;
		this.setState(this.state);
		
	}
	
	
	/**
	 * Render
	 */
	render() {
		let state = this.state; 
		let props = this.props; 
		
		return (
			<div>
				
				{ state.user && state.user.id ? <Header logout={this.logout} slug={state.slug} /> : null }
				
				{ state.loading ? <Spinner /> : null }
				
				{/** Global Modal */}
				{ state.UIModal ? <Modal params={state.UIModal.params} ModalChild={state.UIModal.ModalChild} afterModalClose={this.afterModalClose} setLoading={this.setLoading} /> : null }
				
				<Switch>
					
					<Route exact={true} path={Config.admin} render={(props2)=> 
						<Locations {...props2} appdata={this.state} setModal={this.setModal} uploadFile={this.uploadFile} setLoading={this.setLoading} setPage={this.setPage} />
					}/>
					
					<Route path={Config.admin + "login"} render={(props2)=> (
						<Login {...props2} appdata={this.state} login={this.login} />
					)} />
					
					<Route path={Config.admin + "locations/add"} render={(props2)=> (
						<Editor {...props2} appdata={this.state} setModal={this.setModal} setLoading={this.setLoading} />
					)} />
					
					<Route path={Config.admin + "locations/:id"} render={(props2)=> (
						<Editor {...props2} appdata={this.state} setModal={this.setModal} setLoading={this.setLoading} setPage={this.setPage} />
					)} />
					
					<Route path={Config.admin + "about"} render={(props2)=>(
						<About {...props2} appdata={this.state} setPage={this.setPage} />
					)}/>
					
					<Route path={Config.admin + "faqs"} render={(props2)=>(
						<FAQs {...props2} appdata={this.state} setPage={this.setPage} />
					)}/>
					
				</Switch>
				
				
			</div>
		);
	}
	
	
	/**
	 * Component Will Mount
	 */
	componentWillMount() {
		
		if( this.state.session_key && this.state.session_key != null && this.state.session_key != 'null' ) {
			this.getData();
		}
		
		else if(!this.state.session_key && !this.state.user.id) {
			Helpers.to( "login/" );
		}
		
	}
	
	
	
}

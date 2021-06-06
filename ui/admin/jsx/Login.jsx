/**
 * Login Form 
 */
class Login extends React.Component {
	
	constructor(props) {
		super(props);
		
		this.state = {
			user: {
				"email" : "",
				"pass" : ""
			}
		}
		
		this.formChange = this.formChange.bind(this);
		
	}
	
	formChange(e) {
		let state = this.state;
		state.user[ e.target.name ] = e.target.value;
		this.setState(state);
	}
	
	
	render() {
		
		return (
			<div className="container">
				<div className="row">
					<div className="col-sm-9 col-md-7 col-lg-5 mx-auto">
						<div className="card card-signin my-5">
							<div className="card-body">
								<h5 className="card-title text-center">Sign In</h5>
								<form className="form-signin">
									<div className="form-label-group">
										<label htmlFor="inputEmail">Email Address</label>
										<input type="text" id="inputEmail" className="form-control" placeholder="Email address" autofocus onChange={(e)=>this.formChange(e)} name="email"  />
									</div>

									<div className="form-label-group">
										<label htmlFor="inputPassword">Password</label>
										<input type="password" id="inputPassword" className="form-control" placeholder="Password" onChange={(e)=>this.formChange(e)} name="pass" />
									</div>
									<hr />
									<button className="btn btn-lg btn-primary float-right text-uppercase" onClick={(e)=>this.props.login(e, this.state.user )} >
										Sign in <i className="fa fa-chevron-right"></i>
									</button>
									
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		);
	}
}



class Header extends React.Component {
	
	constructor(props) {
		super(props);
		
		this.checkPage = this.checkPage.bind(this);
	}
	
	checkPage(slug) {
		return ( this.props.slug == slug ? 'active' : '' );
	}
	
	render() {
		
		return (
			<nav className="navbar navbar-expand-lg navbar-dark bg-dark">
				<Link className="navbar-brand" to={ Config.admin }>UPLB Campus Street View</Link>
				<button className="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
					<span className="navbar-toggler-icon"></span>
				</button>
				<div className="collapse navbar-collapse" id="navbarText">
					<ul className="navbar-nav mr-auto">
						<li className={ "nav-item " + this.checkPage('') }>
							<Link to={Config.admin} className="nav-link">Home</Link>
						</li>
						<li className={ "nav-item " + this.checkPage('about') } >
							<Link to={Config.admin + "about/"} className="nav-link" ><small>About</small></Link>
						</li>
						<li className={ "nav-item " + this.checkPage('faqs') }>
							<Link to={Config.admin + "faqs/"} className="nav-link" ><small>FAQs</small></Link>
						</li>
						<li className="nav-item ">
							<a href={Config.viewer} target="_blank" className="nav-link" title={"Open Viewer"} >Viewer</a>
						</li>
					</ul>
					
					<ul className="navbar-nav ml-auto">
						
						
						
						<li className="nav-item ">
							<a className="nav-link" href="#" onClick={(e)=>this.props.logout(e)} ><small>Sign Out</small></a>
						</li>
					</ul>
				</div>
			</nav>
		
		);
	}
}

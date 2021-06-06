class NotFound extends React.Component {
	render() {
		return (
			<div className="container">
				<h1>Error 404</h1>
				<p>Page not found. <Link to={Config.admin} >Return to Admin <i className="fa fa-arrow-right"></i></Link></p>
			</div>
		);
	}
}

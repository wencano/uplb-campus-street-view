/**
 * FAQs
 */
class About extends React.Component {
	render() {
		
		return (
			<div className="container">
				<div className="row">
					<div className="col-sm-12 col-md-12 col-lg-12 mx-auto">
						
						<div className="page-header clearfix" style={{marginTop: 50, marginBottom: 30 }} >
							<h3 className="float-left" >About</h3>
						</div>
						
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus sagittis risus eget lectus consequat blandit. In dui leo, sollicitudin tincidunt nisi at, consequat aliquam elit. Proin suscipit at turpis quis condimentum. Ut pulvinar maximus sem, lacinia convallis turpis elementum ac. Quisque tempor sapien in justo lobortis, vitae pretium turpis ultrices. Curabitur ac velit enim. Aliquam pharetra nibh sed nibh tristique, condimentum fermentum sapien tempor.</p>

						<p>Praesent consectetur justo quis lobortis finibus. Pellentesque justo est, posuere eget diam sed, efficitur fringilla urna. Nunc eu sapien aliquet, feugiat quam in, pharetra nisl. Mauris vel tristique dui. Aliquam non vulputate nunc. Nunc turpis sapien, tempor et odio vel, aliquet lobortis ante. Morbi libero risus, posuere vel felis non, tempus condimentum tortor.</p>

						<p>Morbi pretium dui eleifend purus ullamcorper viverra. Ut magna leo, tempor non sapien ut, bibendum finibus lacus. Proin pellentesque diam eget odio ultricies suscipit. Pellentesque ut nibh at justo condimentum vestibulum. Sed mattis diam in justo feugiat vehicula. Morbi ac sapien in orci rutrum tincidunt non a magna. Etiam tempor ultrices mollis. Vivamus accumsan ante ac eros imperdiet accumsan. In eu tellus quis leo dapibus volutpat. Curabitur finibus felis at enim posuere tincidunt. Donec fermentum euismod massa, nec euismod purus bibendum eget.</p>
					
					</div>
				</div>
			</div>
		);
	}
	
	componentWillMount() {
		this.props.setPage('about');
	}
	
}

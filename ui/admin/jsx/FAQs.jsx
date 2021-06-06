/**
 * FAQs
 */
class FAQs extends React.Component {
	render() {
		
		return (
			<div className="container">
				<div className="row">
					<div className="col-sm-12 col-md-12 col-lg-12 mx-auto">
						
						<div className="page-header clearfix" style={{marginTop: 50, marginBottom: 30 }} >
							<h3 className="float-left" >Frequently Asked Questions &amp; Help Topics</h3>
						</div>
						
						<div id="accordion">
							
							{/** Question 1 */}
							<div className="card">
								<div className="card-header" id="headingOne">
									<h5 className="mb-0">
										<button className="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
											How to Add a Location? 
										</button>
									</h5>
								</div>

								<div id="collapseOne" className="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
									<div className="card-body">
										The UPLB Campus Street View (UCSV) admin panel provides an easy to use GUI for managing locations. To add locations:
										<ol>
										<li>Simply click the add button found on the right side of the admin panel.</li>
										<li>Add only a zip file generated by the Marzipano tool.</li>
										<li>The image uploader shall only accept a zip file from the Marzipano because it already processes the image as a 3D object. </li>
										<li>Once the zip file containing the image is uploaded, an edit panel shall appear where the admin could add info and link hotspots. </li>
										<li>Finally, hit save and the changes will appear automatically on the admin panel. </li>
										</ol>
									</div>
								</div>
							</div>
							
							<div className="card">
								<div className="card-header" id="headingTwo">
									<h5 className="mb-0">
										<button className="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
											How to Edit and Delete a Location?
										</button>
									</h5>
								</div>
								<div id="collapseTwo" className="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
									<div className="card-body">
										Just click the update button found on the inline row of the location name.
										<ol>
											<li> Edit - updates the location name and description</li>
											<li> Delete - removes the location from the database and from the viewer. </li>
										</ol>
									</div>
								</div>
							</div>
							
							
							<div className="card">
								
								<div className="card-header" id="headingThree">
									<h5 className="mb-0">
										<button className="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
											What Happens to Other Hotspots Connected to the Deleted Location?
										</button>
									</h5>
								</div>
								
								<div id="collapseThree" className="collapse" aria-labelledby="headingThree" data-parent="#accordion">
									<div className="card-body">
										Once you delete a location, the link hotspots connected to it will disappear, for they no longer have a destination to go to.
									</div>
								</div>
							</div>
						</div>
						
					</div>
					
				</div>
			</div>
		);
	}
	
	
	componentWillMount() {
		this.props.setPage('faqs');
	}
}
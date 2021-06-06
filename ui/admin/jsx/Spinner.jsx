class Spinner extends React.Component {
	
	constructor() {
		super();
	}
	
	closeModal() {
	}
	
	
	render() {
		
		return(
			<div className="modal-open">
				<div id="init-spinner-modal" className="modal fade show" tabIndex="-1" role="dialog" aria-labelledby="myLargeModalLabel"  style={{ display: "block" }}  >
					<div className="modal-dialog modal-dialog-centered" role="document" >
						<div className="modal-content text-center" style={{ background: "transparent", color: "#ffffff", border: "none", fontSize: 40 }} >
							<i className="fa fa-lg fa-spinner fa-spin"></i>
						</div>
					</div>
				</div>
				<div className="modal-backdrop fade show"></div>
			</div>
		);
		
	}
	
	componentDidMount() {
		
	}
	
}
class Modal extends React.Component {
	
	constructor() {
		super();
	}
	
	closeModal() {
		$("#global-modal").modal('hide');
	}
	
	onModalClose(fn) {
		
		if( fn ) fn();
		
	}
	
	render() {
		
		const Child = this.props.ModalChild;
		
		return(
			<div id="global-modal" className="modal fade" tabIndex="-1" role="dialog" aria-labelledby="myLargeModalLabel" data-backdrop="static" data-keyboard="false" >
				<Child closeModal={this.closeModal} params={this.props.params} onModalClose={this.onModalClose} afterModalClose={this.props.afterModalClose} setLoading={this.props.setLoading} />
			</div>
		);
		
	}
	
	componentDidMount() {
		
		let _this = this;
		
		$(function(){
			$("#global-modal").modal();
			$("#global-modal").on('hidden.bs.modal', function () {
				_this.onModalClose();
				_this.props.afterModalClose();
			});
		});
		
	}
	
	
}
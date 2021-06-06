// $("#update-modal").modal();
$(document).ready(function(){

	$(".editbtn").click(function(){
		console.log($(this).data('name'));
   		$('#description').val($(this).data('description'));
   		$('#name').val($(this).data('name'));

	});

	$("#save").click(function(){
		$.ajax({
			url: "update_description.php",
			type: "POST",
			data:{
				'description': $('#description').val(),
				'name': $('#name').val()
				 },
			success: function (data) {

				location.reload();

			},
			error: function (xhr, ajaxOptions, thrownError) {

				alert(xhr.responseText);

			}
		});
	});
	
});


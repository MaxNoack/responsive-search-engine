$(document).ready(function(){
	$("#result_table").hide();
	$("#search_phrase").on('input',function(){
		//Clear previous error messages and results
		$("#error-warning, #loader").hide();
		$("#result_table").hide();
		$("#result_table tbody").empty();

		var search_phrase = $("#search_phrase").val();
		if (search_phrase.length > 1) {
			$.ajax({
				type: "post",
				url: "SearchController.php",
				dataType: 'json',
				data: {
					"search_phrase": search_phrase,
					"action_type": "search"
				},
				success: function(data)
				{
					$('#loader').empty();
					if (data.error_message) {
						$("#error-warning").show();
						$("#error-warning").html(data.error_message);
					}
					else if ($.isEmptyObject(data.result_list)) {
						$("#error-warning").show();
						$("#error-warning").html("No results");
					} else {
						$("#result_table").show();
						var $table = $("#result_table");
						var $tbody = $table.append('<tbody />').children('tbody');
						$.each(data.result_list, function(id, product){
							$tbody.append('<tr />').children('tr:last')
							.append($("<td></td>").html(product.produkt_id))
							.append($("<td></td>").html(product.produkt_namn))
							.append($("<td></td>").html(product.kategori_namn))
						});
					}
				},
				beforeSend: function() {
					$("#loader").html('<div class="tab-content text-center"><img src="./images/search_spinner.gif"></div>');
				},
				error: function() {
					$("#error-warning").show();
					$("#error-warning").html("Something went wrong, please try again");
				}
			});
		}
	return false;
	});
});

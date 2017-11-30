/*
* @Author: Manikandan R
* @Date:   2017-06-16 14:38:37
* @Last Modified by:   Manikandan R
* @Last Modified time: 2017-06-30 11:38:22
*/
$(document).ready(function() {
	$('.rating-readonly').barrating({
		readonly: true,
		allowEmpty: null,
        theme: 'fontawesome-stars',
      });
	$('.rating').barrating({
		allowEmpty: null,
        theme: 'fontawesome-stars',
      });
	$('body').on('change', '.rating', function(event) {
		event.preventDefault();
		var rating = $(this).val();
		var data_url = $(this).attr('data-url');
		$.ajax({
			url: base_url+data_url,
			type: 'POST',
			dataType: 'json',
			data: {'rate': rating,'_token':csrf_token},
		})
		.done(function() {
			//console.log("success");
		})
		.fail(function() {
			//console.log("error");
		})
		.always(function() {
			//console.log("complete");
		});
		
	});
});
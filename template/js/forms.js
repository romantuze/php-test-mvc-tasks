$(document).ready(function() {
	
	$('.form-login').submit(function(event) {
		if ($(this).attr('id') == 'no_ajax') {
			return;
		}
		var json;
		event.preventDefault();
		$('.errors').html('');	

		$.ajax({
			type: $(this).attr('method'),
			url: $(this).attr('action'),
			data: new FormData(this),
			contentType: false,
			cache: false,
			processData: false,
			success: function(result) {
				json = jQuery.parseJSON(result);
				if (json.url) {
					window.location.href = '/';
				} else if (json.status=='success') {
					$('.errors').html(json.message);
					window.location.href = '/';
				} else {
					$('.errors').html(json.message);
				}
			},
		});		
	});

	$('.form-edit').submit(function(event) {
		if ($(this).attr('id') == 'no_ajax') {
			return;
		}
		var json;
		event.preventDefault();
		$('.errors').html('');	

		$.ajax({
			type: $(this).attr('method'),
			url: $(this).attr('action'),
			data: new FormData(this),
			contentType: false,
			cache: false,
			processData: false,
			success: function(result) {
				json = jQuery.parseJSON(result);
				if (json.url) {
					window.location.href = '/' + json.url;
				} else {
					$('.errors').html(json.message);
				}
			},
		});		
	});

	$('.select-sort').change(function() {
		var sort;			
		sort = $('.select-sort').val();
		$.post( "/sort", { sort: sort } ).done(function( ) {
		   location.reload(true);
		});		
	});
	
	$('.form-add').submit(function(event) {
		if ($(this).attr('id') == 'no_ajax') {
			return;
		}
		var json;
		event.preventDefault();
		$('.errors').html('Идет отправка...');	

		$.ajax({
			type: $(this).attr('method'),
			url: $(this).attr('action'),
			data: new FormData(this),
			contentType: false,
			cache: false,
			processData: false,
			success: function(result) {
				json = jQuery.parseJSON(result);
				if (json.url) {
					window.location.href = '/' + json.url;
				} else if (json.status=='success') {
					$('.form-input').val('');
					$('.errors').html(json.message);
				} else {
					$('.errors').html(json.message);
				}
			},
		});		
	});

});
$(document).ready(function() {
		
	$(".input-img").change(function() {
		$('.errors').text('');	
	    var val = $(this).val();
	    switch(val.substring(val.lastIndexOf('.') + 1).toLowerCase()){
	        case 'gif': case 'jpg': case 'png':
	           readURL(this);
	           break;
	        default:
	            $(this).val('');
	            $('.errors').text('Загрузите изображение в формате jpg, gif, png');	
	            break;
	    }
	});
		
	$('#preview-button').on( "click", function(e) {
		e.preventDefault();
		var emailReg = /^[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,4}$/i;
		var userReg = /^[a-z0-9]{3,15}$/i;
		if ($('.input-user').val()=='' || (!(userReg.test($('.input-user').val())))) {
			$('.errors').text('Неправильный логин (3-15 символов)');
		} else if ($('.input-email').val()=='' || (!(emailReg.test($('.input-email').val())))) {
			$('.errors').text('Неправильный email');
		} else if ($('.input-task').val()=='') {
			$('.errors').text('Заполните текст задачи');
		} else if (!($(".input-img").val())) {
			$('.errors').text('Загрузите изображение');	
		}
	 	else { 			 		
			$('#preview-user').text($('.input-user').val());
			$('#preview-email').text($('.input-email').val());
			$('#preview-task').text($('.input-task').val());	
			$('#preview').show();		
	 	}
	});

	function readURL(input) {
	  if (input.files && input.files[0]) {
	    var reader = new FileReader();
	    reader.onload = function(e) {
	      $('#preview-image').attr('src', e.target.result);
	    }
	    reader.readAsDataURL(input.files[0]);
	  }
	}

});
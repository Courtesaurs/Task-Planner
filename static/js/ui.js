jQuery(document).ready(function($){

/*-------- Input Animations ----------*/

	$('.input__field').focusout(function(){ 
		if($.trim($(this).val()) == 0) {
			$(this).parent().removeClass('input--filled');
		} 
	});

	$('.input__field').focusin(function(){
		$(this).parent().addClass('input--filled');
	});
  
/*------------------------------------ */

/*-------- Burger Animations ----------*/

	$('#burger').click(function() {
		$('body').toggleClass('open-menu');
	});

/*------------------------------------ */
/*------------Popup task-------------- */

	$('#add-task-button').click(function(){
		$('.popup-add-task').addClass('open');
	});
	$('#close-popup').click(function(){
		$('.popup-add-task').removeClass('open');
	});

/*------------------------------------ */
	
	$('#time-task').datepicker({
		range: true,
		multipleDatesSeparator: ' - ',
		position: 'top left'
	}); 

});


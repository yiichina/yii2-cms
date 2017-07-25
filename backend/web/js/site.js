jQuery(document).ready(function () {
	$('input[type="radio"], input[type="checkbox"]').iCheck({
		checkboxClass: 'icheckbox_minimal',
		radioClass: 'iradio_minimal',
	});
	$('select').select2({
		width: '100%'
	});
	$('.btn-search').click(function(){
		$(this).toggleClass('active');
		$('.search').animate({
			height: 'toggle'
		});
	});
});
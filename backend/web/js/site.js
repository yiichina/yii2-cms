jQuery(document).ready(function () {
	$('input[type="radio"], input[type="checkbox"]').iCheck({
		checkboxClass: 'icheckbox_minimal',
		radioClass: 'iradio_minimal',
	});
	$('select').select2();
});
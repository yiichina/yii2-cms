jQuery(document).ready(function () {
	$('input[type="radio"], input[type="checkbox"]').iCheck({
		checkboxClass: 'icheckbox_minimal-blue',
		radioClass: 'iradio_minimal-blue',
	});
    $('input[name="selection_all"]').on('ifToggled', function (event) {
        var chkToggle;
        $(this).is(':checked') ? chkToggle = "check" : chkToggle = "uncheck";
        $('input[name="selection[]"]').iCheck(chkToggle);
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
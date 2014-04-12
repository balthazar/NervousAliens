$(document).ready(function() {

	$('.launch').click(function() {
		$('.intro').slideUp().fadeOut();
		setTimeout(function() {
			$('.game-container').slideDown().fadeIn();
		}, 500)

		$.ajax({
			url: 'php/init.php',
			method: 'POST',
			data: {init:true},
			success: function(res) {
				console.log(JSON.parse(res));
			}
		});
	});

});

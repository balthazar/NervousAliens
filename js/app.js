$(document).ready(function() {

	function addShip(name, x, y, o) {
		$('.grid').append('<div class="ship"></div>');
		var padding = $('.grid').offset();
		var niou = $('.grid div:last');
		niou.offset({ top: padding.top + y * 10, left: padding.left + x * 10 });
	}

	function loadGame() {
		$.ajax({
			url: 'php/init.php',
			method: 'POST',
			data: {init:true},
			success: function(res) {
				if (res !== "delog") {
					console.log(JSON.parse(res));
					res = JSON.parse(res);
					$('.intro').slideUp().fadeOut();
					setTimeout(function() {
						$('.game-container').slideDown().fadeIn();
						for(var i = 0; i < res.length; i++) {
							console.log(res[i]);
							addShip(res[i].name, res[i].x, res[i].y, res[i].orientation);
						}
					}, 500)
				}
			}
		});
	}

	$.ajax({
		url:'php/logged.php',
		success: function(res) {
			console.log(res);
			if (res === 'ok') {
				loadGame();
			}
		}
	});

	$('.launch').click(function() {
		loadGame();
	});

	$('.intro .register').click(function() {
		$('.loginBox').slideUp().fadeOut();
		$('.registerBox').slideDown().fadeIn();
	});

	$('.intro .login').click(function() {
		$('.loginBox').slideDown().fadeIn();
		$('.registerBox').slideUp().fadeOut();
	});

	$('.registerForm').submit(function(event) {
		var elems = $('.registerForm input');
		$(elems[0]).css('border-color', 'rgba(255, 255, 255, 0.1)');
		$(elems[1]).css('border-color', 'rgba(255, 255, 255, 0.1)');
		$(elems[2]).css('border-color', 'rgba(255, 255, 255, 0.1)');
		if (elems[0].value.length === 0) {
			$(elems[0]).css('border-color', 'rgb(187, 19, 19)');
		}
		else if (elems[1].value.length === 0) {
			$(elems[1]).css('border-color', 'rgb(187, 19, 19)');
		}
		else if (elems[2].value.length === 0) {
			$(elems[2]).css('border-color', 'rgb(187, 19, 19)');
		}
		else if (elems[1].value !== elems[2].value) {
			$(elems[2]).css('border-color', 'rgb(187, 19, 19)');
		}
		else {
			$.ajax({
				method: 'POST',
				url: 'php/register.php',
				data: {login: elems[0].value, password: elems[1].value },
				success: function(res) {
					if (res === 'ok') {
						$('.registerBox').fadeOut();
					}
					else if (res === 'already') {
						$(elems[0]).css('border-color', 'rgb(187, 19, 19)');
					}
					else {
						$(elems[0]).css('border-color', 'rgb(187, 19, 19)');
						$(elems[1]).css('border-color', 'rgb(187, 19, 19)');
						$(elems[2]).css('border-color', 'rgb(187, 19, 19)');
					}
				}
			});
		}
		event.preventDefault();
	});

	$('.loginForm').submit(function(event) {
		var elems = $('.loginForm input');
		$(elems[0]).css('border-color', 'rgba(255, 255, 255, 0.1)');
		$(elems[1]).css('border-color', 'rgba(255, 255, 255, 0.1)');
		if (elems[0].value.length === 0) {
			$(elems[0]).css('border-color', 'rgb(187, 19, 19)');
		}
		else if (elems[1].value.length === 0) {
			$(elems[1]).css('border-color', 'rgb(187, 19, 19)');
		}
		else {
			$.ajax({
				method: 'POST',
				url: 'php/login.php',
				data: {login: elems[0].value, password: elems[1].value },
				success: function(res) {
					if (res === 'ok') {
						$('.loginBox').fadeOut();
					}
					else {
						$(elems[0]).css('border-color', 'rgb(187, 19, 19)');
						$(elems[1]).css('border-color', 'rgb(187, 19, 19)');
					}
				}
			});
		}
		event.preventDefault();
	});

});

$(document).ready(function() {

	function addShip(name, x, y, o, img, type, id) {
		var width = (type === 'chasseur') ? 80 : 200;
		var ship = '<div class="ship" id="ship'+id+'"><img src="'+img+'" width="'+width+'"px></div>';
		$('.grid').append(ship);
		var padding = $('.grid').offset();
		var niou = $('.grid div:last');
		var orientation = ['north', 'east', 'south', 'west'];
		niou.addClass(orientation[o]);
		niou.offset({ top: padding.top + y, left: padding.left + x });
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
						for (var i = 0; i < res.length; i++) {
							console.log(res[i]);
							addShip(res[i].name, res[i].x, res[i].y, res[i].orientation, res[i].img, res[i].type, res[i].id);
						}
					}, 500)
				}
			}
		});
	}

	$.ajax({
		url:'php/logged.php',
		success: function(res) {
			if (res === 'ok') {
				loadGame();
			}
		}
	});

	$(document).on('click', '.ship', function() {
		var ship = $(this);
		var id = ship.attr('id').replace('ship', '');
		console.log(id);
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
		$(elems[0]).removeClass('error-border');
		$(elems[1]).removeClass('error-border');
		$(elems[2]).removeClass('error-border');
		if (elems[0].value.length === 0) {
			$(elems[0]).addClass('error-border');
		}
		else if (elems[1].value.length === 0) {
			$(elems[1]).addClass('error-border');
		}
		else if (elems[2].value.length === 0) {
			$(elems[2]).addClass('error-border');
		}
		else if (elems[1].value !== elems[2].value) {
			$(elems[2]).addClass('error-border');
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
						$(elems[0]).addClass('error-border');
					}
					else {
						$(elems[0]).addClass('error-border');
						$(elems[1]).addClass('error-border');
						$(elems[2]).addClass('error-border');
					}
				}
			});
		}
		event.preventDefault();
	});

	$('.loginForm').submit(function(event) {
		var elems = $('.loginForm input');
		$(elems[0]).removeClass('error-border');
		$(elems[1]).removeClass('error-border');
		if (elems[0].value.length === 0) {
			$(elems[0]).addClass('error-border');
		}
		else if (elems[1].value.length === 0) {
			$(elems[1]).addClass('error-border');
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
						$(elems[0]).addClass('error-border');
						$(elems[1]).addClass('error-border');
					}
				}
			});
		}
		event.preventDefault();
	});

});

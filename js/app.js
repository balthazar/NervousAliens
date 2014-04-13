$(document).ready(function() {

	var ships = [];
	var orientation = ['north', 'east', 'south', 'west'];
	var selected1 = 0;
	var selected2 = 5;
	var cptship1 = 5;
	var cptship2 = 5;

	function addShip(name, x, y, o, img, type, id) {
		var width = (type === 'chasseur') ? 80 : 200;
		var ship = '<div class="ship" id="ship'+id+'"><img src="'+img+'" width="'+width+'px"></div>';
		$('.grid').append(ship);
		var padding = $('.grid').offset();
		var niou = $('.grid div:last');
		niou.children().addClass(orientation[o]);
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
					ships = res;
					$('.intro').slideUp().fadeOut();
					setTimeout(function() {
						$('.game-container').slideDown().fadeIn();
						for (var i = 0; i < res.length; i++) {
							console.log(res[i]);
							addShip(res[i].name, res[i].x, res[i].y, res[i].orientation, res[i].img, res[i].type, res[i].id);
						}
					}, 500);
					resetShipInfos();
					$.ajax({
						url: 'php/getname.php',
						success: function(res) {
							$('.user').text(res);
						}
					});
				}
				else {
					$('.login').addClass('error-border');
					setTimeout(function() {
						$('.login').removeClass('error-border');
					}, 2000)
				}
			}
		});
	}

	function resetShipInfos(id) {
		$('.controllers .info').fadeIn();
		$('.controllers .info:first i:first-child').html('<span> '+ships[selected1].life+'</span>').removeClass('redcolor');
		$('.controllers .info:last i:first-child').html('<span> '+ships[selected2].life+'</span>').removeClass('redcolor');
		if (ships[selected1].life <= 0) {
			$('.controllers .info:first i:first-child').addClass('redcolor');
		}
		if (ships[selected2].life <= 0) {
			$('.controllers .info:last i:first-child').addClass('redcolor');
		}
		if (ships[selected1].type === 'base')
			$('.controllers .info:first i:last-child').hide();
		else {
			$('.controllers .info:first i:last-child').html('<span> '+ships[selected1].power+'</span>').fadeIn();
		}
		if (ships[selected2].type === 'base')
			$('.controllers .info:last i:last-child').hide();
		else {
			$('.controllers .info:last i:last-child').html('<span> '+ships[selected2].power+'</span>').fadeIn();
		}
		$('.selected:first').text(ships[selected1].name);
		$('.selected:last').text(ships[selected2].name);
	}

	function moveShip(id, dir) {
		var padding = $('.grid').offset();
		var or = ships[id].orientation;
		var y = ships[id].y;
		var x = ships[id].x;
		if (dir === 'up') {
			if (or == 0)
				y -= 20;
			else if (or == 1)
				x += 20;
			else if (or == 2)
				y += 20
			else if (or == 3)
				x -= 20;
		}
		else if (dir === 'down') {
			if (or == 0)
				y += 20;
			else if (or == 1)
				x -= 20;
			else if (or == 2)
				y -= 20
			else if (or == 3)
				x += 20;
		}
		ships[id].x = x;
		ships[id].y = y;
		if (x < 0 || x > 1500 || y < 0 || y > 1000) {
			ships[id].life = 0;
		}
		if (ships[id].life > 0) {
			$('#ship'+id).offset({ top: padding.top + y, left: padding.left + x });
		}
		else {
			$('#ship'+id).fadeOut();
			resetShipInfos();
		}
	}

	function rotateShip(id) {
		if (ships[id].life > 0) {
			$('#ship'+id+' img').attr('class', '').addClass(orientation[ships[id].orientation]);
		}
		else {
			$('#ship'+id).fadeOut();
		}
	}

	function checkWin() {
		if (cptship1 == 0) {
			
		}
		else if (cptship2 == 0) {
			
		}
	}

	function checkDead(id) {
		if (ships[id].life <= 0) {
			$('#ship'+id).fadeOut();
			if (id < 5)
				cptship1--;
			else if (id >= 5)
				cptship2--;
			checkWin();
		}
	}

	function checkAround(x, y, elem, id) {
		for (var i = 0; i < ships.length; i++) {
			if (i != id && ships[i].life > 0
				&& x - 50 < ships[i].x && x + 50 > ships[i].x
				&& y - 50 < ships[i].y && y + 50 > ships[i].y) {
				ships[i].life--;
				resetShipInfos();
				checkDead(i);
				console.log('hit');
				return;
			}
		}
	}

	function shoot(id) {
		if (ships[id].life > 0) {
			var shoot = '<div class="shoot"><img src="sprites/fire.gif" width="100px"></div>';
			$('.grid').append(shoot);
			var niou = $('.grid div:last');
			niou.children().addClass(orientation[ships[id].orientation]);
			niou.offset({ top: ships[id].y, left: ships[id].x });
			var or = orientation[ships[id].orientation];
			if (or == 'north') {
				niou.animate({
					top: '-=200%'
				}, {
					duration: 5000,
					step: function(now, fx){
						checkAround(ships[id].x, now * 10, niou, id);
					}
				});
			}
			else if (or == 'south') {
				niou.animate({
					top: '+=200%'
				}, {
					duration: 5000,
					step: function(now, fx){
						checkAround(ships[id].x, now * 10, niou, id);
					}
				});
			}
			else if (or == 'west') {
				niou.animate({
					left: '-=200%'
				}, {
					duration: 5000,
					step: function(now, fx){
						checkAround(now * 10, ships[id].y, niou, id);
					}
				});
			}
			else if (or == 'east') {
				niou.animate({
					left: '+=200%'
				}, {
					duration: 5000,
					step: function(now, fx){
						checkAround(now * 10, ships[id].y, niou, id);
					}
				});
			}
		}
	}

	$('.icon-lock2').click(function() {
		$.ajax({
			url: 'php/delog.php',
			success: function(res) {
				window.location.href="/";
			}
		});
	});

	$.ajax({
		url:'php/logged.php',
		success: function(res) {
			if (res === 'ok') {
				loadGame();
			}
		}
	});

	function keys(e) {
		if (e.which === 38) {
			//top 1
			moveShip(selected2, 'up');
		}
		else if (e.which === 39) {
			//right 1
			ships[selected2].orientation += (ships[selected2].orientation == 3) ? -3 : 1;
			rotateShip(selected2);
		}
		else if (e.which === 40) {
			//down 1
			moveShip(selected2, 'down');
		}
		else if (e.which === 37) {
			//left 1
			ships[selected2].orientation -= (ships[selected2].orientation == 0) ? -3 : 1;
			rotateShip(selected2);
		}
		else if (e.which === 87) {
			//up 2
			moveShip(selected1, 'up');
		}
		else if (e.which === 65) {
			//left 2
			ships[selected1].orientation -= (ships[selected1].orientation == 0) ? -3 : 1;
			rotateShip(selected1);
		}
		else if (e.which === 68) {
			//right 2
			ships[selected1].orientation += (ships[selected1].orientation == 3) ? -3 : 1;
			rotateShip(selected1);
		}
		else if (e.which === 83) {
			//down 2
			moveShip(selected1, 'down');
		}
		else if (e.which === 96) {
			//shoot p1
			shoot(selected2);
		}
		else if (e.which === 97) {
			//ship1 p1
			selected2 = 5;
			resetShipInfos(0);
		}
		else if (e.which === 98) {
			//ship2 p1
			selected2 = 6;
			resetShipInfos(0);
		}
		else if (e.which === 99) {
			//ship3 p1
			selected2 = 7;
			resetShipInfos(0);
		}
		else if (e.which === 100) {
			//ship4 p1
			selected2 = 8;
			resetShipInfos(0);
		}
		else if (e.which === 101) {
			//base p1
			selected2 = 9;
			resetShipInfos(0);
		}
		else if (e.which === 32) {
			//shoot p2
			shoot(selected1);
		}
		else if (e.which === 49) {
			//ship1 p2
			selected1 = 0;
			resetShipInfos(1);
		}
		else if (e.which === 50) {
			//ship2 p2
			selected1 = 1;
			resetShipInfos(1);
		}
		else if (e.which === 51) {
			//ship3 p2
			selected1 = 2;
			resetShipInfos(1);
		}
		else if (e.which === 52) {
			//ship4 p2
			selected1 = 3;
			resetShipInfos(1);
		}
		else if (e.which === 53) {
			//base p2
			selected1 = 4;
			resetShipInfos(1);
		}
		console.log(e.which);
	}

	$(document).keydown(function(e) {
		keys(e);
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
				data: { login: elems[0].value, password: elems[1].value },
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
						loadGame();
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

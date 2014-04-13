<!DOCTYPE html>
<html>
	<head>
		<title>Warhammer</title>
		<link rel="stylesheet" href="css/icomoon.css">
		<link rel="stylesheet" href="css/style.css">
		<link rel="stylesheet" href="css/compiled.css">

		<script src="bower_components/jquery/dist/jquery.js"></script>
		<script src="js/app.js"></script>
	</head>
	<body>
		<div class="back1"></div>
		<div class="back2"></div>
		<div class="back3"></div>
		<div class="back4"></div>
		<div class="main">
			<div class="intro">
				<a class="launch custom"><i class="icon-rocket"></i> Launch Game</a>
				<p>
					<a class="register custom">Register</a>
					<a class="login custom">Login</a>
				</p>
			</div>
			<div class="registerBox">
				<form class="registerForm">
					<input type="text" placeholder="Login">
					<input type="password" placeholder="Password">
					<input type="password" placeholder="Confirm">
					<br>
					<input type="submit">
				</form>
			</div>
			<div class="loginBox">
				<form class="loginForm">
					<input type="text" placeholder="Login">
					<input type="password" placeholder="Password">
					<br>
					<input type="submit">
				</form>
			</div>
			<p class="messageInfo"></p>
			<div class="game-container">
				<div class="grid">
<table>
<?php

	for ($i = 0; i < 1000; i++) {
		echo "<tr>\n";
		for (var $y = 0; y < 1500; y++) {
			echo "<td></td>\n";
		}
		echo "</tr>\n";
	}

?>
</table>
				</div>
				<hr class="custom">
				<div class="controllers">
					<i class="icon-undo custom"></i>
					<i class="icon-redo custom"></i>
					<i class="icon-disk custom"></i>
					<p>Ship selected : <span class="selected"></span></p>
				</div>
			</div>
		</div>
		<script src="//localhost:35729/livereload.js"></script>
	</body>
</html>
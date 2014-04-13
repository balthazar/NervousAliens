<!DOCTYPE html>
<html>
	<head>
		<title>Nervous Aliens</title>
		<link rel="stylesheet" href="css/icomoon.css">
		<link rel="stylesheet" href="css/style.css">
		<link rel="stylesheet" href="css/compiled.css">

		<script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
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
					<a class="delog custom"><i class="icon-switch"></i></a>
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
				</div>
				<div class="win"></div>
				<hr class="custom">
				<div class="controllers">
					<div class="flex">
						<p>Player 1 : <span class="selected">NONE</span>
							<span class="info hide">
								<i class="icon-heart2"></i>
								<i class="icon-lightning"></i>
							</span>
						</p>
						<p>Player 2 : <span class="selected">NONE</span>
							<span class="info hide">
								<i class="icon-heart2"></i>
								<i class="icon-lightning"></i>
							</span>
						</p>
						<p>Logged as <span class="user"></span><i class="icon-switch custom"></i></p>
					</div>
				</div>
			</div>
		</div>
		<script src="//localhost:35729/livereload.js"></script>
	</body>
</html>

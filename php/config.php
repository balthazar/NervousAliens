<?php

session_start();

function connect(){
	if (file_exists("../.credentials")) {
		$user = explode("\n", file_get_contents("../.credentials"));
		$link = mysqli_connect('localhost', $user[0], $user[1], 'rush2');
		if (!$link)
			die('Erreur de connexion ('.mysqli_connect_errno().') '.mysqli_connect_error());
		return ($link);
	}
	else {
		die('No cred file');
	}
}

function close($link){
	mysqli_close($link);
}

function auth($login, $password) {

	$db = connect();
	$login = mysqli_real_escape_string($db, $login);
	$result = mysqli_query($db, "SELECT * FROM users WHERE login = '".$login."' AND password = '".sha1($_POST['password'])."'");
	$tab = mysqli_fetch_assoc($result);
	if ($tab) {
		$_SESSION['id'] = $tab['id'];
		$_SESSION['login'] = $tab['login'];
		return true;
	}
	else {
		return false;
	}
	close($db);
}

function register($login, $password) {

	$db = connect();
	if ($db) {
		$login = mysqli_real_escape_string($db, $login);
		$password = sha1($password);
		$check = mysqli_query($db, "SELECT * FROM users WHERE login = '".$login."'");
		$tab = mysqli_fetch_assoc($check);
		if ($tab) {
			close($db);
			return "already";
		}
		$sql = "INSERT INTO users (id, login, password) VALUES (NULL, '".$login."', '".$password."')";
		if (!mysqli_query($db, $sql)) {
			close($db);
			return "error";
		}
		else {
			close($db);
			return "ok";
		}
	}
	else {
		return "error";
	}
}

?>

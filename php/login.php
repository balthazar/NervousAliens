<?php

include('config.php');

if (isset($_POST['login']) && isset($_POST['password'])) {
	if ($_POST['login'] !== '' && $_POST['password'] !== '') {
		if (auth($_POST['login'], $_POST['password']) === true) {
			echo "ok";
		}
		else {
			echo "error";
		}
	}
	else {
		echo "error";
	}
}

?>

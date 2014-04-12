<?php

include('config.php');

if (isset($_POST['login']) && isset($_POST['password'])) {
	if ($_POST['login'] !== '' && $_POST['password'] !== '') {
		$res = register($_POST['login'], $_POST['password']);
		if ($res == "ok") {
			echo "ok";
		}
		else if ($res == "already") {
			echo "already";
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

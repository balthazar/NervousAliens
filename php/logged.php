<?php

session_start();

if (isset($_SESSION['login'])) {
	echo "ok";
}
else {
	echo "no";
}

?>

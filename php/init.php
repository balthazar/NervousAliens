<?php

include ('../classes/Game.class.php');
session_start();

if (!isset($_SESSION['login'])) {
	echo "delog";
}
else {

	$game = new Game('j1', 'j2');
	echo json_encode($game->getListShip());
}

?>

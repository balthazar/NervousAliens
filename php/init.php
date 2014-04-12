<?php

session_start();

if (!isset($_SESSION['login'])) {
	echo "delog";
}
else {
	if (isset($_POST['init'])) {
		$tab = array(
			0 => array(
				'id' => '0',
				'name' => 'ok',
				'x' => 10,
				'y' => 10,
				'orientation' => 1
			),
			1 => array(
				'id' => '1',
				'name' => 'oefk',
				'x' => 10,
				'y' => 20,
				'orientation' => 1
			),
			2 => array(
				'id' => '2',
				'name' => 'adok',
				'x' => 100,
				'y' => 10,
				'orientation' => 3
			),
			3 => array(
				'id' => '3',
				'name' => 'grok',
				'x' => 100,
				'y' => 20,
				'orientation' => 3
			),
			4 => array(
				'id' => '4',
				'name' => 'fffoffk',
				'x' => 100,
				'y' => 30,
				'orientation' => 3
			)
		);
		echo json_encode($tab);
	}
}

?>

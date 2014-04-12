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
				'name' => 'ok'
			),
			1 => array(
				'id' => '1',
				'name' => 'oefk'
			),
			2 => array(
				'id' => '2',
				'name' => 'adok'
			),
			3 => array(
				'id' => '3',
				'name' => 'grok'
			),
			4 => array(
				'id' => '4',
				'name' => 'fffoffk'
			)
		);
		echo json_encode($tab);
	}
}

?>

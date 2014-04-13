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
				'x' => 200,
				'y' => 10,
				'orientation' => 1,
				'img' => 'sprites/black/black1.png',
				'race' => 0,
				'type' => 'chasseur',
				'life' => 10,
				'dmg' => 2
			),
			1 => array(
				'id' => '1',
				'name' => 'oefk',
				'x' => 200,
				'y' => 100,
				'orientation' => 1,
				'img' => 'sprites/black/black2.png',
				'race' => 0,
				'type' => 'chasseur',
				'life' => 10,
				'dmg' => 3
			),
			2 => array(
				'id' => '2',
				'name' => 'adok',
				'x' => 200,
				'y' => 200,
				'orientation' => 1,
				'img' => 'sprites/black/black3.png',
				'race' => 0,
				'type' => 'chasseur',
				'life' => 10,
				'dmg' => 5
			),
			3 => array(
				'id' => '3',
				'name' => 'adok',
				'x' => 200,
				'y' => 300,
				'orientation' => 1,
				'img' => 'sprites/black/black4.png',
				'race' => 0,
				'type' => 'chasseur',
				'life' => 20,
				'dmg' => 10
			),
			4 => array(
				'id' => '4',
				'name' => 'adok',
				'x' => 200,
				'y' => 500,
				'orientation' => 1,
				'img' => 'sprites/black/baseblack.png',
				'race' => 0,
				'type' => 'base',
				'life' => 200
			),
			5 => array(
				'id' => '5',
				'name' => 'grok',
				'x' => 1400,
				'y' => 50,
				'orientation' => 3,
				'img' => 'sprites/alien/alien1.png',
				'race' => 1,
				'type' => 'chasseur',
				'life' => 10,
				'dmg' => 2
			),
			6 => array(
				'id' => '6',
				'name' => 'fffoffk',
				'x' => 1400,
				'y' => 150,
				'orientation' => 3,
				'img' => 'sprites/alien/alien2.png',
				'race' => 1,
				'type' => 'chasseur',
				'life' => 10,
				'dmg' => 3
			),
			7 => array(
				'id' => '7',
				'name' => 'grlolok',
				'x' => 1400,
				'y' => 300,
				'orientation' => 3,
				'img' => 'sprites/alien/alien3.png',
				'race' => 1,
				'type' => 'chasseur',
				'life' => 10,
				'dmg' => 5
			),
			8 => array(
				'id' => '8',
				'name' => 'grok',
				'x' => 1400,
				'y' => 520,
				'orientation' => 3,
				'img' => 'sprites/alien/alien4.png',
				'race' => 1,
				'type' => 'chasseur',
				'life' => 20,
				'dmg' => 10
			),
			9 => array(
				'id' => '9',
				'name' => 'grok',
				'x' => 1200,
				'y' => 700,
				'orientation' => 3,
				'img' => 'sprites/alien/basealien.png',
				'race' => 1,
				'type' => 'base',
				'life' => 200
			)
		);
		echo json_encode($tab);
	}
}

?>

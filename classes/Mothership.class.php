<?php

require_once("Ship.class.php");

class Mothership extends Ship {

	public function __construct ( array $kwargs ){
		parent::__construct($kwargs);
	}

	public function setWeapons(){
		$this->_weapons = null;
	}

	public static function doc() {
		if (file_exists('Mothership.doc.txt')) {
			print(file_get_contents('Mothership.doc.txt'));
		}
		return "No doc.";
	}
}

?>

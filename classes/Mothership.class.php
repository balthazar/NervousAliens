<?php

require_once("Ship.class.php");

class Mothership extends Ship {

	public function __construct ( array $kwargs ){
		parent::__construct($kwargs);
	}

	public function setWeapons(){
		$this->_weapons = null;
	}
}

?>

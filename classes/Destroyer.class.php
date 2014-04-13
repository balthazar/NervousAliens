<?php

require_once("Ship.class.php");
require_once("Laser.class.php");

class Destroyer extends Ship {

	protected $_size = array('x' => 4, 'y' => 4);
	protected $_lives = 10;
	protected $_speed = 10;
	protected $_shields = 0;
	protected $_PP = 8;
	protected $_activate = False;
	protected $_boost = 0;
	protected $_maxMove = 0;
	protected $_weapons;
	protected $_power;

	public function __construct ( array $kwargs ){
		$this->setWeapons();
		$this->_power = $kwargs['power'];
		parent::__construct($kwargs);
	}

	public function setWeapons(){
		$gun1 = new Laser( 1 );
		$gun2 = new Laser( 2 );
		$this->_weapons = array('1' => $gun1, '2' => $gun2);
	}
}

?>

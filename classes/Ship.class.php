<?php

abstract class Ship {

	public static $verbose = false;

	private $_id;
	private $_name;
	private $_coordX;
	private $_coordY;
	private $_orientation;
	protected $_size;
	protected $_image;
	protected $_life;
	protected $_power;
	protected $_speed;
	protected $_shields = 0;
	protected $_PP;
	protected $_activate = False;
	protected $_boost = 0;
	protected $_maxMove = 0;
	protected $_weapons;

	public function __construct ( array $kwargs ){
		if ( array_key_exists( 'id', $kwargs )
			&& array_key_exists( 'name', $kwargs )
			&& array_key_exists( 'x', $kwargs )
			&& array_key_exists( 'y', $kwargs )
			&& array_key_exists( 'img', $kwargs )
			&& array_key_exists( 'life', $kwargs )
			&& array_key_exists( 'orientation', $kwargs ) )
		{
			$this->_id = $kwargs['id'];
			$this->_name = $kwargs['name'];
			$this->_coordX = $kwargs['x'];
			$this->_coordY = $kwargs['y'];
			$this->_image = $kwargs['img'];
			$this->_orientation = $kwargs['orientation'];
			$this->_life = $kwargs['life'];
		}
		else
			die("Error processing data");
		if (self::$verbose)
			print( $this . " constructed" . PHP_EOL );
	}

	public function __toString () {
		print( "id: $this->_id, name: $this->_name" . PHP_EOL );
	}

	public function __destruct () {
		if (self::$verbose)
			print( $this . " destructed" . PHP_EOL );
	}

	public function getId(){return $this->_id; }
	public function getPP(){return $this->_PP; }
	public function getActivate(){return $this->_activate; }
	public function getX(){return $this->_coordX; }
	public function getY(){return $this->_coordY; }
	public function getOrientation(){return $this->_orientation; }
	public function getSize(){return $this->_size; }
	public function setPP($pp){$this->_PP = $pp; }
	public function setX($x){$this->_coordX = $x; }
	public function setY($y){$this->_coordY = $y; }
	public function setOrientation($o){$this->_orientation = $o; }
	public function setActivate( bool $f ){	$this->_activate = $f; }

	abstract public function setWeapons();

	public static function doc() {
		if (file_exists('Ship.doc.txt')) {
			print(file_get_contents('Ship.doc.txt'));
		}
		return "No doc.";
	}

	public function play( array $allShips ){
		$this->activate = True;
		$this->order();
		$this->move();
		$this->shoot( $allShips );
	}

	private function order( ){
		$res = $this->PP_to_send($this);
		$this->_shield = $res['shields'];
		$this->_boost = $res['boost'];
		foreach ($res['weapon'] as $id => $pp) {
			$this->weapon[$id]->setAmmunition($pp);
		}
	}
	private function move() {
		$this->_maxMove = $this->_speed + $this->_boost;
		$res = $this->moveShip( $this );
		$this->_coordX = $res['x'];
		$this->_coordY = $res['y'];
		$this->_orientation = $res['orientation'];
	}

	private function shoot( array $allShips ) {
		foreach ($this->_weapons as $gun)
		{
			if ( $gun->getAmmunition > 0 )
				$gun->shoot( $allShips );

		}
	}

	public function reset() {
		$this->_boost = 0;
		$this->_maxMove = 0;
		$this->_activate = False;
	}

	private function getWeaponById($id)
	{
		foreach ($this->_weapons as $w)
		{
			if ($w->getId() == $id)
				return $w;
		}
	}

	public function getData () {

		$weapons = array();
		if ($this->_weapons !== null) {
			foreach ($this->_weapons as $w)
			{
				$weapon = array('id' => $w->getId(), 'ammunition' => $w->getAmmunition());
				array_push($weapons, $weapon);
			}
		}

		$type = ($this instanceof Destroyer) ? 'chasseur' : 'base';

		return array(
			'id' => $this->_id,
			'name' => $this->_name,
			'x' => $this->_coordX,
			'y' => $this->_coordY,
			'pp' => $this->_PP,
			'orientation' => $this->_orientation,
			'size' => $this->_size,
			'life' => $this->_life,
			'power' => $this->_power,
			'weapons' => $weapons,
			'img' => $this->_image,
			'type' => $type
		);
	}

	public function setData($array)
	{
		$this->setX($array['x']);
		$this->setY($array['y']);
		$this->setPP($array['pp']);
		$this->setOrientation($array['orientation']);
		foreach ($array['weapons'] as $w)
		{
			$weapon = $this->getWeaponById($w['id']);
			$weapon->setAmmunition($w['ammunition']);
		}
	}

}
?>

<?PHP
require_once("Player.class.php");
require_once("Destroyer.class.php");
require_once("Mothership.class.php");

final Class Game
{
	public static $verbose = false;
	private $_p1;
	private $_p2;
	private $_grid;
	private $_turn = 0;

	const NORTH = 0;
	const EAST = 1;
	const SOUTH = 2;
	const WEST = 3;

	public function __construct($p1, $p2)
	{
		$ships_p1 = array(
			new Destroyer (array(
				'id' => '0',
				'name' => 'Imperatum',
				'x' => 200,
				'y' => 10,
				'orientation' => Game::EAST,
				'img' => 'sprites/black/black1.png',
				'race' => 0,
				'life' => 10,
				'power' => 2
			)),
			new Destroyer (array(
				'id' => '1',
				'name' => 'Ergosum',
				'x' => 200,
				'y' => 100,
				'orientation' => Game::EAST,
				'img' => 'sprites/black/black2.png',
				'race' => 0,
				'life' => 20,
				'power' => 3
			)),
			new Destroyer (array(
				'id' => '2',
				'name' => 'Patria',
				'x' => 200,
				'y' => 200,
				'orientation' => Game::EAST,
				'img' => 'sprites/black/black3.png',
				'race' => 0,
				'life' => 50,
				'power' => 5
			)),
			new Destroyer (array(
				'id' => '3',
				'name' => 'QuickDeath',
				'x' => 200,
				'y' => 300,
				'orientation' => Game::EAST,
				'img' => 'sprites/black/black4.png',
				'race' => 0,
				'life' => 100,
				'power' => 10
			)),
			new Mothership (array(
				'id' => '4',
				'name' => 'BlackFlake',
				'x' => 200,
				'y' => 500,
				'orientation' => Game::EAST,
				'img' => 'sprites/black/baseblack.png',
				'race' => 0,
				'life' => 300
			))
		);
		$ships_p2 = array(
			new Destroyer ( array(
				'id' => '5',
				'name' => 'Second Son',
				'x' => 1400,
				'y' => 50,
				'orientation' => Game::WEST,
				'img' => 'sprites/alien/alien1.png',
				'race' => 1,
				'life' => 10,
				'power' => 2
			)),
			new Destroyer (array(
				'id' => '6',
				'name' => 'Pinky',
				'x' => 1400,
				'y' => 150,
				'orientation' => Game::WEST,
				'img' => 'sprites/alien/alien2.png',
				'race' => 1,
				'life' => 20,
				'power' => 3
			)),
			new Destroyer (array(
				'id' => '7',
				'name' => 'Tentacle Nightmare',
				'x' => 1400,
				'y' => 300,
				'orientation' => Game::WEST,
				'img' => 'sprites/alien/alien3.png',
				'race' => 1,
				'life' => 50,
				'power' => 5
			)),
			new Destroyer (array(
				'id' => '8',
				'name' => 'Poulp',
				'x' => 1400,
				'y' => 520,
				'orientation' => Game::WEST,
				'img' => 'sprites/alien/alien4.png',
				'race' => 1,
				'life' => 100,
				'power' => 10
			)),
			new Mothership (array(
				'id' => '9',
				'name' => 'Grine',
				'x' => 1200,
				'y' => 700,
				'orientation' => Game::WEST,
				'img' => 'sprites/alien/basealien.png',
				'race' => 1,
				'life' => 300
			))
		);

		$this->_listShip = array_merge($ships_p1, $ships_p2);
		$this->_p1 = new Player($p1, $ships_p1, $this->_listShip);
		$this->_p2 = new Player($p2, $ships_p2, $this->_listShip);
		if (Game::$verbose == true)
			print ("Game constructed" . PHP_EOL);
	}

	private function turn()
	{
		if ($this->_turn)
			$this->_turn = 0;
		else
			$this->_turn = 1;
		$this->_p1->play();
		$this->_p2->play();
	}

	private function resetAll()
	{
		$ships = $this->_p1->getShips();
		$ship2s = $this->_p2->getShips();
		foreach ($ships as $ship)
			$ship->reset();
		foreach ($ships2 as $ship)
			$ship->reset();
	}

	public static function rollDice()
	{
		return (rand(1, 6));
	}

	public static function winner($p1, $p2)
	{
		if (count($p1->getShips()) == 0 && count($p2->getShips()) > 0)
			print($p2->getName()." won");
		if (count($p1->getShips()) > 0 && count($p2->getShips()) == 0)
			print($p1->getName()." won");
		if (count($p1->getShips()) == 0 && count($p2->getShips()) ==  0)
			print("draw");
	}
	public static function doc()
	{
		if (file_exists("Game.doc.txt"))
			return (file_get_contents("Game.doc.txt"));
		return "No doc.";
	}

	public function __destruct()
	{
		if (Game::$verbose == true)
			print ("Game destructed" . PHP_EOL);
	}

	public function __toString()
	{
		if (Game::$verbose === true)
			return "(Game $this->_p1, $this->_p2)";
	}

	public function getListShip () {
		$res = array();
		foreach ($this->_listShip as $ship) {
			array_push($res, $ship->getData());
		}
		return $res;
	}

	private function getShipById($id)
	{
		foreach ($this->_listShip as $ship)
		{
			if ($ship->getId() == $id)
				return $ship;
		}
	}

	public function setListShip ($array)
	{
		foreach ($array as $elem)
		{
			$ship = $this->getShipById($elem['id']);
			$ship->setData($elem);
		}
	}
}

?>

<?PHP

include_once('IWeapon.class.php');

Class Laser implements IWeapon
{
    private $_id;
    private $_name;
    private $_ammunition = 0;
    private $_weapon_position;
    public static $verbose = False;

    public function __construct($id)
    {
        $this->_id = $id;
        $this->_name = "laser";
        if (self::$verbose)
            print("Laser instance constructed");
    }

    public function setAmmunition($a)
    {
        $this->_ammunition = $a;
    }

    public function getAmmunition()
    {
        return $this->_ammunition;
    }

	public function getId()
	{
		return $this->_id;
	}

    public function shoot($listShips, $current)
    {
        $range = Game::rollDice();
        if ($range == 5)
            $range = 60;
        else if ($range == 6)
            $range = 80;
        else
            $range = 40;

        if ($current->getSize() % 2 != 0)
        {
            if ($current->getOrientation() == Game::EAST)
                $this->_weapon_position = array($current->getX() + $current->getSize() - 1, $current->getY() + round($current->getSize() / 2) - 1);
            else if ($current->getOrientation() == Game::WEST)
                $this->_weapon_position = array($current->getX(), $current->getY() + round($current->getSize() / 2) - 1);
            else if ($current->getOrientation() == Game::SOUTH)
                $this->_weapon_position = array($current->getX() + round($current->getSize() / 2) - 1, $current->getY() + $current->getSize() - 1);
            else if ($current->getOrientation() == Game::NORTH)
                $this->_weapon_position = array($current->getX() + round($current->getSize() / 2) - 1, $current->getY());
        }
        else
        {
            if ($current->getOrientation() == Game::EAST)
                $this->_weapon_position = array($current->getX() + $current->getSize() - 1, $current->getY() + $current->getSize() / 2);
            else if ($current->getOrientation() == Game::WEST)
                $this->_weapon_position = array($current->getX(), $current->getY() + $current->getSize() / 2 - 1);
            else if ($current->getOrientation() == Game::SOUTH)
                $this->_weapon_position = array($current->getX() + $current->getSize() / 2 - 1, $current->getY() + $current->getSize() - 1);
            else if ($current->getOrientation() == Game::NORTH)
                $this->_weapon_position = array($current->getX() + $current->getSize() / 2 - 1, $current->getY());
        }
        $i = 0;
        $laserx = $this->_weapon_position[0];
        $lasery = $this->_weapon_position[1];
        while ($i < $range)
        {
            if ($current->getOrientation() == Game::EAST)
                $laserx++;
            else if ($current->getOrientation() == Game::WEST)
                $laserx--;
            else if ($current->getOrientation() == Game::SOUTH)
                $lasery++;
            else if ($current->getOrientation() == Game::NORTH)
                $lasery--;
            foreach ($listShips as $ships)
            {
                $w = 0;
                while ($w < $ships->getSize())
                {
                    $h = 0;
                    while ($h < $ships->getSize())
                    {
                        if ($ships->getX() + $w == $laserx && $ships->getY() + $h == $lasery)
                        {
                            $ships->setLives($ships->getLives() - 3);
                            return ;
                        }
                        $h++;
                    }
                    $w++;
                }
            }
            $i++;
        }
    }
}

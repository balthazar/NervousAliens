<?php

final class Player
{
	public static	$verbose = FALSE;
	private			$_name;
	private			$_ships = array();
	private			$_all_ships = array();

	public function		__construct($name_given, array $ships_given, array $all_ships_given)
	{
		if (!empty($name_given))
		{
			$this->_name = $name_given;
			if (!empty($ships_given) && !empty($all_ships_given))
			{
				foreach ($ships_given as $elem)
					$this->_ships[] = $elem;
				foreach ($all_ships_given as $elem)
					$this->_all_ships[] = $elem;
			}
			else
			{
				print("Error: ships' assignation for player " .$this->_name." failed.\n");
				exit;
			}
		}
		else
		{
			print ("Error: name's assignation for player failed.\n");
			exit;
		}
		if (self::$verbose === TRUE)
			print($this. " constructed.\n");
	}

	public function		doc()
	{
		$file = "No documentation for this class.";

		if (file_exists("./Player.doc.txt"))
			$file = file_get_contents("./Player.doc.txt");
		return ($file);
	}

	public function		getName()
	{
		return ($this->_name);
	}

	public function		getShips()
	{
		return ($this->_ships);
	}

	private function	canPlay()
	{
		$i = 0;

		foreach($this->_ships as $elem)
		{
			if ($elem->getActivate() === FALSE)
				$i++;
		}
		if ($i > 0)
			return (TRUE);
		else
			return (FALSE);
	}

	private function	selectShip()
	{
		//TODO, given by POST.
	}

	public function		play()
	{
		if (canPlay() === TRUE)
		{
			$id_ship = selectShip();
			$this->_ships[$id_ships]->play($this->_all_ships);
			if (self::$verbose === TRUE)
				print($this->_name." can play.");
			return (TRUE);
		}
		else
		{
			if (self::$verbose === TRUE)
				print($this->_name." can't play.");
			return (FALSE);
		}
	}

	public function		__toString()
	{
		$result = "Player (\"" .$this->_name. "\", ";
		foreach($this->_ships as $key => $elem)
		{
			if ($key != count($this->_ships) - 1)
				$result .= $elem. ", ";
			else
				$result .= $elem;
		}
		$result .= ")";
		return ($result);
	}

	public function		__destruct()
	{
		if (self::$verbose === TRUE)
			print($this. " destructed.\n");
	}
}

?>

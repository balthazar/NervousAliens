<?PHP
interface IWeapon
{
	public function shoot($listShips, $current);

    public function setAmmunition($a);
	public function getAmmunition();
	public function getId();
}
?>

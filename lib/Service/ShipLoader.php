<?php


class ShipLoader
{
    private $pdo;

    public function __construct(PDO $pdo)
    {
      $this->pdo = $pdo;
    }

    /**
     * @return AbstractShip[]
     */
    public function getShips()
    {
        $shipsData = $this->queryForShips();
        $ships = array();

        foreach ($shipsData as $shipData) {

            $ships[] = $this->createShipFromData($shipData);
        }

        return $ships;
    }

    /**
     * @param $id
     * @return Ship|null
     */
    public function findOneById($id)
    {
        $pdo = $this->getPDO();
        $statement = $pdo->prepare('SELECT * FROM ship where id = :id');
        $statement->execute(array('id'=> $id));
        $shipArray = $statement->fetch(PDO::FETCH_ASSOC);

        if (!$shipArray) {
            return null;
        }

        return $this->createShipFromData($shipArray);
    }

    /**
     * @param array $shipData
     * @return Ship
     * @throws Exception
     */
    private function createShipFromData(array  $shipData)
    {
        if ($shipData['team'] == 'rebel') {
            $ship = new RebelShip($shipData['name']);
        } else {
            $ship = new Ship($shipData['name']);
            $ship->setJediFactor($shipData['jedi_factor']);

        }
        $ship->setId($shipData['id']);
        $ship->setWeaponPower($shipData['weapon_power']);
        $ship->setStrength($shipData['strength']);

        return $ship;
    }

    /**
     * @return array
     */
    private function queryForShips()
    {
        $pdo = $this->getPDO();
        $statement = $pdo->prepare('SELECT * FROM ship');
        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * @return PDO
     */
    private function getPDO(){

        return $this->pdo;
    }

}
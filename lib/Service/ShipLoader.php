<?php


class ShipLoader
{
    private $shipStorage;

    public function __construct(PdoShipStorage $shipStorage)
    {
      $this->shipStorage = $shipStorage;
    }

    /**
     * @return AbstractShip[]
     */
    public function getShips()
    {
        $shipsData = $this->shipStorage->fetchAllShipData();
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
        $shipArray = $this->shipStorage->fetchSingleShipData($id);

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


}
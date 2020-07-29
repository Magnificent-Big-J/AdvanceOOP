<?php

namespace Service;


class Container
{
    private $configuration;
    private $pdo;
    private $shipLoader;
    private $shipStorage;
    private $battleManager;

    /**
     * Container constructor.
     * @param $configuration
     */
    public function __construct($configuration)
    {
        $this->configuration = $configuration;
    }

    /**
     * @return PDO
     */
    public function getPDO()
    {
        if ($this->pdo === null ) {
            $this->pdo = new \PDO(
                $this->configuration['db_dsn'],
                $this->configuration['db_user'],
                $this->configuration['db_pass']);
            $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        }


        return $this->pdo;
    }

    /**
     * @return ShipLoader
     */
    public function getShipLoader()
    {
        if($this->shipLoader === null) {
            $this->shipLoader = new ShipLoader($this->getShipStorage());
        }

        return $this->shipLoader;
    }

    /**
     * @return BattleManager
     */
    public function getBattleManager()
    {
        if($this->battleManager === null) {
            $this->battleManager = new BattleManager();
        }

        return $this->battleManager;
    }
    /**
     * @return ShipStorageInterface
     */
    public function getShipStorage()
    {
        if($this->shipStorage === null) {
            $this->shipStorage = new PdoShipStorage($this->getPDO());
        }

        return $this->shipStorage;
    }

}
<?php

interface ShipStorageInterface
{
    /**
     * @return array
     */
     public function fetchAllShipsData();

    /**
     * @param $id
     * @return array
     */
     public function fetchSingleShipData($id);
}
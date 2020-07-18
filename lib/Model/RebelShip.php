<?php

class RebelShip extends AbstractShip
{
    /**
     * @return string
     */
    public function getType()
    {
       return 'Rebel';
    }

    /**
     * @return bool
     */
    public function isFunctional()
    {
        return true;
    }

    /**
     * @param bool $useShortFormat
     * @return string
     */
    public function getNameAndSpecs($useShortFormat = false)
    {
        $val = parent::getNameAndSpecs($useShortFormat);
        $val .= ' (Rebel)';

        return  $val;
    }

    public function getJediFactor()
    {
        return rand(10, 30);
    }
}
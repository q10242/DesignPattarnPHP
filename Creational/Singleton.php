<?php

/**
 * singletone class
 */
class SingleInstance
{
    private static $_instance;
    

    public function getInstance()
    {
        if ($this->_instance == null) {
            $this->_instance = new self();
        }
        return self::$_instance;
    }

}
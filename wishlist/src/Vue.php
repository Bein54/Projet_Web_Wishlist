<?php


namespace wishlist;


class Vue
{
    private $selecteur;
    private $elem;

    public function __construct($elem, $selecteur)
    {
        $this->$selecteur = $selecteur;
        $this->elem = $elem;
    }

    function renderer(){
        switch ($this->selecteur){

        }
    }
}
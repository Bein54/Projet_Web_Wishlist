<?php


namespace wishlist\controllers;

use Slim\Http\Request;
use Slim\Http\Response;
use wishlist\models\Item;
use wishlist\models\Liste;

class ControleurCreation
{
    private $c;

    public function __construct(\Slim\Container $c){
        $this->c = $c;
    }
    public function getFormulaire(Request $rq,Response $rs, array $args): Response {
        return $rs;
    }
}
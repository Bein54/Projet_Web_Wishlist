<?php


namespace wishlist\controleur;


use http\Env\Response;
use wishlist\models\Item;
use wishlist\models\Liste;
use wishlist\vue\VueParticipant;

class ControleurParticipation
{
    private $c;

    public function __construct(\Slim\Container $c){
        $this->c = $c;
    }
    function fairQQC (Request $rq,Response $rs, array $args): Response{
        $path = $rq->getURI()->getBasePath();

    }
}
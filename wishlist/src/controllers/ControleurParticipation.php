<?php


namespace wishlist\controllers;


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
    public function getListeSouhaits($rq, $rs, $args){
        $path = $rq->getURI()->getBasePath();

       // if (! isset($_SESSION['profile'])) {
       //     $vue = new VueCompte("", $path);
       //     $html = $vue->render(2);
       // }
       // else {
            $listes = \wishlist\models\Liste::select("*")
                //->where('user_id', '=', $_SESSION['profile']['id'])
                ->get();

            $vue = new \wishlist\views\VueParticipant( $listes->toArray());
            $html = $vue->render( 1 );
        //}

        $rs->getBody()->write($html);
        return $rs;
    }


}
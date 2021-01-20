<?php


namespace wishlist\controllers;


use Slim\Http\Response;
use Slim\Http\Request;
use wishlist\models\Item;
use wishlist\models\Liste;
use wishlist\models\Reservation;
use wishlist\views\VueParticipant;

class ControleurParticipation
{
    private $c;

    public function __construct(\Slim\Container $c){
        $this->c = $c;
    }

    public function getListeSouhaits (Request $rq,Response $rs, array $args): Response {
        $htmlvars = [
            'basepath' => $rq->getUri()->getBasePath()
        ];
        $listes = \wishlist\models\Liste::query()->select('*')
            ->get();
        $vue = new \wishlist\views\VueParticipant( $listes->toArray(), $this->c);
        $html = $vue->render($htmlvars, 1 );

        $rs->getBody()->write($html);
        return $rs;
    }

    public function getItemsListe(Request $rq,Response $rs, array $args): Response {
        $htmlvars = [
            'basepath' => $rq->getUri()->getBasePath()
        ];
        $no = intval($args['no']);


        $liste = \wishlist\models\Liste::query()->select('*')
            ->where('no', '=', $no)
            ->get();
        $items = \wishlist\models\Item::query()->select('*')
        ->where('liste_id', '=', $no)
        ->get();

        $elem = array($liste->toArray() ,$items );
        $vue = new \wishlist\views\VueParticipant($elem , $this->c);
        $html = $vue->render($htmlvars, 2 );

        $rs->getBody()->write($html);
        return $rs;
    }





    public function getItem(Request $rq,Response $rs, array $args): Response {
        $htmlvars = [
            'basepath' => $rq->getUri()->getBasePath()
        ];
        $id = $args['id'] ; 
        

        $item = \wishlist\models\Item::query()->select('*')
        ->where('id', '=', $id)
        ->get();
        

        $reserv = \wishlist\models\Reservation::query()->select('*')
        ->where('idItem', '=', $id)
        ->get();
        $elem = array($reserv ,$item );
        $vue = new \wishlist\views\VueParticipant($elem, $this->c);
        $html = $vue->render($htmlvars, 3 );
        

        $rs->getBody()->write($html);
        return $rs;
    }

    public function getUrl(Request $rq,Response $rs, array $args): Response {
        $htmlvars = [
            'basepath' => $rq->getUri()->getBasePath()
        ];
        $no = intval($args['no']);

        $liste = \wishlist\models\Liste::query()->select('*')
            ->where('no', '=', $no)
            ->get();
        $items = \wishlist\models\Item::query()->select('*')
        ->where('liste_id', '=', $no)
        ->get();

        $elem = array($liste->toArray() ,$items );
        $vue = new \wishlist\views\VueParticipant($elem , $this->c);
        $html = $vue->render($htmlvars, 4 );

        $rs->getBody()->write($html);
        return $rs;
    }
}
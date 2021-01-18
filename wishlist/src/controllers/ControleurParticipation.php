<?php


namespace wishlist\controllers;


use Slim\Http\Response;
use Slim\Http\Request;
use wishlist\models\Item;
use wishlist\models\Liste;
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
        // session start avant d'utiliser session
       // if (! isset($_SESSION['profile'])) {
       //     $vue = new VueCompte("", $path);
       //     $html = $vue->render(2);
       // }
       // else {
            $listes = \wishlist\models\Liste::query()->select('*')
                ->get();
                //->where('user_id', '=', $_SESSION['profile']['id'])
            $vue = new \wishlist\views\VueParticipant( $listes->toArray(), $this->c);
            $html = $vue->render($htmlvars, 1 );
        //}

        $rs->getBody()->write($html);
        return $rs;
    }

    public function getItemsListe(Request $rq,Response $rs, array $args): Response {
        $htmlvars = [
            'basepath' => $rq->getUri()->getBasePath()
        ];
        $no = intval($args['no']);

        // session start avant d'utiliser session
        // if (! isset($_SESSION['profile'])) {
        //     $vue = new VueCompte("", $path);
        //     $html = $vue->render(2);
        // }
        // else {
        $liste = \wishlist\models\Liste::query()->select('*')
            //je sais pas ce que c'est mais t'avais pas le bon args
            //->where('token', '=', $args['no'])
            ->where('no', '=', $no)
            ->get();
        $items = \wishlist\models\Item::query()->select('*')
        ->where('liste_id', '=', $no)
        ->get();
        //->where('user_id', '=', $_SESSION['profile']['id'])

        $elem = array($liste->toArray() ,$items );
        $vue = new \wishlist\views\VueParticipant($elem , $this->c);
        $html = $vue->render($htmlvars, 2 );
        //}

        $rs->getBody()->write($html);
        return $rs;
    }





    public function getItem(Request $rq,Response $rs, array $args): Response {
        $htmlvars = [
            'basepath' => $rq->getUri()->getBasePath()
        ];
        $id = $args['id'] ; 
        // session start avant d'utiliser session
        // if (! isset($_SESSION['profile'])) {
        //     $vue = new VueCompte("", $path);
        //     $html = $vue->render(2);
        // }
        // else {

        $item = \wishlist\models\Item::query()->select('*')
        ->where('id', '=', $id)
        ->get();
        //->where('user_id', '=', $_SESSION['profile']['id'])

        $vue = new \wishlist\views\VueParticipant( $item->toArray(), $this->c);
        $html = $vue->render($htmlvars, 3 );
        //}

        $rs->getBody()->write($html);
        return $rs;
    }
}
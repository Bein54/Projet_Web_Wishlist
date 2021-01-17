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
        // session start avant d'utiliser session
        // if (! isset($_SESSION['profile'])) {
        //     $vue = new VueCompte("", $path);
        //     $html = $vue->render(2);
        // }
        // else {
        $listes = \wishlist\models\Liste::query()->select('*')
            ->where('token', '=', $args['nom'])
            ->get();
        //->where('user_id', '=', $_SESSION['profile']['id'])

        $vue = new \wishlist\views\VueParticipant( $listes->toArray(), $this->c);
        $html = $vue->render($htmlvars, 1 );
        //}

        $rs->getBody()->write($html);
        return $rs;
    }
}
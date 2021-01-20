<?php


namespace wishlist\controllers;


use Slim\Http\Response;
use Slim\Http\Request;

/**
 * Class ControleurParticipation
 * @package wishlist\controllers
 */
class ControleurParticipation
{
    //atribut correspondant au container
    private $c;

    public function __construct(\Slim\Container $c){
        $this->c = $c;
    }

    /**
     * fonction liée à la fonctionnalité d'affichage de toutes les listes de souhait
     * @param Request $rq
     * @param Response $rs
     * @param array $args
     * @return Response
     */
    public function getListeSouhaits (Request $rq,Response $rs, array $args): Response {
        session_start();
        $htmlvars = [
            'basepath' => $rq->getUri()->getBasePath()
        ];

        //On récupère toutes les listes
        $listes = \wishlist\models\Liste::query()->select('*')
            ->get();

        $vue = new \wishlist\views\VueParticipant( $listes->toArray(), $this->c);
        $html = $vue->render($htmlvars, 1 );

        $rs->getBody()->write($html);
        return $rs;
    }

    /**
     * fonction liée à l'affichage de tous les items d'une liste
     * @param Request $rq
     * @param Response $rs
     * @param array $args
     * @return Response
     */
    public function getItemsListe(Request $rq,Response $rs, array $args): Response {
        session_start();
        $htmlvars = [
            'basepath' => $rq->getUri()->getBasePath()
        ];
        $no = intval($args['no']);

        //on récupère la liste numéro no
        $liste = \wishlist\models\Liste::query()->select('*')
            ->where('no', '=', $no)
            ->get();

        //on récupère les items liés à la liste numéro no
        $items = \wishlist\models\Item::query()->select('*')
        ->where('liste_id', '=', $no)
        ->get();

        $elem = array($liste->toArray() ,$items );
        $vue = new \wishlist\views\VueParticipant($elem , $this->c);
        $html = $vue->render($htmlvars, 2 );

        $rs->getBody()->write($html);
        return $rs;
    }

    /**
     * onction permettant de récupérer les items d'une liste à partir d'un token
     * @param Request $rq
     * @param Response $rs
     * @param array $args
     * @return Response
     */
    public function getItemsListeToken(Request $rq,Response $rs, array $args): Response {
        session_start();
        $htmlvars = [
            'basepath' => $rq->getUri()->getBasePath()
        ];
        $token = $args['token'];

        //On récupère la liste associée à son token
        $liste = \wishlist\models\Liste::query()->select('*')
            ->where('token', '=', $token)
            ->get();
        $liste = $liste->toArray();

        //On récupère les items liés à cette liste
        $items = \wishlist\models\Item::query()->select('*')
            ->where('liste_id', '=', $liste[0]['no'])
            ->get();

        $elem = array($liste ,$items );
        $vue = new \wishlist\views\VueParticipant($elem , $this->c);
        $html = $vue->render($htmlvars, 2 );

        $rs->getBody()->write($html);
        return $rs;
    }

    /**
     * fonction liée à la récupération d'un item d'une liste
     * @param Request $rq
     * @param Response $rs
     * @param array $args
     * @return Response
     */
    public function getItem(Request $rq,Response $rs, array $args): Response {
        session_start();
        $htmlvars = [
            'basepath' => $rq->getUri()->getBasePath()
        ];
        $id = $args['id'] ; 
        
        //on récupère l'item par son ID
        $item = \wishlist\models\Item::query()->select('*')
        ->where('id', '=', $id)
        ->get();
        
        //on récupère la réservation liée à l'id de l'item
        $reserv = \wishlist\models\Reservation::query()->select('*')
        ->where('idItem', '=', $id)
        ->get();
        $elem = array($reserv ,$item );
        $vue = new \wishlist\views\VueParticipant($elem, $this->c);
        $html = $vue->render($htmlvars, 3 );
        

        $rs->getBody()->write($html);
        return $rs;
    }

    /**
     * fonction liée à la fonctionnalité de récupération d'URL
     * @param Request $rq
     * @param Response $rs
     * @param array $args
     * @return Response
     */
    public function getUrl(Request $rq,Response $rs, array $args): Response {
        session_start();
        $htmlvars = [
            'basepath' => $rq->getUri()->getBasePath()
        ];
        $no = intval($args['no']);

        //on récupère la liste associée à no
        $liste = \wishlist\models\Liste::query()->select('*')
            ->where('no', '=', $no)
            ->get();

        //on récupère l'item associé à l'id
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
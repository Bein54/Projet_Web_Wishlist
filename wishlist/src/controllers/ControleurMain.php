<?php


namespace wishlist\controllers;

use Slim\Http\Response;
use Slim\Http\Request;
use wishlist\models\Utilisateur;

class ControleurMain
{

    public function __construct(\Slim\Container $c){
        $this->c = $c;
    }

    /**
     * genere l'html de la page d'acceuil en utilisant la vueParticipant avec le selecteur 0
     */
    public function getHTML(Request $rq,Response $rs, array $args): Response {
        $htmlvars = [
            'basepath' => $rq->getUri()->getBasePath()
        ];

        $vue = new \wishlist\views\VueParticipant([], $this->c);
        $html = $vue->render($htmlvars,0);
        $rs->getBody()->write($html);
        return $rs;
    }
}
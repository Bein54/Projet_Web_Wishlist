<?php


namespace wishlist\controllers;

use Slim\Container;
use Slim\Http\Response;
use Slim\Http\Request;
use wishlist\views\VueParticipant;

class ControleurMain
{
    private $c;

    /**
     * ControleurMain constructor.
     * @param Container $c
     */
    public function __construct(Container $c){
        $this->c = $c;
    }

    /**
     * methode genererant l'html de la page d'acceuil en utilisant la vueParticipant avec le selecteur 0
     * @param Request $rq
     * @param Response $rs
     * @param array $args
     * @return Response
     */
    public function getHTML(Request $rq,Response $rs, array $args): Response {
        $htmlvars = [
            'basepath' => $rq->getUri()->getBasePath()
        ];

        $vue = new VueParticipant([], $this->c);
        $html = $vue->render($htmlvars,0);
        $rs->getBody()->write($html);
        return $rs;
    }
}
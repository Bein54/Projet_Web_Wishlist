<?php


namespace wishlist\controllers;

use Slim\Container;
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
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
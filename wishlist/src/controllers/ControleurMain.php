<?php


namespace wishlist\controllers;

use Slim\Http\Response;
use Slim\Http\Request;

class ControleurMain
{

    public function __construct(\Slim\Container $c){
        $this->c = $c;
    }
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
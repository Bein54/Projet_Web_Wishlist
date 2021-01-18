<?php


namespace wishlist\controllers;

use Slim\Http\Request;
use Slim\Http\Response;
use wishlist\models\Item;
use wishlist\models\Liste;

class ControleurCreation
{
    private $c;

    public function __construct(\Slim\Container $c){
        $this->c = $c;
    }
    public function getFormulaire(Request $rq,Response $rs, array $args): Response {
        $htmlvars = [
            'basepath' => $rq->getUri()->getBasePath()
        ];

        $elem = [];
        $vue = new \wishlist\views\VueCreation($elem, $this->c);
        $html = $vue->render($htmlvars, 0);

        $rs->getBody()->write($html);
        return $rs;
    }

    public function reservation(Request $rq,Response $rs, array $args): Response{
        $htmlvars = [
            'basepath' => $rq->getUri()->getBasePath()
        ];

        $post = $rq->getParsedBody();
        var_dump($post);

        $elem = [];
        $vue = new \wishlist\views\VueCreation($elem, $this->c);
        $html = $vue->render($htmlvars, 1);

        $rs->getBody()->write($html);
        return $rs;
    }
}
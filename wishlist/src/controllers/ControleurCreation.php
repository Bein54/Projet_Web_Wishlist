<?php


namespace wishlist\controllers;

use Slim\Http\Request;
use Slim\Http\Response;
use wishlist\models\Item;
use wishlist\models\Liste;
use wishlist\models\reservation;


class ControleurCreation
{
    private $c;

    public function __construct(\Slim\Container $c)
    {
        $this->c = $c;
    }

    public function getFormulaire(Request $rq, Response $rs, array $args): Response
    {
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

    public function getFormulaireItem(Request $rq,Response $rs, array $args): Response {
        $htmlvars = [
            'basepath' => $rq->getUri()->getBasePath()
        ];

        $listes = \wishlist\models\Liste::query()->select('*')
                ->get();

        
        $vue = new \wishlist\views\VueCreation($listes, $this->c);
        $html = $vue->render($htmlvars, 2);

        $rs->getBody()->write($html);
        return $rs;
    }

    public function ajouterItemPost(Request $rq, Response $rs, $args) : Response {
        
        $post = $rq->getParsedBody() ;
        var_dump($post['liste']);
        $nom = filter_var($post['nom'], FILTER_SANITIZE_STRING) ;
        $description = filter_var($post['description'] , FILTER_SANITIZE_STRING) ;
        $titre = filter_var($post['liste'], FILTER_SANITIZE_STRING);

        $img = filter_var($post['img'], FILTER_SANITIZE_STRING);
        $tarif = filter_var($post['tarif'], FILTER_SANITIZE_NUMBER_FLOAT);
        $liste = \wishlist\models\Liste::query()->select('*')
                ->where('titre', '=', $titre) 
                ->get();
        $i = new Item();

        $i->nom = $nom;
        $i->descr = $description;
        $i->liste_id = $liste['no'];
        $i->img = $img;
        $i->tarif = $tarif;
        $i->save();

        $path = $this->container->router->pathFor( '/' ) ;
        return $rs->withRedirect($path);

    }

    public function gererPost(Request $rq, Response $rs, array $args): Response
    {
        print $rq->getParsedBody();

        $rs = $rs->withStatus(201);
        return $rs;
    }
}
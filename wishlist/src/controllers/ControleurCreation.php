<?php


namespace wishlist\controllers;

use Slim\Http\Request;
use Slim\Http\Response;
use wishlist\models\Item;
use wishlist\models\Liste;
use wishlist\models\Reservation;


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

   

    public function getFormulaireItem(Request $rq, Response $rs, array $args): Response
    {
        $htmlvars = [
            'basepath' => $rq->getUri()->getBasePath()
        ];

        $listes = Liste::query()->select('*')
            ->get();


        $vue = new \wishlist\views\VueCreation($listes, $this->c);
        $html = $vue->render($htmlvars, 2);

        $rs->getBody()->write($html);
        return $rs;
    }

    public function ajouterItemPost(Request $rq, Response $rs, $args): Response
    {
        $htmlvars = [
            'basepath' => $rq->getUri()->getBasePath()
        ];

        $post = $rq->getParsedBody();
        $nom = filter_var($post['nom'], FILTER_SANITIZE_STRING) ;
        $options = array(
            'flags' => FILTER_FLAG_ALLOW_FRACTION,
            );
        $description = filter_var($post['description'] , FILTER_SANITIZE_STRING) ;
        $id = filter_var($post['liste'], FILTER_SANITIZE_NUMBER_INT);
        $id = intval($id);

        $img = filter_var($post['img'], FILTER_SANITIZE_STRING);
        $tarif = filter_var($post['tarif'], FILTER_SANITIZE_NUMBER_FLOAT, $options);

        $liste = Liste::query()->select('*')
                ->where('no', '=', $id)
                ->get();

        $i = new Item();

        $i->nom = $nom;
        $i->descr = $description;
        $i->liste_id = $id;
        $i->img = $img;
        $i->tarif = $tarif;
        $i->save();

        $vue = new \wishlist\views\VueCreation([], $this->c);
        $html = $vue->render($htmlvars, 3);

        $rs->getBody()->write($html);
        return $rs;
    }



    public function ajouterListe(Request $rq, Response $rs, array $args): Response
    {
        $post = $rq->getParsedBody();
        $htmlvars = [
            'basepath' => $rq->getUri()->getBasePath()
        ];

        $titre=filter_var($post['titre'], FILTER_SANITIZE_STRING);
        $desc=filter_var($post['description'], FILTER_SANITIZE_STRING);
        $date=filter_var($post['date-expiration'], FILTER_SANITIZE_STRING);

        $liste = new Liste();
        $liste->titre = $titre;
        $liste->description = $desc;
        $liste->expiration = $date;
        $liste->save();

        $token = "nosecure".$liste->getAttributeValue("no");
        $liste->token = $token;
        $liste->save();

        // $path = $this->c->router->pathFor('ajouterListe');
        // $rs = $rs->withRedirect($path);
        $vue = new \wishlist\views\VueCreation([], $this->c);
        $html = $vue->render($htmlvars, 4);

        $rs->getBody()->write($html);
        return $rs;
    }


    public function reservation(Request $rq, Response $rs, array $args): Response
    {
        $htmlvars = [
            'basepath' => $rq->getUri()->getBasePath()
        ];
        $post = $rq->getParsedBody();
        $id = filter_var($post['id'], FILTER_SANITIZE_NUMBER_INT);
        $id = intval($id);
        var_dump($id);
        $nom = filter_var($post['nom'], FILTER_SANITIZE_STRING);
        $r = new Reservation;
        $r->identifiant = $nom;
        $r->idItem = $id;
        $r->save();

        $vue = new \wishlist\views\VueCreation([], $this->c);
        $html = $vue->render($htmlvars, 5);

        $rs->getBody()->write($html);
        return $rs;
    }
}

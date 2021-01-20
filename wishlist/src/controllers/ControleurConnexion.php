<?php


namespace wishlist\controllers;

use Slim\Http\Request;
use Slim\Http\Response;
use wishlist\models\Utilisateur;

class ControleurConnexion
{
    private $c;

    public function __construct(\Slim\Container $c)
    {
        $this->c = $c;
    }

    public function getConnexion(Request $rq, Response $rs, array $args): Response
    {
        $htmlvars = [
            'basepath' => $rq->getUri()->getBasePath()
        ];
        $vue = new \wishlist\views\VueCompte($elem, $this->c);
        $html = $vue->render($htmlvars, 0);
        $rs->getBody()->write($html);
        return $rs;
    }

    public function Connexion(Request $rq, Response $rs, array $args): Response
    {
        $htmlvars = [
            'basepath' => $rq->getUri()->getBasePath()
        ];
        $post = $rq->getParsedBody();
        $Identifiant = filter_var($post['Identifiant'], FILTER_SANITIZE_STRING) ;
        $Mdp = filter_var($post['Mot de passe'], FILTER_SANITIZE_STRING) ;
        $user = Utilisateur::query()->select('*')
                ->where('Identifiant', '=', $Identifiant)
                ->get();
        
        if(isset($user)){
            if (password_verify($Mdp, $user->hash)) {
        
            $vue = new \wishlist\views\VueCompte([], $this->c);
        $html = $vue->render($htmlvars, 1);
        }else{
            $vue = new \wishlist\views\VueCompte([], $this->c);
        $html = $vue->render($htmlvars, 2);
        }}
        else{
            $vue = new \wishlist\views\VueCompte([], $this->c);
        $html = $vue->render($htmlvars, 2);
        }

        $rs->getBody()->write($html);
        return $rs;
    }
    public function creationCompte(Request $rq, Response $rs, array $args): Response
    {
        $htmlvars = [
            'basepath' => $rq->getUri()->getBasePath()
        ];
        $vue = new \wishlist\views\VueCompte($elem, $this->c);
        $html = $vue->render($htmlvars, 3);
        $rs->getBody()->write($html);
        return $rs;
    }
    public function creationComptePost(Request $rq, Response $rs, array $args): Response
    {
        $htmlvars = [
            'basepath' => $rq->getUri()->getBasePath()
        ];
        $post = $rq->getParsedBody();
        $Identifiant = filter_var($post['Identifiant'], FILTER_SANITIZE_STRING) ;
        $Mdp = filter_var($post['Mot de passe'], FILTER_SANITIZE_STRING) ;
        $hash=password_hash($Mdp, PASSWORD_DEFAULT['cost'=> 12] );



        $user = new User();
        $user->Identifiant = $Identifiant;
        $user->MotDePasse = $hash;
        $user->save();

        
        $html = $vue->render($htmlvars, 0);
        $rs->getBody()->write($html);
        return $rs;
    }

}
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
        session_start();
        $htmlvars = [
            'basepath' => $rq->getUri()->getBasePath()
        ];
        $vue = new \wishlist\views\VueCompte([], $this->c);
        $html = $vue->render($htmlvars, 0);
        $rs->getBody()->write($html);
        return $rs;
    }

    public function connexion(Request $rq, Response $rs, array $args): Response
    {
        $htmlvars = [
            'basepath' => $rq->getUri()->getBasePath()
        ];
        $post = $rq->getParsedBody();

        $identifiant = filter_var($post['identifiant'], FILTER_SANITIZE_STRING) ;

                $mdp = filter_var($post['mdp'], FILTER_SANITIZE_STRING);
                $user = Utilisateur::where('Identifiant', '=', $identifiant)
                                     ->first();


                //la session devrait etre dans le if, mais on ne sait pas pourquoi la function retourne faux.                     
                session_start();
                $_SESSION['profile'] = $user['idUser'];
                
                    if (password_verify($mdp, $user['MotDePasse'])) {
                        // session_start();
                        //  $_SESSION['profile'] = $user['idUser'];
                        
                    } 

                $url_racine = $this->c->router->pathFor('racine');
                return $rs->withRedirect($url_racine);
            }
        

    public function creationCompte(Request $rq, Response $rs, array $args): Response
    {
        session_start();
        $htmlvars = [
            'basepath' => $rq->getUri()->getBasePath()
        ];
        $vue = new \wishlist\views\VueCompte([], $this->c);
        $html = $vue->render($htmlvars, 3);
        $rs->getBody()->write($html);
        return $rs;
    }

    public function creationComptePost(Request $rq, Response $rs, array $args): Response
    {
        session_start();
        $htmlvars = [
            'basepath' => $rq->getUri()->getBasePath()
        ];
        $post = $rq->getParsedBody();
        $identifiant = filter_var($post['identifiant'], FILTER_SANITIZE_STRING) ;
        $mdp = filter_var($post['mdp'], FILTER_SANITIZE_STRING) ;
        $hash=password_hash($mdp, PASSWORD_DEFAULT);
        var_dump($mdp);


        $user = new Utilisateur();
        $user->Identifiant = $identifiant;
        $user->MotDePasse = $hash;
        $user->save();

        $vue = new \wishlist\views\VueCompte([], $this->c);
        $html = $vue->render($htmlvars, 0);
        $rs->getBody()->write($html);
        return $rs;
    }

    public function deconnexion(Request $rq, Response $rs, array $args): Response {
        session_start();
        $htmlvars = [
            'basepath' => $rq->getUri()->getBasePath()
        ];
        session_destroy();
        $vue = new \wishlist\views\VueParticipant([], $this->c);
        $html = $vue->render($htmlvars,0);
        $rs->getBody()->write($html);
        return $rs;
    }
}
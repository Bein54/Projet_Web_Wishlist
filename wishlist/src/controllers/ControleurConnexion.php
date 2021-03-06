<?php


namespace wishlist\controllers;

use Slim\Container;
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use wishlist\models\Utilisateur;
use wishlist\views\VueCompte;
use wishlist\views\VueParticipant;

/**
 * Class ControleurConnexion
 * @package wishlist\controllers
 */
class ControleurConnexion
{
    private $c;

    /**
     * Constructeur de la classe ControleurConnexion
     * @param Container $c
     */
    public function __construct(Container $c)
    {
        $this->c = $c;
    }

    /**
     * Methode qui appelle le render 0 de VueCompte pour afficher
     * la page de connexion
     * @param Request $rq
     * @param Response $rs
     * @param array $args
     * @return Response
     */
    public function getConnexion(Request $rq, Response $rs, array $args): Response
    {
        session_start();
        $htmlvars = [
            'basepath' => $rq->getUri()->getBasePath()
        ];
        //ouvre la page html 0
        $vue = new VueCompte([], $this->c);
        $html = $vue->render($htmlvars, 0);
        $rs->getBody()->write($html);
        return $rs;
    }

    /**
     * Methode qui permet de connecter un utilisateur
     * @param Request $rq
     * @param Response $rs
     * @param array $args
     * @return Response
     */
    public function connexion(Request $rq, Response $rs, array $args): Response
    {
        //recuperation des données
        $post = $rq->getParsedBody();
        echo("ici");
        $identifiant = filter_var($post['identifiant'], FILTER_SANITIZE_STRING) ;

                $mdp = filter_var($post['mdp'], FILTER_SANITIZE_STRING);
                $user = Utilisateur::query()->select('*')
                                     ->where('Identifiant', '=', $identifiant)
                                     ->first();


                //la session devrait etre dans le if, mais on ne sait pas pourquoi la function retourne faux.                     
                session_start();
                $_SESSION['profile'] = $user['idUser'];
                
                    if (password_verify($mdp, $user['MotDePasse'])) {
                        // session_start();
                        //  $_SESSION['profile'] = $user['idUser'];
                        
                    } 
                    //redirection vers la racine
                $url_racine = $this->c->router->pathFor('racine');
                return $rs->withRedirect($url_racine);
            }

    /**
     * Methode qui permet de creer un compte
     * @param Request $rq
     * @param Response $rs
     * @param array $args
     * @return Response
     */
    public function creationCompte(Request $rq, Response $rs, array $args): Response
    {
        session_start();
        $htmlvars = [
            'basepath' => $rq->getUri()->getBasePath()
        ];
        $vue = new VueCompte([], $this->c);
        $html = $vue->render($htmlvars, 3);
        $rs->getBody()->write($html);
        return $rs;
    }

    /**
     * Methode qui enregistre dans la base de données le compte créer
     * @param Request $rq
     * @param Response $rs
     * @param array $args
     * @return Response
     */
    public function creationComptePost(Request $rq, Response $rs, array $args): Response
    {
        session_start();
        $htmlvars = [
            'basepath' => $rq->getUri()->getBasePath()
        ];
        //recuperation des données
        $post = $rq->getParsedBody();
        $identifiant = filter_var($post['identifiant'], FILTER_SANITIZE_STRING) ;
        $mdp = filter_var($post['mdp'], FILTER_SANITIZE_STRING) ;
        //hashage du mdp
        $hash=password_hash($mdp, PASSWORD_DEFAULT);
        

        //enregistrement des données
        $user = new Utilisateur();
        $user->Identifiant = $identifiant;
        $user->MotDePasse = $hash;
        $user->save();
        //fin de redirection
        $vue = new VueCompte([], $this->c);
        $html = $vue->render($htmlvars, 0);
        $rs->getBody()->write($html);
        return $rs;
    }

    /**
     * Methode qui permet de deconnecter un compte
     * @param Request $rq
     * @param Response $rs
     * @param array $args
     * @return Response
     */
    public function deconnexion(Request $rq, Response $rs, array $args): Response {
        session_start();
        $htmlvars = [
            'basepath' => $rq->getUri()->getBasePath()
        ];
        // ferme la session
        session_destroy();
        $vue = new VueParticipant([], $this->c);
        $html = $vue->render($htmlvars,0);
        $rs->getBody()->write($html);
        return $rs;
    }
}
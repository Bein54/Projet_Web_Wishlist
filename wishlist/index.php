<?php
ob_end_clean();
require_once __DIR__."/vendor/autoload.php";
use Illuminate\Database\Capsule\Manager as DB;
use Slim\Http\Request;
use Slim\Http\Response;
use wishlist\controleur\ControleurMain;

$config = require_once __DIR__ . '/src/conf/settings.php';
$c = new \Slim\Container($config);
$app = new \Slim\App($c);

$db = new DB();
print ("eloquent est installe ! \n");

$db->addConnection([
	'driver' => 'mysql',
	'host' => 'localhost',
	'database' => 'php',
	'username' => 'root',
	'password' => '',
	'charset' => 'utf8',
	'collation' => 'utf8_unicode_ci',
]);

$db->setAsGlobal();
$db->bootEloquent();
print "connecté à la base de données\n";

$app->get('/liste/listeSouhaits',
    function (Request $req, Response $resp, array $args) : Response {
        $controleur = new \wishlist\controleur\ControleurParticipation($this);
        // $resp = $resp->withStatus( 201 ) ;
 	    // $resp->getBody()->write( 'Liste de liste de souhaits' ) ;
        //print 'Liste de liste de souhaits';
        return $controleur->getListeSouhaits($req,$resp,$args);
    })->setName('liste');

$app->post('/liste/listeSouhaits',
    function (Request $req, Response $resp, array $args) : Response {
        $controleur = new \wishlist\controleur\ControleurParticipation($this);
        // $resp = $resp->withStatus( 201 ) ;
        // $resp->getBody()->write( 'Liste de liste de souhaits' ) ;
        //print 'Liste de liste de souhaits';
        return $controleur->getListeSouhaits($req,$resp,$args);
    })->setName('liste');

$app->get('/listeItems/listeSouhaits',
    function (Request $req, Response $resp, array $args) : Response {

        $controleur = new \wishlist\controleur\ControleurParticipation($this);
        return $controleur->getListeItems($req,$resp,$args);
    })->setName('listeItems');

$app->get('/item/{id}',
    function (Request $req, Response $resp, array $args) : Response {
        $controleur = new \wishlist\controleur\ControleurParticipation($this);
        return $controleur->getItem($req,$resp,$args);
    })->setName('item');

$app->get('/',
    function (Request $req, Response $resp, array $args) : Response {
        $controleur = new ControleurMain();
        $resp->getBody()->write( $controleur->getHTML() ) ;
        return $resp ;
    });

$app->run();
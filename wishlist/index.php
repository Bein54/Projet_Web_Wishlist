<?php
ob_end_clean();
require_once __DIR__."/vendor/autoload.php";
use Illuminate\Database\Capsule\Manager as DB;
use Slim\Http\Request;
use Slim\Http\Response;
use wishlist\controleur\ControleurMain;

$app = new \Slim\App();

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

$app->get('/Liste/ListeSouhaits',
 function (Request $req, Response $resp) {
     $resp = $resp->withStatus( 201 ) ;
 	$resp->getBody()->write( 'Liste de liste de souhaits' ) ;
 //print 'Liste de liste de souhaits';
 return $resp ;

 });
$app->get('/ListeItems/ListeSouhaits',
 function (Request $req, Response $resp) {
     $resp->getBody()->write( 'Liste ditems d une liste de souhaits' ) ;
 return $resp ;
 });
$app->get('/Item/{id}',
 function (Request $req, Response $resp, $args) {
     $resp->getBody()->write( 'un item par son id' ) ;
 return $resp ;
 });
$app->get('/',
    function (Request $req, Response $resp) {
        $controleur = new ControleurMain();
        $resp->getBody()->write( $controleur->getHTML() ) ;
        return $resp ;
    });
$app->run();
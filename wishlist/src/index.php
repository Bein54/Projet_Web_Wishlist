<?php
require_once __DIR__."/../vendor/autoload.php";
use Illuminate\Database\Capsule\Manager as DB;
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
 	$rs = $rs->withStatus( 201 ) ;

 $rs->getBody()->write( 'Liste de liste de souhaits' ) ;
 print 'Liste de liste de souhaits';
 return $rs ; 

 });
$app->get('/ListeItems/ListeSouhaits',
 function (Request $req, Response $resp) {
 	$rs->getBody()->write( 'Liste ditems d une liste de souhaits' ) ;
 return $rs ; 
 });
$app->get('/Item/{id}',
 function (Request $req, Response $resp, $args) {
 	$rs->getBody()->write( 'un item par son id' ) ;
 return $rs ; 
 });
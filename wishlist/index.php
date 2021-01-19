<?php
ob_end_clean();
require_once __DIR__."/vendor/autoload.php";
use Illuminate\Database\Capsule\Manager as DB;
use Slim\Http\Request;
use Slim\Http\Response;

$config = require_once __DIR__ . '/src/conf/settings.php';
$c = new \Slim\Container($config);
$app = new \Slim\App($c);

$db = new DB();
print ("eloquent est installe ! \n");

$db->addConnection([
	'driver' => 'mysql',
	'host' => 'localhost',
	'database' => 'mywishlist',
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
        $controleur = new \wishlist\controllers\ControleurParticipation($this);
        $resp = $resp->withStatus( 201 ) ;
 	    // $resp->getBody()->write( 'Liste de liste de souhaits' ) ;
        //print 'Liste de liste de souhaits';
        return $controleur->getListeSouhaits($req,$resp,$args);
    })->setName('liste');


$app->get('/listeItems/listeSouhaits/{no}',
    function (Request $req, Response $resp, array $args) : Response {

        $controleur = new \wishlist\controllers\ControleurParticipation($this);
        return $controleur->getItemsListe($req,$resp,$args);
    })->setName('itemsListe');

$app->get('/item/{id}',
    function (Request $req, Response $resp, array $args) : Response {
        $controleur = new \wishlist\controllers\ControleurParticipation($this);
        return $controleur->getItem($req,$resp,$args);
    })->setName('item');

$app->get('/',
    function (Request $req, Response $resp, array $args) : Response {
        $controleur = new \wishlist\controllers\ControleurMain($this);
        return $controleur->getHTML($req,$resp,$args);
    })->setName('racine');

$app->get('/ajouterListe', function (Request $req, Response $resp, array $args) : Response {
    $controleur = new \wishlist\controllers\ControleurCreation($this);
    return $controleur->getFormulaire($req,$resp,$args);
})->setName('ajouterListe');

$app->post('/reservation/{id}', function (Request $req, Response $resp, array $args) : Response{
    $controleur = new \wishlist\controllers\ControleurCreation($this);
    return $controleur->reservation($req,$resp,$args);
})->setName('reservation');

$app->get('/ajouterItem', function (Request $req, Response $resp, array $args) : Response {
    $controleur = new \wishlist\controllers\ControleurCreation($this);
    return $controleur->getFormulaireItem($req,$resp,$args);
})->setName('ajouterItem');

$app->post('/ajouterItemPost', function (Request $req, Response $resp, array $args) : Response{
    $controleur = new \wishlist\controllers\ControleurCreation($this);
    return $controleur->ajouterItemPost($req,$resp,$args);
})->setName('ajouterItemPost');

$app->post('/ajouterListePost', function (Request $req, Response $resp, array $args) : Response {
    $controleur = new \wishlist\controllers\ControleurCreation($this);
    return $controleur->ajouterListe($req, $resp, $args);
})->setName('ajouterListePost');

$app->post('/connexion', function (Request $req, Response $resp, array $args) : Response {
    consol.log("ici");
    $controleur = new \wishlist\controllers\ControleurConnexion($this);
    return $controleur->getConnexion($req, $resp, $args);
})->setName('connexion');

$app->run();
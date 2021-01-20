<?php
ob_end_clean();
require_once __DIR__."/vendor/autoload.php";
use wishlist\conf\Database;
use Slim\Http\Request;
use Slim\Http\Response;

try {
    Database::connect();
} catch (Exception $e) {
    die($e->getMessage());
}
$config = require_once __DIR__ . '/src/conf/settings.php';

$c = new \Slim\Container($config);
$app = new \Slim\App($c);

$app->get('/liste/listeSouhaits',
    function (Request $req, Response $resp, array $args) : Response {
        $controleur = new \wishlist\controllers\ControleurParticipation($this);
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

$app->get('/reservation', function (Request $req, Response $resp, array $args) : Response{
    $controleur = new \wishlist\controllers\ControleurCreation($this);
    return $controleur->reservation($req,$resp,$args);
})->setName('reservation');
 
 $app->post('/reservation', function (Request $req, Response $resp, array $args) : Response{
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

$app->get('/connexion', function (Request $req, Response $resp, array $args) : Response {
    $controleur = new \wishlist\controllers\ControleurConnexion($this);
    return $controleur->getConnexion($req, $resp, $args);
})->setName('connexion');

$app->post('/connexion', function (Request $req, Response $resp, array $args) : Response {
    $controleur = new \wishlist\controllers\ControleurConnexion($this);
    return $controleur->connexion($req, $resp, $args);
})->setName('connexion');

$app->get('/giveurl/{no}', function (Request $req, Response $resp, array $args) : Response{
    $controleur = new \wishlist\controllers\ControleurParticipation($this);
    return $controleur->getUrl($req,$resp,$args);
})->setName('giveUrl');

$app->get('/connexion/creationCompte', function (Request $req, Response $resp, array $args) : Response {
    $controleur = new \wishlist\controllers\ControleurConnexion($this);
    return $controleur->creationCompte($req, $resp, $args);
})->setName('creation');

$app->get('/deconnexion', function (Request $req, Response $resp, array $args) : Response {
    $controleur = new \wishlist\controllers\ControleurConnexion($this);
    return $controleur->deconnexion($req, $resp, $args);
})->setName('deconnexion');

$app->post('/connexion/creationCompte', function (Request $req, Response $resp, array $args) : Response {
    $controleur = new \wishlist\controllers\ControleurConnexion($this);
    return $controleur->creationComptePost($req, $resp, $args);
})->setName('creation');

$app->get('/listeItems/listeSouhaitsToken/{token}',
    function (Request $req, Response $resp, array $args) : Response {
        $controleur = new \wishlist\controllers\ControleurParticipation($this);
        return $controleur->getItemsListeToken($req,$resp,$args);
    })->setName('itemsListeToken');

$app->run();
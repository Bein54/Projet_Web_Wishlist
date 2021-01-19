<?php
require_once __DIR__."../vendor/autoload.php";
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

$liste = \wishlist\models\Liste::all();
$items = \wishlist\models\Item::all();

foreach ($liste as $s) {
	//print $s->no . ' ' . $s->titre . "\n";
}




$id =  \wishlist\models\Item::get()
		->where('id', '=' , $_GET['i']);
	foreach ($id as $i) {
		//echo $i->id . $i->nom;
	}

$item = new \wishlist\models\Item();
$item->id = 28;
$item->liste_id = 1;
$item->nom = 'Mangas';
$item->descr = 'Mangas seinen';
$item->tarif = 7;
//$item->save();

$itemss = \wishlist\models\Item::all();
foreach ($itemss as $item) {
	//print $item->id . ' ' . $item->nom . "\n";
	$l = $item->liste;
	if(isset($l))
		print $l->titre."\n";
}

$l1 = \wishlist\models\Liste::where('no', '=', '2')->get();
$is = $l->items;
foreach ($is as $l){
	
	print $l->nom."\n";

}
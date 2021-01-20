<?php

namespace wishlist\conf;

use Exception;
use Illuminate\Database\Capsule\Manager as DB;

class Database {
    public static function connect() {
        if (file_exists('../../../database.ini')) {
            $donnees = parse_ini_file('../../../database.ini');
        } else {
            throw new Exception("Fichier database.ini inexistant");
        }

        $db = new DB();

        $db->addConnection([
            'driver' => $donnees['driver'],
            'host' => $donnees['host'],
            'database' => $donnees['database'],
            'username' => $donnees['username'],
            'password' => $donnees['password'],
            'charset' => $donnees['charset'],
            'collation' => $donnees['collation'],
        ]);

        $db->setAsGlobal();
        $db->bootEloquent();
    }


}

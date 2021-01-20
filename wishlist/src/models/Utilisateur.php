<?php
namespace wishlist\models;

use Illuminate\Database\Eloquent\Model as Model;

class Utilisateur extends Model{
    protected $table = 'utilisateur';
    protected $primaryKey = 'idUser';
    public $timestamps = false;

    public function role(){
        return $this->belongsTo('\wishlist\models\Role', 'id_role');
    }
}
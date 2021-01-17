<?php
namespace wishlist\model;

use Illuminate\Database\Eloquent\Model;

class Utilisateur extends model{
    protected $table = 'utilisateur';
    protected $primaryKey = 'uid';
    public $timestamps = false;

    public function role(){
        return $this->belongsTo('wishlist\Model\Role', 'id_role');
    }
}
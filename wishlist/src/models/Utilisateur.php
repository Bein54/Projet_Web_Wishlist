<?php
namespace wishlist\model;

use Illuminate\Database\Eloquent\ as Model;

class Utilisateur extends Model{
    protected $table = 'utilisateur';
    protected $primaryKey = 'uid';
    public $timestamps = false;

    public function role(){
        return $this->belongsTo('wishlist\Model\Role', 'id_role');
    }
}
<?php


namespace wishlist\Model;


class Role extends Model {
    protected $primaryKey = 'id_role';
    public $timestamps = false;
    protected $table = 'role';

    public function users(){
        return $this->hasMany('\mywishlist\models\Utilisateur', 'role_id');
    }
}
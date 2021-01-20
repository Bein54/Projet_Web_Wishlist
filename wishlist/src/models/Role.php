<?php
namespace wishlist\models;

use Illuminate\Database\Eloquent\Model as Model;

class Role extends Model {
    protected $primaryKey = 'id_role';
    public $timestamps = false;
    protected $table = 'role';

    public function users(){
        return $this->hasMany('\wishlist\models\Utilisateur', 'role_id');
    }
}
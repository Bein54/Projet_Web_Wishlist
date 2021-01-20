<?php
namespace wishlist\models;

use Illuminate\Database\Eloquent\Model as Model;

class Liste extends Model {
	protected $table = 'liste';
	protected $primaryKey = 'no';
	public $timestamps = false;

	public function items(){
		return $this->hasMany('\wishlist\model\Item', 'liste_id');
	}

    public function reservation() {
        return $this->hasMany('\wishlist\models\Reservation', 'liste_id');
    }
}
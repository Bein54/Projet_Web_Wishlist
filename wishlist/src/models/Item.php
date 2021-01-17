<?php
namespace wishlist\models;

use Illuminate\Database\Eloquent\Model as Model;

class Item extends Model {
	protected $table = 'item';
	protected $primaryKey = 'id';
	public $timestamps = false;


	public function liste(){
		return $this->belongsTo('\wishlist\model\Liste', 'liste_id');
	}
}
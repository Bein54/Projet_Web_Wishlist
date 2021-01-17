<?php
namespace wishlist\model;

use Illuminate\Database\Eloquent\Model;

class Liste extends model{
	protected $table = 'liste';
	protected $primaryKey = 'no';
	public $timestamps = false;

	public function items(){
		return $this->hasMany('\wishlist\model\Item', 'liste_id');
	}
}
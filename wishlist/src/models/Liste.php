<?php
namespace wishlist\models;

use Illuminate\Database\Eloquent\Model as Model;

class Liste extends Model {
	protected $table = 'liste';
	protected $primaryKey = 'no';
	public $timestamps = false;

}
<?php


namespace wishlist\models;

use Illuminate\Database\Eloquent\Model as Model;

class Reservation extends Model {
    protected $primaryKey = 'idReservation';
    public $timestamps = false;
    protected $table = 'reservation';
}
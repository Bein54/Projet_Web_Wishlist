<?php


namespace wishlist\controllers;


use wishlist\views\VueParticipant;

class ControleurMain
{
    private $vueParticipant;

    public function __construct()
    {
        $elem = [];
        $this->vueParticipant = new VueParticipant($elem);
    }
    public function getHTML(){
        return $this->vueParticipant->render(0);
    }
}
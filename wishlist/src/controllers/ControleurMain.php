<?php


namespace wishlist\controleur;


use wishlist\vue\VueParticipant;

class ControleurMain
{
    private VueParticipant $vueParticipant;

    public function __construct()
    {
        $elem = [];
        $this->vueParticipant = new VueParticipant($elem);
    }
    public function getHTML(){
        return $this->vueParticipant->render(0);
    }
}
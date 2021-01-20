<?php

namespace wishlist\views;
use wishlist\models\Utilisateur;


class VueParticipant
{
    private $elem;
    private $container;

    public function __construct($elem, $container)
    {
        $this->elem = $elem;
        $this->container = $container;
    }

    /**
     * @param array $vars contient des informations necessaires comme le basepath
     * @param int $selecteur permet de selectioner la vue voulut
     * @return string html generé
     */
    public function render(array $vars, $selecteur)
    {
        $content = '<br><br><b>SELECTEUR INCORRECT</b><br><br>';

        switch ($selecteur) {
            case 0: //menu principale
            {
                $content = $this->home();
                break;
            }
            case 1: //liste des liste de souhaits
            {
                $content = $this->listeSouhaits();
                break;
            }
            case 2: //detail d'une liste
            {
                $content = $this->detailListe();
                break;
            }
            case 3: //detail d'un item
            {
                $content = $this->giveItem();
                break;
            }
            case 4: //url d'une liste de souhait partageable
            {
                $content = $this->getUrl();
                break;
            }
        }
        $path = $this->container->router->pathFor( 'connexion' ) ;
        $html = "
        <!DOCTYPE html> 
        <html lang='fr'>
            <head>
                <meta charset='utf-8'>
                <title>MyWishlist</title>
                <link rel='stylesheet' href={$vars['basepath']}/styles.css>   
            </head>

            <body>
                <header>
                    <nav>
                        <ul class='nav_links'>
                            ";
                            if (isset($_SESSION['profile'])){
                                $html.= "<li><a href={$vars['basepath']}/liste/listeSouhaits>liste des listes de souhaits</a></li>";
                                $html.= "<li><a href={$vars['basepath']}/deconnexion>Deconnexion</a></li>";
                                }else{

                                $html.="<li><a id='creation' href='$path'>login/sign up</a></li>";
                                }
                        $html.="</ul>
                    </nav>    
                    <p>Projet MyWishList</p>
                </header> 
                <div class='content'>
                 $content
                </div>          
            </body>
        </html>     
        ";
        return $html;
    }
    private function home(): string{
        session_start();
                if (isset($_SESSION['profile'])){//affiche l'etat de connexion
                    $u  = Utilisateur::query()->select('*')
                                              ->where('idUser','=',$_SESSION['profile'])
                                              ->first();
                    $ses = "<p>Vous êtes connecté.<p>";
                }else{
                    $ses = "<p>Vous êtes déconnecté.<p>";
                }
        return $ses;
    }

    private function listeSouhaits(): string
    {
        $contains = "<ul class='reponse'>";
        foreach ($this->elem as $liste) {

            $url_liste   = $this->container->router->pathFor( 'itemsListe', ["no" => $liste["no"]] ) ;//pour chaque liste trouve le chemin
            $contains .="<li class='reponse'><a href=$url_liste>".$liste['no'] ." ". $liste['titre'] ."</a></li>";//affichage de la liste
        }
         $url_liste   = $this->container->router->pathFor( 'ajouterListe') ;//url pour ajouter une liste
        $contains .= "<a class='cta' href=$url_liste><button>ajouterListe</button></a></ul>";//affichage du bouton pour ajouter une liste
        $res = <<<END
    <div >
        $contains
    </div>
    END;
        return $res;
    }

    private function detailListe(): string
    {
        
        $titre = "";
        $descr = "";
        $no = "";
        $expiration= "";
        foreach ($this->elem[0] as $liste) {
            $titre = $liste['titre'];
            $descr = $liste['description'];
            $no = $liste['no'];
            $expiration = $liste['expiration'];
            $path = $this->container->router->pathFor( 'giveUrl', ["no" => $liste["no"]] ) ;//affichage bouton pour recup l'url de la liste
        }
        
        $contains = "<ul class='reponse'> ". $no . ' '. $titre. '<BR>' . $descr . '<BR>' .'expire le '. $expiration .'<BR>'  ;//affichage des details de la liste
        foreach ($this->elem[1] as $item) {
            $url_liste   = $this->container->router->pathFor( 'item', ["id" => $item["id"]] ) ;//recup de l'url de chaque items d'une liste
            $contains .= "<li class='reponse'><a href=$url_liste>". $item['nom'] . ' ' .  $item['img'] ."</a></li>";//affichage des items
        }
        $url_liste   = $this->container->router->pathFor( 'ajouterItem') ;//url pour ajouter un item
        $contains .= "<a class='cta' href=$url_liste><button>ajouterItem</button></a>  <a class='cta' href=$path><button>avoir l'url</button> </ul>";//affichage du bouton pour ajouter un item


        $res = <<<END
    <div class="items">
        $contains
    </div>
    END;
        return $res;
    }

    private function giveItem(): string
    {
        $id = "";
        $nom = "";
        $descr = "";
        $img = "";
        $tarif = "";
        foreach ($this->elem[1] as $item) {
            $id = $item['id'];
            $nom = $item['nom'];
            $descr = $item['descr'];
            $img = $item['img'];
            $tarif = $item['tarif'];
        }
        foreach ($this->elem[0] as $reserv) {
            $idReserv = $reserv['idReservation'];
        }

        $contains = "<ul class='reponse'><p>". $id . ' ' . $nom.' :' . '<br>' . $descr . ' ' . $img . '<BR>' . 'tarif : '. $tarif . '</p>';//affichage des details d'un item
        if (!isset($idReserv)){//si l'item n'est pas deja reserver
            $path = $this->container->router->pathFor('reservation');//url pour reserver
            $contains .= "<form action='$path' method='post'>
                            <label>
                                Nom :
                                <INPUT TYPE='text' NAME='nom' VALUE=''>
                            </label>

                            <label>
                            
                                id de l'item :
                                <INPUT  TYPE='text' NAME='id' readonly VALUE='$id'>
                            </label>
                        
                                <button TYPE='submit'>réserver</button>
                            </FORM>";
        }
        $contains .= '</ul>';
        $res = <<<END
    <div class="item">
        $contains
    </div>
    END;
        return $res;
    }

     private function getUrl(): string
    {
        
        $titre = "";
        $descr = "";
        $no = "";
        $expiration= "";
        foreach ($this->elem[0] as $liste) {
            $titre = $liste['titre'];
            $descr = $liste['description'];
            $no = $liste['no'];
            $expiration = $liste['expiration'];
            $path = $this->container->router->pathFor( 'itemsListeToken', ["token" => $liste["token"]] ) ;//url de la liste en passant par son token
        }
        //affichage de la liste
        $contains = "<ul class='reponse'> ". $no . ' '. $titre. '<BR>' . $descr . '<BR>' .'expire le '. $expiration .'<BR>'  ;
        foreach ($this->elem[1] as $item) {
            $url_liste   = $this->container->router->pathFor( 'item', ["id" => $item["id"]] ) ;
            $contains .= "<li class='reponse'><a href=$url_liste>". $item['nom'] . ' ' .  $item['img'] ."</a></li>";
        }
        $url_liste   = $this->container->router->pathFor( 'ajouterItem') ;
        $contains .= "<a class='cta' href=$url_liste><button>ajouterItem</button></a>
        <br><br><br><br> <p>url : $path<p> </ul>";//affichage de l'url contenant le token de la liste


        $res = <<<END
    <div class="items">
        $contains
    </div>
    END;
        return $res;
    }



}




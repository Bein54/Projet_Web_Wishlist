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
                if (isset($_SESSION['profile'])){
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

            $url_liste   = $this->container->router->pathFor( 'itemsListe', ["no" => $liste["no"]] ) ;
            $contains .="<li class='reponse'><a href=$url_liste>".$liste['no'] ." ". $liste['titre'] ."</a></li>";
        }
         $url_liste   = $this->container->router->pathFor( 'ajouterListe') ;
        $contains .= "<a class='cta' href=$url_liste><button>ajouterListe</button></a></ul>";
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
            $path = $this->container->router->pathFor( 'giveUrl', ["no" => $liste["no"]] ) ;
        }
        
        $contains = "<ul class='reponse'> ". $no . ' '. $titre. '<BR>' . $descr . '<BR>' .'expire le '. $expiration .'<BR>'  ;
        foreach ($this->elem[1] as $item) {
            $url_liste   = $this->container->router->pathFor( 'item', ["id" => $item["id"]] ) ;
            $contains .= "<li class='reponse'><a href=$url_liste>". $item['nom'] . ' ' .  $item['img'] ."</a></li>";
        }
        $url_liste   = $this->container->router->pathFor( 'ajouterItem') ;
        $contains .= "<a class='cta' href=$url_liste><button>ajouterItem</button></a>  <a class='cta' href=$path><button>avoir l'url</button> </ul>";


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

        $contains = "<ul class='reponse'><p>". $id . ' ' . $nom.' :' . '<br>' . $descr . ' ' . $img . '<BR>' . 'tarif : '. $tarif . '</p>';
        if (!isset($idReserv)){
            $path = $this->container->router->pathFor('reservation');
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
            $path = $this->container->router->pathFor( 'itemsListeToken', ["token" => $liste["token"]] ) ;
        }
        $contains = "<ul class='reponse'> ". $no . ' '. $titre. '<BR>' . $descr . '<BR>' .'expire le '. $expiration .'<BR>'  ;
        foreach ($this->elem[1] as $item) {
            $url_liste   = $this->container->router->pathFor( 'item', ["id" => $item["id"]] ) ;
            $contains .= "<li class='reponse'><a href=$url_liste>". $item['nom'] . ' ' .  $item['img'] ."</a></li>";
        }
        $url_liste   = $this->container->router->pathFor( 'ajouterItem') ;
        $contains .= "<a class='cta' href=$url_liste><button>ajouterItem</button></a>
        <br><br><br><br> <p>url : $path<p> </ul>";


        $res = <<<END
    <div class="items">
        $contains
    </div>
    END;
        return $res;
    }



}




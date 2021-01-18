<?php

namespace wishlist\views;



class VueParticipant
{
    private $elem;
    private $container;

    public function __construct($elem, $container)
    {
        $this->elem = $elem;
        $this->container = $container;
    }

    public function render(array $vars, $selecteur)
    {
        $content = '<br><br><b>SELECTEUR INCORRECT</b><br><br>';

        switch ($selecteur) {
            case 0:
            {
                $content = '';
                break;
            }
            case 1:
            {
                $content = $this->listeSouhaits();
                break;
            }
            case 2:
            {
                $content = $this->detailListe();
                break;
            }
            case 3:
            {
                $content = $this->giveItem();
                break;
            }
            case 4:
            {
                $content = $this->login();
                break;
            }
        }
        $html = <<<END
        <!DOCTYPE html> 
        <html lang="fr">
            <head>
                <meta charset="utf-8">
                <title>MyWishlist</title>
                <link rel="stylesheet" href={$vars['basepath']}/styles.css>   
            </head>

            <body>
                <header>
                    <nav>
                        <ul class="nav_links">
                            
                                <li><a href={$vars['basepath']}/liste/listeSouhaits>liste des listes de souhaits</a></li>
                                <li><a id="creation" href="#">login/sign up</a></li>
                                
                        </ul>
                    </nav>    
                    <a class="cta" href="#"><button>Mode Créateur</button></a> 
                </header> 
                <div class="content">
                 $content
                </div>          
            </body>
        </html>     
        END;

        return $html;
    }

    private function listeSouhaits(): string
    {
        $contains = "<ul class='reponse'>";
        foreach ($this->elem as $liste) {

            $url_liste   = $this->container->router->pathFor( 'itemsListe', ["no" => $liste["no"]] ) ;
            $contains .="<li class='reponse'><a href=$url_liste>".$liste['no'] ." ". $liste['titre'] ."</a></li>";
        }
        $contains .= "</ul>";
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
        }
        
        $contains = "<ul class='reponse'> ". $no . ' '. $titre. '<BR>' . $descr . '<BR>' .'expire le '. $expiration .'<BR>'  ;
        foreach ($this->elem[1] as $item) {
            $url_liste   = $this->container->router->pathFor( 'item', ["id" => $item["id"]] ) ;
            $contains .= "<li class='reponse'><a href=$url_liste>". $item['nom'] . ' ' .  $item['img'] ."</a></li>";
        }
        $contains .= "</ul>";


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
        $idReserv;
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
        //if (isset($idReserv)){
            $contains .= "<form action='/reservation/{id}' method='post'>
                                <INPUT TYPE='button' NAME='bouton' VALUE='Réserver'>
                            </FORM>";
        //}
        $contains .= '</ul>';
        $res = <<<END
    <div class="item">
        $contains
    </div>
    END;
        return $res;
    }
}




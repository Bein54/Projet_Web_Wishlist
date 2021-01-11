<?php

namespace wishlist\vue;

const TEST = 0;
const VUE_PARTICIPANT = 1;

class VueParticipant
{
    private $selecteur;
    private $elem;

    public function __construct($elem, $selecteur)
    {
        $this->$selecteur = $selecteur;
        $this->elem = $elem;
    }

    public function render()
    {
        $content = '';

        switch ($this->selecteur) {
            case TEST:
            {
                $content = $this->listeSouhaits();
            }
            case VUE_PARTICIPANT:
            {

            }
        }

        $html = <<<END
        <!DOCTYPE html> 
        <html lang="fr">
            <head>
                <meta charset="utf-8"> 
                <title>MyWishlist</title>
                <link rel="stylesheet" href="styles.css">   
            </head>

            <body>
                <header>
                    <nav>
                        <ul class="nav_links">
                            
                                <li><a href="#">liste des listes de souhaits</a></li>
                                <li><a href="#">détail d'une liste</a></li>
                                <li><a href="#">détail d'un item</a></li>
                                <li><a href="#">liste des items</a></li>
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
private function listeSouhaits() : string{
    $contains = "<p>";
    foreach ($this->elem as $liste) {
        $contains += $liste['titre'].'<br>';
    }
    $contains+="<p>";
    $res = <<<END
    <div class="souhaits">
        $contains
    </div>
    END;
    return $res;
}

private function detailListe
    $titre= $this->elem->titre;
    $items= $this->elem->items;
    $contains= "<h2>$titre<h2>".'<BR>'."<p> " 
    foreach ($items as $item){
        $contains+=$item['nom'].'<br>';
    }
    
    
    $res = <<<END
    <div class="items">
        $contains
    </div>
    END;
    return $res;
}





<?php

namespace wishlist\vue;

const MAIN = 0;
const TEST = 1;
const VUE_PARTICIPANT = 2;
const OUI = 3;
const CONSTRUCT = 4;

class VueParticipant
{
    private $elem;

    public function __construct($elem)
    {
        $this->elem = $elem;
    }

    public function render($selecteur)
    {
        $content = '<br><br><b>SELECTEUR INCORRECT</b><br><br>';

        switch ($selecteur) {
            case MAIN:
            {
                $content = '';
                break;
            }
            case TEST:
            {
                $content = $this->listeSouhaits();
                break;
            }
            case VUE_PARTICIPANT:
            {
                $content = $this->detailListe();
                break;
            }
            case OUI:
            {
                $content = $this->giveItem();
                break;
            }
            case CONSTRUCT:
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
                <link rel="stylesheet" href="./css/styles.css">   
            </head>

            <body>
                <header>
                    <nav>
                        <ul class="nav_links">
                            
                                <li><a href="./Liste/ListeSouhaits">liste des listes de souhaits</a></li>
                                <li><a href="./ListeItems/ListeSouhaits">détail d'une liste</a></li>
                                <li><a href=".">détail d'un item</a></li>
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
        $contains = "<p>";
        foreach ($this->elem as $liste) {
            $contains .= $liste['titre'] . '<br>';
        }
        $contains .= "</p>";
        $res = <<<END
    <div class="souhaits">
        $contains
    </div>
    END;
        return $res;
    }

    private function detailListe(): string
    {
        $titre = $this->elem->listes->titre;
        $items = $this->elem->items;
        $contains = "<h2>$titre<h2>" . '<BR>' . "<p> ";
        foreach ($items as $item) {
            $contains .= $item['nom'] . '<br>';
        }
        $contains .= '</p>';


        $res = <<<END
    <div class="items">
        $contains
    </div>
    END;
        return $res;
    }

    private function giveItem(): string
    {
        $contains = "<p>" . $this->elem[0]['nom'] . '</p>';

        $res = <<<END
    <div class="item">
        $contains
    </div>
    END;
        return $res;
    }
}




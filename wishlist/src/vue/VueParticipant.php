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
                $content = $this->ListeSouhaits();
            }
            case VUE_PARTICIPANT:
            {

            }
        }

        $html = <<<END
        <!DOCTYPE html> 
        <html lang="fr">
            <header>
            <title>MyWishlist</title>
            </header>
            <body>
                <nav class="navbar navbar=inverse navbar-static-top">
                    <div class="container">
                        <div class="navbar-header">
                            <a href="a" class="navbar-brand">Slim3</a>
                        </div>
                        <div class="nav navbar-nav">
                            <li><a href="a">liste de souhaits</a></li>
                        </div>
                    </div>
                </nav>
                <div class="content">
                 $content
                </div>
            </body>
        </html>
        END;

        return $html;
    }
}


private function ListeSouhaits() : string{
    $contains = "<p>";
    foreach ($this->elem as $liste) {
        $contains += $liste['titre'].'<br>';
    }
    $contains+="<p>";
    $res = <<<END
    <div class="souhaits">
    $res
    </div>
    END;
    return $res;
}


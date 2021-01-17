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
                <link rel="stylesheet" href={$vars['basepath']}/css/styles.css>   
            </head>

            <body>
                <header>
                    <nav>
                        <ul class="nav_links">
                            
                                <li><a href={$vars['basepath']}/liste/listeSouhaits>liste des listes de souhaits</a></li>
                                <li><a href={$vars['basepath']}/listeItems/listeSouhaits>détail d'une liste</a></li>
                                <li><a href={$vars['basepath']}>détail d'un item</a></li>
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

            $url_liste   = $this->container->router->pathFor( 'listeItems', ["no" => $liste["no"]] ) ;
            //$url_liste   = $this->container->router->pathFor( 'liste' ) ;
            $contains .="<a href='$url_liste'>". $liste['titre'] ."</a>". "<br>";
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




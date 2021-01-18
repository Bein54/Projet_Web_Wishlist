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
        $liste = $this->elem[0];
        $titre = $liste['titre'];
        
        $contains = "<ul class='reponse'> ". $titre . '<BR>'  ;
        foreach ($this->elem[1] as $item) {
            $url_liste   = $this->container->router->pathFor( 'item', ["id" => $item["id"]] ) ;
            $contains .= "<li class='reponse'><a href=$url_liste>". $item['nom'] ."</a></li>";
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
        $contains = "<ul class='reponse'><p>" . $this->elem[0]['nom'].' :' . '<br>' . $this->elem[0]['descr']. '</p></ul>';

        $res = <<<END
    <div class="item">
        $contains
    </div>
    END;
        return $res;
    }
}




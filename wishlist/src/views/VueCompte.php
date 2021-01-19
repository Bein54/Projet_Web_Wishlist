<?php


namespace wishlist\views;


class VueCompte
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
                $content = $this->connexion();
                break;
            }
            case 1:
            {
                $content = $this->qqc();
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
    private function connexion(): string
    {
        $path = $this->container->router->pathFor('ajouterItemPost');

        $html = "<form action='$path' method='post' class='formulaire'>
        <label>
            Liste : 
            " . '<select name="liste" >';


        $html .= '</select></label>
        <br>
        <label>
            Identifiant :
            <input type="text" name="Identifiant" value="">
        </label>
        <br>
        <label>
            Mot de passe :
            <input type="text" name="Mot de passe" value="">
        </label>
        <br>
        <button type="submit">Connexion</button>
    </form>';
        $res = <<<END
    <div >
        $html
    </div>
    END;
        return $res;

    }

}
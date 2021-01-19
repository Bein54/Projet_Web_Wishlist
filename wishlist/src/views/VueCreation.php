<?php


namespace wishlist\views;


use function Symfony\Component\Translation\t;

class VueCreation
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
                $content = $this->formulaire();
                break;
            }

            case 1:
            {
                $content = $this->reservation();
                break;
            }
            case 2:
                $content = $this->ajouterItem();
                break;
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

    private function formulaire(): string
    {
        $html = '<form method="post" class="formulaire" action="./create/post">
        <label>
            Titre :
            <input type="text" name="titre" value="">
        </label>
        <br>
        <label>
            Description :
            <input type="text" name="description" value="">
        </label>
        <br>
        <label>
            Date d\'expiration :
            <input type="date" name="date-expiration" value="">
        </label>
        <br>
        <button type="submit">créer la liste</button>
    </form>';
        return $html;
    }


    private function reservation(): string
    {

    }

    private function ajouterItem(): string
    {
        $path = $this->container->router->pathFor('ajouterItemPost');

        $html = "<form action='$path' method='post' class='formulaire'>
        <label>
            Liste : 
            " . '<select name="liste" >';
        foreach ($this->elem as $liste) {
            $html .= sprintf('<option value=\' %s \' </option>', $liste);
        }

        $html .= '</select></label>
        <br>
        <label>
            Nom :
            <input type="text" name="nom" value="">
        </label>
        <br>
        <label>
            Description :
            <input type="text" name="description" value="">
        </label>
        <br>
        <label>
            Image :
            <input type="text" name="img" value="">
        </label>
        <br>
        <label>
            Tarif : 
            <input type="text" name="tarif" value="">
        </label>
        <br>
        <button type="submit">créer l\'item</button>
    </form>';
        $res = <<<END
    <div >
        $html
    </div>
    END;
        return $res;

    }
}
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
            {
                $content = $this->ajouterItem();
                break;
            }
            case 3:
            {
                $content = $this->ItemConfirmed();
                break;
            }
            case 4:
            {
                $content = $this->ListeConfirmed();
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
        $path = $this->container->router->pathFor('ajouterListePost');

        $html = sprintf('<form method="post" class="formulaire" action="%s">
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
    </form>', $path);
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
            " . '<div class="box"><select name="liste" >';
        foreach ($this->elem as $liste) {
            $html .= sprintf('<option value="%d">%s</option>', $liste['no'], $liste['titre']);
        }

        $html .= '</select></div></label>
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


    public function ItemConfirmed(): string
    {
        $path = $this->container->router->pathFor('racine');

       return $contains = "<ul class='reponse'><p>L'item a bien été crée<p>
        <br>
        <a href=$path><button >Home page </button></a></ul>";

}
    public function ListeConfirmed(): string
    {
        $path = $this->container->router->pathFor('racine');

       return $contains = "<ul class='reponse'><p>La liste a bien été crée<p>
        <br>
        <a href=$path><button >Home page </button></a></ul>";

}
}
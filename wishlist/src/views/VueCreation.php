<?php


namespace wishlist\views;


/**
 * Class VueCreation
 * @package wishlist\views
 */
class VueCreation
{
    private $elem;
    private $container;

    /**
     * VueCreation constructor.
     * @param $elem
     * @param $container
     */
    public function __construct($elem, $container)
    {
        $this->elem = $elem;
        $this->container = $container;
    }

    /**
     * methode render
     * @param array $vars
     * @param $selecteur
     * @return string contenu html
     */
    public function render(array $vars, $selecteur)
    {
        $content = '<br><br><b>SELECTEUR INCORRECT</b><br><br>';

        switch ($selecteur) {
            case 0:
            {
                $content = $this->formulaire();
                break;
            }


            case 2:
            {
                $content = $this->ajouterItem();
                break;
            }
            case 3:
            {
                $content = $this->itemConfirmed();
                break;
            }
            case 4:
            {
                $content = $this->listeConfirmed();
                break;
            }
            case 5:
            {
                $content = $this->reservationConfirmed();
                break;
            }
        }
        $path = $this->container->router->pathFor('connexion');
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
        if (isset($_SESSION['profile'])) {
            $html .= "<li><a href={$vars['basepath']}/liste/listeSouhaits>liste des listes de souhaits</a></li>";
            $html .= "<li><a href={$vars['basepath']}/deconnexion>Deconnexion</a></li>";
        } else {

            $html .= "<li><a id='creation' href='$path'>login/sign up</a></li>";
        }
        $html .= "</ul>
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

    /**
     * methode permettant de créer une nouvelle liste
     * @return string contenu html
     */
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

    /**
     * methode permettant d'ajouter un item
     * @return string contenu html
     */
    private function ajouterItem(): string
    {
        $path = $this->container->router->pathFor('ajouterItemPost');

        $html = "<form action='$path' method='post' class='formulaire'>
        <label>
            Liste : 
            " . '<div class="box"><select name="liste" >';
        foreach ($this->elem as $liste) {
            //passe une variable php dans la valeur
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
        ${html}
    </div>
END;
        return $res;
    }

    /**
     * methode permettant la confirmation de la creation d'item
     * @return string contenu html
     */
    public function itemConfirmed(): string
    {
        $path = $this->container->router->pathFor('racine');

       return $contains = "<ul class='reponse'><p>L'item a bien été crée<p>
        <br>
        <a href=$path><button >Home page </button></a></ul>";

}

    /**
     * methode permettant la confirmation de la création de liste
     * @return string contenu html
     */
    public function listeConfirmed(): string
    {
        $path = $this->container->router->pathFor('racine');

       return $contains = "<ul class='reponse'><p>La liste a bien été crée<p>
        <br>
        <a href=$path><button >Home page </button></a></ul>";

}

    /**
     * methode permettant la confirmation de la reservation
     * @return string contenu html
     */
    public function reservationConfirmed(): string
    {
        $path = $this->container->router->pathFor('racine');

       return $contains = "<ul class='reponse'><p>Votre réservation à bien été enregistré<p>
        <br>
        <a href=$path><button >Home page </button></a></ul>";

    }
}
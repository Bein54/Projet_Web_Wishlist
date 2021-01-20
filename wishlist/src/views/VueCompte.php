<?php


namespace wishlist\views;
/**
 * Class VueCompte
 * @package wishlist\views
 */

class VueCompte
{
    private $elem;
    private $container;

    /**
     * Constructeur de la classe.
     * @param $elem
     * @param $container
     */
    public function __construct($elem, $container)
    {
        $this->elem = $elem;
        $this->container = $container;
    }


    /**
     * Methode qui creee la base de la page html et qui ajoute
     * le contenu en fonction de ce qu'on veut
     * @param $vars
     * @param $selecteur
     */
    public function render(array $vars, $selecteur)
    {
        $content = '<br><br><b>SELECTEUR INCORRECT</b><br><br>';

        switch ($selecteur) {
            case 0:
            {
                $content = $this->connexion();
                break;
            }
            
            case 3:
            {
                $content = $this->creerCompte();
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
    /**
     * Methode qui affiche la page de connexion
     * @return string contenu html
     */
    private function connexion(): string
    {
        $path = $this->container->router->pathFor('connexion');

        $html = <<<END
        <form action='$path' method='post' class='formulaire'>
        <label>
            Identifiant :
            <input type='text' name='identifiant' value=''>
        </label>
        <br>
        <label>
            Mot De Passe :
            <input type='password' name='mdp' value=''>
        </label>
        <br>
        <button type='submit'>se connecter</button>
        </form>
        END;
        $path = $this->container->router->pathFor('creation');
        $html.= <<<END
        <li><a href='$path'>créer un compte</a></li>
        END;

        return $html;
    }



    /**
     * Methode qui affiche l'interface de création de compte
     * @return string contenu html
     */
    private function creerCompte(): string
    {
        $path = $this->container->router->pathFor('creation');

        $html = <<<END
        <form action='$path' method='post' class='formulaire'>
        <label>
            Identifiant :
            <input type='text' name='identifiant' value=''>
        </label>
        <br>
        <label>
            Mot De Passe :
            <input type='password' name='mdp' value=''>
        </label>
        <br>
        <button type='submit'>créer compte</button>
        </form>
        END;

        $path = $this->container->router->pathFor('connexion');
        $html.= <<<END
        <li><a href='$path'>se connecter</a></li>
        END;
        return $html;
    }
}
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
                $content = $this->connexionfail();
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
    private function connexion(): string
    {
        $path = $this->container->router->pathFor('connexion');

        $html = "<form action='$path' method='post' class='formulaire'>
        <label>
            Identifiant :
            <input type='text' name='Identifiant' value=''>;
        </label>
        <br>
        <label>
            Mot De Passe :
            <input type='text' name='Mot de passe' value=''>;
        </label>
        <br>
        <button type='submit'>se connecter</button>
        </form>
        "
        $path = $this->container->router->pathFor('connexion/créationCompte');
        $html.= "<li><a href='$path'>créer un compte</a></li>
        "
        return $html;
    }



    private function creerCompte(): string
    {
        $path = $this->container->router->pathFor('connexion/créationCompte');

        $html = "<form action='$path' method='post' class='formulaire'>
        <label>
            Identifiant :
            <input type='text' name='Identifiant' value=''>;
        </label>
        <br>
        <label>
            Mot De Passe :
            <input type='text' name='Mot de passe' value=''>;
        </label>
        <br>
        <button type='submit'>créer compte</button>
        </form>
        "
        $path = $this->container->router->pathFor('connexion');
        $html.= "<li><a href='$path'>se connecter</a></li>
        "
        return $html;
    }
}
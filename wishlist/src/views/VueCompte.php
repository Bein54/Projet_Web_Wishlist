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
                $content = $this->connexiongranted();
            }
            case 2:
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
        $path = $this->container->router->pathFor('connexionPost');

        $html = <<<END
        <form action='$path' method='post' class='formulaire'>
        <label>
            Identifiant :
            <input type='text' name='Identifiant' value=''>
        </label>
        <br>
        <label>
            Mot De Passe :
            <input type='text' name='Mdp' value=''>
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

     private function connexiongranted(): string
    {
        $path = $this->container->router->pathFor('racine');

        $html = <<<END
        <li class='reponse'><a href=$path>accéder au site</a></li>;
        END;
        return $html;
    }
    private function connexionfail(): string
    {
        $path = $this->container->router->pathFor('connexion');

        $html = <<<END
        <li class='reponse'><a href=$path>se reconnecter</a></li>;
        END;
        return $html;
    }



    private function creerCompte(): string
    {
        $path = $this->container->router->pathFor('creationPost');

        $html = <<<END
        <form action='$path' method='post' class='formulaire'>
        <label>
            Identifiant :
            <input type='text' name='Identifiant' value=''>;
        </label>
        <br>
        <label>
            Mot De Passe :
            <input type='text' name='Mdp' value=''>;
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
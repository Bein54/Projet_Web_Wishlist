<?php


namespace wishlist;

const TEST = 0;

class Vue
{
    private $selecteur;
    private $elem;

    public function __construct($elem, $selecteur)
    {
        $this->$selecteur = $selecteur;
        $this->elem = $elem;
    }

    function renderer()
    {
        $content = '';

        switch ($this->selecteur) {
            case TEST:{
                $content = '<br>TEST<br>';
            }
        }

        $html = <<<END
        <!DOCTYPE html> 
        <html lang="fr">
            <body>
                <div class="content">
                 $content
                </div>
            </body>
        </html>
        END;

        return $html;
    }
}
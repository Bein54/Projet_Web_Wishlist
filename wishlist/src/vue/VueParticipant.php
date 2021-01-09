<?php

namespace wishlist\vue;

const TEST = 0;
const VUE_PARTICIPANT = 1;

class VueParticipant
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
            case TEST:
            {
                $content = '<br>TEST<br>';
            }
            case VUE_PARTICIPANT:
            {

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
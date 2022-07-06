<?php
// Mon print_r sera disponible uniquement en mode dev en mode prod i laffichera pas
function myPrint_r($value) {
if(MODE == 'dev') :
    echo '<pre>';
        print_r($value);
    echo '</pre>';
endif;
}
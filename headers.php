<?php
// Je rends mon api accesible a des scripts qui viennent d'un autre domaine que le mien on peut faire des requetes publique genre avec insomnia 
header("Access-Control-Allow-Origin:*");
// Je n'autorise que les methodes de requetes cidessous exemple la methode patch serait refusée dans Insomnia
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
// Le type de fichier générer ne sea que du JSON
header("Content-Type:application/json");
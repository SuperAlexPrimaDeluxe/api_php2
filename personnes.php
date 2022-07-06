<?php
include 'config.php';
include 'headers.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET') :
    if( isset($_GET['id_personnes'])) :
        $sql = sprintf("SELECT * FROM personnes WHERE id_personnes = %d",
            $_GET['id_personnes']
        );
        $response['response'] = 'One personne whit id '.$_GET['id_personnes'];
    else :
        $sql = "SELECT * FROM personnes ORDER BY nom, prenom ASC";
        $response['response'] = 'All personnes';
    endif;

    $result = $connect->query($sql);
    echo $connect->error;

    $response['data'] = $result->fetch_all(MYSQLI_ASSOC);
    $response['nb_hits'] = $result->num_rows;
endif; //end GET

if ($_SERVER['REQUEST_METHOD'] == 'DELETE') :
    $sql = sprintf("DELETE FROM personnes WHERE id_personnes=%d",
        $_GET['id_personnes']
    );
    $connect->query($sql);
    echo $connect->error;
    $response['response'] = "Suppression personne id {$_GET['id_personnes']}";
    //exit;
endif;

if ($_SERVER['REQUEST_METHOD'] == 'POST') :
    //extraction de l'objet json du paquet HTTP
    $json = file_get_contents('php://input');
    //décodage du format json, ça génère un object PHP
    $objectPOST = json_decode($json);
    $sql = sprintf("INSERT INTO personnes SET nom='%s', prenom='%s'",
        addslashes($objectPOST->nom), //lire une propriété d'un objet PHP
        addslashes($objectPOST->prenom)
    );
    /*
    $sql = sprintf("INSERT INTO personnes SET nom='%s', prenom='%s'",
        $_POST['nom'], 
        $_POST['prenom']
    );
    */
    $connect->query($sql);
    echo $connect->error;
    $response['response'] = "Ajout une personne avec id " . $connect->insert_id;
    $response['new_id'] = $connect->insert_id;
    //exit;
endif; //END POST

if ($_SERVER['REQUEST_METHOD'] == 'PUT') :
    //extraction de l'objet json du paquet HTTP
    $json = file_get_contents('php://input');
    //décodage du format json, ça génère un object PHP
    $objectPOST = json_decode($json);
    $arrayPOST = json_decode($json, true);
    $sql = sprintf("UPDATE personnes SET nom='%s', prenom='%s' WHERE id_personnes= %d",
        addslashes($objectPOST->nom), //lire une propriété d'un objet PHP
        addslashes($objectPOST->prenom),
        $_GET['id_personnes']
    );
    $connect->query($sql);
    echo $connect->error;
    $response['response'] = "Edit une personne avec id " . $_GET['id_personnes'];
    $response['new_data'] = $arrayPOST;
endif; //END PUT

$response['code'] = 200;
$response['time'] = date('Y-m-d,H:i:s');

echo json_encode($response);
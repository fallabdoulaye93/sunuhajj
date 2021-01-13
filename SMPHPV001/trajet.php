<?php
/**
 * Created by PhpStorm.
 * User: papangom
 * Date: 10/22/19
 * Time: 16:50
 */

require_once 'tools.php';


$postdata = file_get_contents("php://input");
$request = json_decode($postdata);
$echo = $request->echo;

if (strcmp($echo, "") != 0) {
    $requestType = "POST";
    $format = "application - json";
}


$uuid = trim(securite_xss($request->uuid));
$iduser = trim(securite_xss($request->iduser));

if($uuid != '' && $iduser != ''){
    $voyage = verifVoyageTrajet($iduser);
    if(is_object($voyage)){
        echo json_encode(array('errorCode' => 0, 'errorMessage' => '', 'trajet' => $voyage));
        exit();
    }
    else if($voyage === 2){
        echo json_encode(array('errorCode' => 2, 'errorMessage' => 'Matricule inextant'));
        exit();
    }
    else{
        echo json_encode(array('errorCode' => 1, 'errorMessage' => 'Erreur - '.$voyage));
        exit();
    }
}
else{
    echo json_encode(array('errorCode' => 1, 'errorMessage' => 'Paramètres manquantes'));
    exit();
}

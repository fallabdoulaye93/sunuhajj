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
$manufacture = trim(securite_xss($request->manufacture));
$model = trim(securite_xss($request->model));
$platform = trim(securite_xss($request->platform));
$gie = trim(securite_xss($request->gie));
$matricule = trim(securite_xss($request->matricule));

if($gie != '' && $matricule != '' && $uuid != '' && $manufacture != '' && $model != '' && $platform != ''){
    $bus = verifBus($matricule);
    if(is_object($bus)){
        if($bus->numGIE == $gie){
            echo json_encode(array('errorCode' => 0, 'errorMessage' => '', 'idbus' => $bus->id));
            exit();
        }
        else{
            echo json_encode(array('errorCode' => 3, 'errorMessage' => 'Vehicule non lié au groupement'));
            exit();
        }
    }
    else if($bus === 0){
        echo json_encode(array('errorCode' => 2, 'errorMessage' => 'Matricule inextant'));
        exit();
    }
    else{
        echo json_encode(array('errorCode' => 1, 'errorMessage' => 'Erreur SQL'));
        exit();
    }
}
else{
    echo json_encode(array('errorCode' => 1, 'errorMessage' => 'Paramètres manquantes'));
    exit();
}

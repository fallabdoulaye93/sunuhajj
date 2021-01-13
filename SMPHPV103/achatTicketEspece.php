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
$section_courante = trim(securite_xss($request->section));
$nbredestination = trim(securite_xss($request->nbredestination));
$montant = trim(securite_xss($request->montant));
$gie = trim(securite_xss($request->gie));
$trajet = trim(securite_xss($request->trajet));
$idbus = trim(securite_xss($request->idbus));

if($uuid != '' && $iduser != '' && $nbredestination != '' && $montant != '' && $trajet != '' && $gie != '' && $section_courante != ''){
    $date = date('Y-m-d H:i:s');
    $numtrans = genererNumTransaction();
    $retour = genererTicket($numtrans, $uuid, $iduser, $nbredestination, $montant, $idbus, $trajet, $gie, $section_courante, $date);
    if($retour == 1){
        $gie = getGIE($gie);
        echo json_encode(array('errorCode' => 0, 'errorMessage' => '', 'num_transac' => $numtrans, 'date_transac' => $date, 'gie' => $gie->nomgie, 'retour' => $retour));
        exit();
    }

    else{
        echo json_encode(array('errorCode' => 1, 'errorMessage' => 'Erreur - '.$retour));
        exit();
    }
}
else{
    echo json_encode(array('errorCode' => 1, 'errorMessage' => 'Paramètres manquantes'));
    exit();
}

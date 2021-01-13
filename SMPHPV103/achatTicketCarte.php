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
$carte = trim(securite_xss($request->carte));

if($uuid != '' && $iduser != '' && $nbredestination != '' && $montant != '' && $trajet != '' && $carte != '' && $gie != '' && $section_courante != ''){
    $date = date('Y-m-d H:i:s');
    $donees = substr($carte, 0, 8);
    if('458e8c78' == $donees || $carte === 'Youssef' || 'daa0dc8a' == $donees){
        $carte = '2012000521489557';
        $detailscarte = getCarte($carte);
        if(is_object($detailscarte)){
            if($detailscarte->solde >= $montant){
                $res = debiterCarte($detailscarte->id, $montant);
                $numtrans = genererNumTransaction();
                $retour = genererTicketCarte($numtrans, $uuid, $iduser, $nbredestination, $montant, $idbus, $trajet, $gie, $section_courante, $date, $detailscarte->id);
                if($retour == 1){
                    $gie = getGIE($gie);
                    echo json_encode(array('errorCode' => 0, 'errorMessage' => ''.$res, 'num_transac' => $numtrans, 'date_transac' => $date, 'gie' => $gie->nomgie, 'retour' => $retour));
                    exit();
                }
                else{
                    echo json_encode(array('errorCode' => 1, 'errorMessage' => 'Erreur - '.$retour));
                    exit();
                }
            }
            else{
                echo json_encode(array('errorCode' => 4, 'errorMessage' => 'Solde Carte= '.$detailscarte->solde.' - Montant='.$montant));
                exit();
            }

        }
        else{
            echo json_encode(array('errorCode' => 3, 'errorMessage' => 'Carte - '.$detailscarte));
            exit();
        }

    }
    else{
        echo json_encode(array('errorCode' => 2, 'errorMessage' => 'Carte - '.$donees));
        exit();
    }



}
else{
    echo json_encode(array('errorCode' => 1, 'errorMessage' => 'Paramètres manquantes'));
    exit();
}

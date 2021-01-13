<?php
/**
 * Created by PhpStorm.
 * User: papangom
 * Date: 10/22/19
 * Time: 12:52
 */

require_once 'tools_android.php';


if(isset($_POST['action']) && !empty($_POST['action'])){
    $action = trim(securite_xss($_POST['action']));

    if($action === 'login'){
        $login = trim(securite_xss($_POST['login']));
        $password = trim(securite_xss($_POST['password']));
        $uuid = trim(securite_xss($_POST['uuid']));
        $manufacture = trim(securite_xss($_POST['manufacture']));
        $model = trim(securite_xss($_POST['model']));
        $platform = trim(securite_xss($_POST['platform']));
        if($login != '' && $password != '' && $uuid != '' && $manufacture != '' && $model != '' && $platform != ''){
            echo login($login, $password, $uuid, $manufacture, $model, $platform);
            exit();
        }
        else{
            echo json_encode(array('errorCode' => 1001, 'errorMessage' => 'Merci de remplir tous les champs!', "res" => $_POST));
            exit();
        }
    }
    else if($action === 'paiementespece'){
        $iduser = trim(securite_xss($_POST['iduser']));
        $section_courante = trim(securite_xss($_POST['current_section']));
        $nombre_section = trim(securite_xss($_POST['nombre_section']));
        $prix_base = trim(securite_xss($_POST['prix_base']));
        $prix_entre_section = trim(securite_xss($_POST['prix_entre_section']));
        $idbus = trim(securite_xss($_POST['idbus']));
        $trajet = trim(securite_xss($_POST['idvoyage']));
        $gie = trim(securite_xss($_POST['gie']));
        $uuid = trim(securite_xss($_POST['uuid']));

        $date = date('Y-m-d H:i:s');
        $montant = $prix_base + (($nombre_section - 1) * $prix_entre_section);
        $numtrans = genererNumTransaction();
        $retour = genererTicket($numtrans, $uuid, $iduser, $nombre_section, $montant, $idbus, $trajet, $gie, $section_courante, $date);
        if($retour == 1){
            echo json_encode(array('errorCode' => 0, 'errorMessage' => '', 'num_transac' => $numtrans, 'date_transac' => $date, 'montant' => $montant, 'retour' => $retour));
            exit();
        }
    }
    else if($action === 'paiementcarte'){

        $iduser = trim(securite_xss($_POST['iduser']));
        $section_courante = trim(securite_xss($_POST['current_section']));
        $nombre_section = trim(securite_xss($_POST['nombre_section']));
        $prix_base = trim(securite_xss($_POST['prix_base']));
        $prix_entre_section = trim(securite_xss($_POST['prix_entre_section']));
        $idbus = trim(securite_xss($_POST['idbus']));
        $trajet = trim(securite_xss($_POST['idvoyage']));
        $gie = trim(securite_xss($_POST['gie']));
        $carte = trim(securite_xss($_POST['carte']));
        $uuid = trim(securite_xss($_POST['uuid']));

        $date = date('Y-m-d H:i:s');
        $montant = $prix_base + (($nombre_section - 1) * $prix_entre_section);
        $detailscarte = getCarte($carte);

        if(is_object($detailscarte)){
            if((int)$detailscarte->statut == 1) {
                if($carte === sha1($detailscarte->numero_serie).'##'.md5('NUMH@201912'.$detailscarte->numero)) {
                    if ($detailscarte->solde >= $montant) {
                        $solde_avant = $detailscarte->solde;
                        $res = debiterCarte($detailscarte->id, $montant);
                        $solde_apres = getSoldeCarte($carte);
                        $numtrans = genererNumTransaction();
                        saveReleveClient($numtrans, $solde_avant, $date, $montant, $operation="DEBIT", $solde_apres, $detailscarte->id, $detailscarte->client);
                        if($res == 1){

                            $retour = genererTicketCarte($numtrans, $uuid, $iduser, $nombre_section, $montant, $idbus, $trajet, $gie, $section_courante, $date, $detailscarte->id);
                            if ($retour == 1) {
                                echo json_encode(array('errorCode' => 0, 'errorMessage' => '' . $res, 'num_transac' => $numtrans, 'montant' => $montant, 'date_transac' => $date, 'solde_avant' => $solde_avant, 'solde_apres' => $solde_apres, 'retour' => $retour));
                                exit();
                            } else {
                                echo json_encode(array('errorCode' => 1, 'errorMessage' => 'Erreur - ' . $retour));
                                exit();
                            }
                        }
                        else{
                            echo json_encode(array('errorCode' => 3, 'errorMessage' => +" et "+$res));
                            exit();
                        }

                    } else {
                        echo json_encode(array('errorCode' => 4, 'errorMessage' => 'Solde Carte insuffisant', 'solde' => $detailscarte->solde));
                        exit();
                    }
                }
                else{
                    echo json_encode(array('errorCode' => 5, 'errorMessage' => 'Données cartes interrompues'));
                    exit();
                }
            }
            else{
                echo json_encode(array('errorCode' => 2, 'errorMessage' => 'Carte inactive'));
                exit();
            }

        }
        else{
            echo json_encode(array('errorCode' => 3, 'errorMessage' => $detailscarte));
            exit();
        }

    }
    else if($action === 'lastticket'){
        $iduser = trim(securite_xss($_POST['iduser']));
        $idbus = trim(securite_xss($_POST['idbus']));
        $trajet = trim(securite_xss($_POST['idvoyage']));
        $gie = trim(securite_xss($_POST['gie']));
        $uuid = trim(securite_xss($_POST['uuid']));

        $retour = getLastTicketTouser($uuid, $iduser, $idbus, $trajet, $gie);

        if($retour != -1 && $retour != -2){
            echo json_encode(array('errorCode' => 0, 'errorMessage' => '', 'num_transac' => $retour->num_transaction, 'date_transac' => $retour->date, 'montant' => $retour->montant, 'nb_section' => $retour->nombre_section, 'depart' => $retour->lieu_depart, 'arrive' => $retour->lieu_arrive));
            exit();
        }
        else if($retour == -2){
            echo json_encode(array('errorCode' => 1, 'errorMessage' => 'Pas de ticket pour cette journée'));
            exit();
        }
        else{
            echo json_encode(array('errorCode' => 2, 'errorMessage' => 'Erreur - '.$retour));
            exit();
        }
    }
    else if($action === 'historiquedujour'){
        $iduser = trim(securite_xss($_POST['iduser']));
        $idbus = trim(securite_xss($_POST['idbus']));
        $uuid = trim(securite_xss($_POST['uuid']));

        $date = date('Y-m-d');
        $retour = historiqueDuJourTicket($uuid, $iduser, $idbus, $date);
        if(is_array($retour)){
            echo json_encode(array('errorCode' => 0, 'errorMessage' => '', 'histo' => $retour));
            exit();
        }
        else{
            echo json_encode(array('errorCode' => 1, 'errorMessage' => $retour));
            exit();
        }
    }
    else if($action === 'historiquevoyage'){
        $iduser = trim(securite_xss($_POST['iduser']));
        $trajet = trim(securite_xss($_POST['idvoyage']));
        $idbus = trim(securite_xss($_POST['idbus']));
        $uuid = trim(securite_xss($_POST['uuid']));

        $date = date('Y-m-d');
        $retour = historiqueDuVoyageTicket($uuid, $iduser, $trajet, $idbus, $date);
        if(is_array($retour)){
            echo json_encode(array('errorCode' => 0, 'errorMessage' => '', 'histo' => $retour));
            exit();
        }
        else{
            echo json_encode(array('errorCode' => 1, 'errorMessage' => $retour));
            exit();
        }
    }
    else if($action === 'closetrip'){
        $iduser = trim(securite_xss($_POST['iduser']));
        $trajet = trim(securite_xss($_POST['idvoyage']));
        $idbus = trim(securite_xss($_POST['idbus']));
        $retour = fermerVoyage($trajet, $idbus, $iduser);
        if($retour == 1){
            echo json_encode(array('errorCode' => 0, 'errorMessage' => ''));
            exit();
        }
        else{
            echo json_encode(array('errorCode' => 1, 'errorMessage' => ""));
            exit();
        }
    }
    else if($action === 'soldecarte'){
        $carte = trim(securite_xss($_POST['carte']));
        if($carte != ''){
            echo getSoldeCarte($carte);
            exit();
        }
        else{
            echo json_encode(array('errorCode' => 1001, 'errorMessage' => 'Merci de remplir tous les champs!', "res" => $_POST));
            exit();
        }
    }
    else if($action === 'rechargecarte'){
        $carte = trim(securite_xss($_POST['carte']));
        $iduser = trim(securite_xss($_POST['iduser']));
        $idbus = trim(securite_xss($_POST['idbus']));
        $uuid = trim(securite_xss($_POST['uuid']));
        $montant = trim(securite_xss($_POST['montant']));
        if($carte != ''){

            if($montant <= 1600) {
                $detailscarte = getCarte($carte);

                if (is_object($detailscarte)) {
                    if ($carte === sha1($detailscarte->numero_serie) . '##' . md5('NUMH@201912' . $detailscarte->numero)) {
                        $solde_avant = $detailscarte->solde;
                        $date = date('Y-m-d H:i:s');
                        $res = crediterCarte($detailscarte->id, $montant);
                        $solde_apres = getSoldeCarte($carte);
                        $numtrans = genererNumTransaction();
                        saveReleveClient($numtrans, $solde_avant, $date, $montant, $operation = "CREDIT", $solde_apres, $detailscarte->id, $detailscarte->client);
                        if ($res == 1) {
                            $statut = 1;
                            @saveRechargeCarte($numtrans, $uuid, $iduser, $montant, $idbus, $date, $detailscarte->id, $statut);
                            echo json_encode(array('errorCode' => 0, 'errorMessage' => '' . $res, 'num_transac' => $numtrans, 'montant' => number_format($montant,0,'.', ' '), 'date_transac' => $date, 'solde_avant' => number_format($solde_avant,0,'.', ' '), 'solde_apres' => number_format($solde_apres,0,'.', ' '), 'numero_serie' => $detailscarte->numero_serie));
                            exit();
                        } else {
                            $statut = 0;
                            @saveRechargeCarte($numtrans, $uuid, $iduser, $montant, $idbus, $date, $detailscarte->id, $statut);
                            echo json_encode(array('errorCode' => 1, 'errorMessage' => $res));
                            exit();
                        }
                    } else {
                        echo json_encode(array('errorCode' => 5, 'errorMessage' => 'Données cartes interrompues'));
                        exit();
                    }
                } else {
                    echo json_encode(array('errorCode' => 3, 'errorMessage' => $detailscarte));
                    exit();
                }
            }
            else{
                echo json_encode(array('errorCode' => 2, 'errorMessage' => 'Montant non autorisé'));
                exit();
            }
        }
        else{
            echo json_encode(array('errorCode' => 1001, 'errorMessage' => 'Merci de remplir tous les champs!', "res" => $_POST));
            exit();
        }
    }
    else if($action === 'voyage'){
        $iduser = trim(securite_xss($_POST['iduser']));
        $idbus = trim(securite_xss($_POST['idbus']));
        echo getVoyage($iduser, $idbus);
        exit();
    }
    else if($action === 'activation'){
        $serie = trim(securite_xss($_POST['serie']));
        $telephone = trim(securite_xss($_POST['telephone']));
        echo getInfosCarte($serie, $telephone);
        exit();
    }
    else{
        echo json_encode(array('errorCode' => 1000, 'errorMessage' => 'Action not autorisée!'));
        exit();
    }

}
else{
    echo json_encode(array('errorCode' => 1000, 'errorMessage' => 'Action not reconnue!'));
    exit();
}


<?php
/**
 * Created by PhpStorm.
 * User: papangom
 * Date: 10/22/19
 * Time: 12:18
 */
header("Content-Type: text/plain");
header('Content-Type: text/html; charset=utf-8');
date_default_timezone_set('Africa/Dakar');
ini_set('display_errors', 1);
if (isset($_SERVER['HTTP_ORIGIN'])) {
    header("Access-Control-Allow-Origin: *");
    header('Access-Control-Allow-Credentials: true');
    header("Access-Control-Allow-Methods: GET, POST");
    header('Access-Control-Allow-Headers: Keep-Alive,User-Agent,X-Requested-With,Cache-Control,Content-Type,X-Authorization');    // cache for 1 day
}


// Access-Control headers are received during OPTIONS requests
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {

    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS");

    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
        header("Access-Control-Allow-Headers:        {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");

    exit(0);
}



function Connection()
{

    $conn = NULL;
    try {
        $conn = new PDO("mysql:host=1t4qf.myd.sharedbox.com;dbname=1t4qf_gbus1", "1t4qf_gbus", "2nJNS6LRAYTF");
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        return $conn;
    } catch (PDOException $e) {
        return $e;
    }


}

function securite_xss($string)
{
    $string = htmlspecialchars($string, ENT_QUOTES);
    $string = strip_tags($string);
    return $string;
}


function verifyDevice($user, $uuid, $manufacrture, $model, $platform){
    try{
        $dbh = Connection();
        $sql = "SELECT * FROM devices WHERE uuid = :uuid";
        $stmt = $dbh->prepare($sql);
        $stmt->bindValue('uuid', $uuid);
        $stmt->execute();
        //return $stmt->fetchObject();
        if($stmt->rowCount() === 1){

            $res = $stmt->fetchObject();
            if($res->etat == 1)
                return $res;
            else
                return 0;
        }
        else if($stmt->rowCount() === 0){
            $date = date('Y-m-d H:i:s');
            $sql = "INSERT INTO devices(uuid, manufacture, model, platform, user_creation, date_creation, etat) VALUES(:uuid, :manufacture, :model, :platform, :user_creation, :date_creation, :etat)";
            $stmt = $dbh->prepare($sql);
            $stmt->bindValue('uuid', $uuid);
            $stmt->bindValue('manufacture', $manufacrture);
            $stmt->bindValue('model', $model);
            $stmt->bindValue('platform', $platform);
            $stmt->bindValue('user_creation', $user);
            $stmt->bindValue('date_creation', $date);
            $stmt->bindValue('etat', 0);
            $stmt->execute();
            return 0;
        }
        else{
            return -1;
        }
    }
    catch (PDOException $e){
        return -1;
    }
}


function verifyAffectationDeviceBus($user, $device){
    try{
        $dbh = Connection();
        $date = date('Y-m-d H:i:s');
        $sql = "SELECT a.bus_id, a.date_debut, a.date_fin, b.matricule, g.nomgie, g.id as idgie
                FROM affectation_bus a 
                INNER JOIN bus b ON a.bus_id = b.id 
                INNER JOIN gie g ON b.numGIE = g.id
                WHERE a.etat = 1 AND a.receveur_id = :iduser AND a.device_id = :iddevice";
               /* WHERE a.etat = 1 AND a.receveur_id = :iduser AND a.device_id = :iddevice AND a.date_debut <= :deb AND a.date_fin >= :fin";*/
        //$sql = "SELECT a.bus_id, b.matricule, g.nomgie FROM affectation_bus a INNER JOIN bus b ON a.bus_id = a.id INNER JOIN gie g ON b.numGIE = g.id WHERE a.etat = 1 AND a.receveur_id = :iduser AND a.device_id = :iddevice AND a.date_debut <= :deb AND a.date_fin >= :fin";

        $stmt = $dbh->prepare($sql);
        $stmt->bindValue('iduser', $user);
        $stmt->bindValue('iddevice', $device);
        //$stmt->bindValue('deb', $date);
        //$stmt->bindValue('fin', $date);



        $stmt->execute();
        if($stmt->rowCount() === 1){
            return $stmt->fetchObject();
        }
        else{
            return -1;
        }
    }
    catch (PDOException $e){
        return -1;
    }
}

function login($login, $password, $uuid, $manufacrture, $model, $platform){
    try{
        $dbh = Connection();
        //var_dump($dbh);die();
        $sql = "SELECT u.* FROM utilisateur u WHERE u.login = :login";
        $stmt = $dbh->prepare($sql);
        $stmt->bindValue('login', $login);
        $stmt->execute();
        if($stmt->rowCount() === 1){
            $user = $stmt->fetchObject();
            if($user->etat == 1){
                if($user->type == 3) {
                    if ($user->password === sha1($password)) {
                        $device = verifyDevice($user->id, $uuid, $manufacrture, $model, $platform);

                        if (is_object($device)) {
                            $affectation = verifyAffectationDeviceBus($user->id, $device->rowid);
                            if (is_object($affectation)) {
                                return json_encode(array('errorCode' => 0, 'errorMessage' => '', 'id' => $user->id, 'prenom' => $user->prenom, 'nom' => $user->nom, 'matricule' => $affectation->matricule, 'gie' => $affectation->nomgie, 'idgie' => $affectation->idgie, 'idbus' => $affectation->bus_id));

                            } else {
                                //Device, utilisateur, bus non affecté
                                return json_encode(array('errorCode' => 14, 'errorMessage' => 'Device, utilisateur, bus non affecté', 'u' => $affectation));
                            }
                        } else if ($device === 0) {
                            //Device non reconnu
                            return json_encode(array('errorCode' => 13, 'errorMessage' => 'Device non-reconnu'));
                        } else {
                            //Erreur device
                            return json_encode(array('errorCode' => 12, 'errorMessage' => 'Erreur device - ' . $device));
                        }
                    } else {
                        //Mot de passe incorrect
                        return json_encode(array('errorCode' => 11, 'errorMessage' => 'Mot de passe incorrect', 'u' => $user));
                    }
                }
                else{
                    return json_encode(array('errorCode' => 100, 'errorMessage' => 'Profil non autorisé'));
                }
            }
            else{
                //Utilisateur inactive
                return json_encode(array('errorCode' => 10, 'errorMessage' => 'Utilisateur inactive'));
            }
        }
        else if($stmt->rowCount() > 1){
            //Login dupliqué
            return json_encode(array('errorCode' => 9, 'errorMessage' => 'Login dupliqué'));
        }
        else{
            //Erreur sql
            return json_encode(array('errorCode' => 8, 'errorMessage' => 'Login ou mot de passe incorrect'));
        }
    }
    catch (PDOException $e){
        return json_encode(array('errorCode' => 6, 'errorMessage' => 'Erreur sql='.$e));
    }
}


function getVoyage($iduser, $idbus){
    $voyage = verifVoyageTrajet($iduser, $idbus);
    if(is_object($voyage)){
        return json_encode(array('errorCode' => 0, 'errorMessage' => '', 'idvoyage' => $voyage->id, 'num_voyage' => $voyage->num_voyage, 'ligne' => $voyage->ligne, 'lieu_depart' => $voyage->lieu_depart, 'lieu_arrive' => $voyage->lieu_arrive, 'nombre_section' => $voyage->nombre_section, 'ecart_section' => $voyage->ecart_section, 'prix_base' => $voyage->prix_base));
    }
    else if($voyage == 2){
        return json_encode(array('errorCode' => 11, 'errorMessage' => 'Voyage précedent non cloturé', 'u' => $voyage));
    }
    else if($voyage == 0){
        return json_encode(array('errorCode' => 12, 'errorMessage' => 'Pas de voyage', 'u' => $voyage));
    }
    else{
        return json_encode(array('errorCode' => 2, 'errorMessage' => 'Erreur SQL', 'u' => $voyage));
    }
}


function allGIE(){
    try{
        $dbh = Connection();
        $sql = "SELECT * FROM gie WHERE etat = 1";
        $stmt = $dbh->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);

    }
    catch (PDOException $e){
        return -1;
    }
}


function verifBus($matricule){
    try{
        $dbh = Connection();
        $sql = "SELECT * FROM bus WHERE etat = 1 AND matricule = :matricule";
        $stmt = $dbh->prepare($sql);
        $stmt->bindValue('matricule', $matricule);
        $stmt->execute();
        if($stmt->rowCount() === 1)
            return $stmt->fetchObject();
        else
            return 0;

    }
    catch (PDOException $e){
        return -1;
    }
}

function verifVoyageTrajet($iduser, $idbus){
    try{
        $dbh = Connection();
        $sql = "SELECT v.*, t.* FROM voyage v INNER JOIN trajet t ON v.trajet_id = t.id WHERE v.etat = 1 AND v.receveur_id = :receveur_id AND v.bus_id = :bus_id";
        $stmt = $dbh->prepare($sql);
        $stmt->bindValue('receveur_id', $iduser);
        $stmt->bindValue('bus_id', $idbus);
        $stmt->execute();
        if($stmt->rowCount() === 1)
            return $stmt->fetchObject();
        else if($stmt->rowCount() > 1)
            return 2;
        else
            return 0;

    }
    catch (PDOException $e){
        return -1;
    }
}

function genererTicket($numtransac, $uuid, $iduser, $nbre_section, $montant, $idbus, $trajet, $gie, $section_courante, $date){

    $etat = 1;
    try{
        $dbh = Connection();
        $sql = "INSERT INTO `transaction`(`num_transaction`, `date`, `receveur`, `bus`, `trajet`, `ticket`, `etat`, `montant`, `numGIE`, `nombre_section`, `section_courante`, `uuid`) VALUES (:num_transaction, :date_creation, :receveur, :bus, :trajet, :ticket, :etat, :montant, :numGIE, :nombre_section, :section_courante, :uuid)";
        $stmt = $dbh->prepare($sql);
        $stmt->bindValue('num_transaction', $numtransac);
        $stmt->bindValue('date_creation', $date);
        $stmt->bindValue('receveur', $iduser);
        $stmt->bindValue('bus', $idbus);
        $stmt->bindValue('trajet', $trajet);
        $stmt->bindValue('ticket', $nbre_section);
        $stmt->bindValue('etat', $etat);
        $stmt->bindValue('montant', $montant);
        $stmt->bindValue('numGIE', $gie);
        $stmt->bindValue('nombre_section', $nbre_section);
        $stmt->bindValue('section_courante', $section_courante);
        $stmt->bindValue('uuid', $uuid);
        return $stmt->execute();
    }
    catch (PDOException $e){
        return $e;
    }
}


function genererNumTransaction(){
    do{
        $num = mt_rand(0,9).mt_rand(0,9).mt_rand(0,9).mt_rand(0,9).mt_rand(0,9).mt_rand(0,9).mt_rand(0,9).mt_rand(0,9).mt_rand(0,9).mt_rand(0,9).mt_rand(0,9).mt_rand(0,9).mt_rand(0,9).mt_rand(0,9).mt_rand(0,9);
        try{
        $dbh = Connection();
        $sql = "SELECT id FROM `transaction` WHERE `num_transaction` = :num_transaction";
        $stmt = $dbh->prepare($sql);
        $stmt->bindValue('num_transaction', $num);
        $stmt->execute();
        }
        catch (PDOException $e){
            $num = -1;
        }
    }
    while($stmt->rowCount() > 0);
    return $num;

}


function getGIE($id){
    try{
        $dbh = Connection();
        $sql = "SELECT * FROM gie WHERE etat = 1 AND id = :id";
        $stmt = $dbh->prepare($sql);
        $stmt->bindValue('id', $id);
        $stmt->execute();
        return $stmt->fetchObject();

    }
    catch (PDOException $e){
        return -1;
    }
}


function genererTicketCarte($numtransac, $uuid, $iduser, $nbre_section, $montant, $idbus, $trajet, $gie, $section_courante, $date, $idcarte){

    $etat = 1;
    try{
        $dbh = Connection();
        $sql = "INSERT INTO `transaction`(`num_transaction`, `date`, `receveur`, `bus`, `trajet`, `ticket`, `etat`, `montant`, `numGIE`, `nombre_section`, `section_courante`, `uuid`, `fkcarte`) VALUES (:num_transaction, :date_creation, :receveur, :bus, :trajet, :ticket, :etat, :montant, :numGIE, :nombre_section, :section_courante, :uuid, :fkcarte)";
        $stmt = $dbh->prepare($sql);
        $stmt->bindValue('num_transaction', $numtransac);
        $stmt->bindValue('date_creation', $date);
        $stmt->bindValue('receveur', $iduser);
        $stmt->bindValue('bus', $idbus);
        $stmt->bindValue('trajet', $trajet);
        $stmt->bindValue('ticket', $nbre_section);
        $stmt->bindValue('etat', $etat);
        $stmt->bindValue('montant', $montant);
        $stmt->bindValue('numGIE', $gie);
        $stmt->bindValue('nombre_section', $nbre_section);
        $stmt->bindValue('section_courante', $section_courante);
        $stmt->bindValue('uuid', $uuid);
        $stmt->bindValue('fkcarte', $idcarte);
        return $stmt->execute();
    }
    catch (PDOException $e){
        return $e;
    }
}

function getCarte($id){
    try{
        $dbh = Connection();
        $sql = "SELECT id, numero, numero_serie, client, statut, solde FROM carte WHERE chip = :id";
        $stmt = $dbh->prepare($sql);
        $stmt->bindValue('id', $id);
        $stmt->execute();
        if($stmt->rowCount() === 1)
            return $stmt->fetchObject();
        else
            return $stmt->rowCount();

    }
    catch (PDOException $e){
        return -1;
    }
}


function debiterCarte($id, $montant){
    try{
        $dbh = Connection();
        $sql = "UPDATE carte SET solde = solde - :montant WHERE statut = 1 AND id = :id";
        $stmt = $dbh->prepare($sql);
        $stmt->bindValue('montant', $montant);
        $stmt->bindValue('id', $id);
        $stmt->execute();
        return $stmt->rowCount();

    }
    catch (PDOException $e){
        return -1;
    }
}


function getSoldeCarte($numcarte){
    try{
        $dbh = Connection();
        $sql = "SELECT solde FROM carte WHERE statut = 1 AND numero = :id";
        $stmt = $dbh->prepare($sql);
        $stmt->bindValue('id', $numcarte);
        $stmt->execute();
        return $stmt->fetchObject()->solde;

    }
    catch (PDOException $e){
        return -1;
    }
}

function getLastTicketTouser($uuid, $iduser, $idbus, $trajet, $gie){
    try{
        $dbh = Connection();
        $today = date('Y-m-d');
        $sql = "SELECT transaction.id, transaction.num_transaction,transaction.date,transaction.montant, transaction.nombre_section, trajet.lieu_depart, trajet.lieu_arrive FROM transaction INNER JOIN voyage ON trajet = voyage.id INNER JOIN trajet ON voyage.trajet_id = trajet.id WHERE DATE(date) = :today AND transaction.etat = 1 AND transaction.bus = :bus AND transaction.trajet = :trajet AND transaction.numGIE = :gie AND transaction.uuid = :uuid AND receveur = :iduser ORDER BY transaction.id DESC";
        $stmt = $dbh->prepare($sql);
        $stmt->bindValue('today', $today);
        $stmt->bindValue('bus', $idbus);
        $stmt->bindValue('trajet', $trajet);
        $stmt->bindValue('gie', $gie);
        $stmt->bindValue('uuid', $uuid);
        $stmt->bindValue('iduser', $iduser);
        $stmt->execute();
        if($stmt->rowCount() > 0)
            return $stmt->fetchObject();
        else
            return -2;

    }
    catch (PDOException $e){
        return -1;
    }
}


function saveReleveClient($numtransac, $solde_avant, $date_trans, $montant, $operation, $solde_apres, $carte_id, $client_id){

    $etat = 1;
    try{
        $dbh = Connection();
        $sql = "INSERT INTO `releve_carte_client`(`solde_avant`, `solde_apres`, `montant`, `num_trans`, `date_trans`, `carte_id`, `client_id`, `operation`) VALUES (:solde_avant, :solde_apres, :montant, :num_trans, :date_trans, :carte_id, :client_id, :operation)";
        $stmt = $dbh->prepare($sql);
        $stmt->bindValue('solde_avant', $solde_avant);
        $stmt->bindValue('solde_apres', $solde_apres);
        $stmt->bindValue('montant', $montant);
        $stmt->bindValue('num_trans', $numtransac);
        $stmt->bindValue('date_trans', $date_trans);
        $stmt->bindValue('carte_id', $carte_id);
        $stmt->bindValue('client_id', $client_id);
        $stmt->bindValue('operation', $operation);
        return $stmt->execute();
    }
    catch (PDOException $e){
        return $e;
    }
}


function historiqueDuJourTicket($uuid, $iduser, $idbus, $date){
    try{
        $dbh = Connection();
        $sql = "SELECT transaction.id, transaction.num_transaction,TIME(transaction.date) as date, transaction.montant, transaction.nombre_section, trajet.lieu_depart, trajet.lieu_arrive, transaction.fkcarte FROM transaction INNER JOIN voyage ON trajet = voyage.id INNER JOIN trajet ON voyage.trajet_id = trajet.id WHERE DATE(date) = :today AND transaction.etat = 1 AND transaction.bus = :bus AND transaction.uuid = :uuid AND receveur = :iduser ORDER BY transaction.id DESC";
        $stmt = $dbh->prepare($sql);
        $stmt->bindValue('today', $date);
        $stmt->bindValue('bus', $idbus);
        $stmt->bindValue('uuid', $uuid);
        $stmt->bindValue('iduser', $iduser);
        $stmt->execute();
        if($stmt->rowCount() > 0)
            return $stmt->fetchAll();
        else
            return [];
    }
    catch (PDOException $e){
        return $e;
    }
}


function historiqueDuVoyageTicket($uuid, $iduser, $trajet, $idbus, $date){
    try{
        $dbh = Connection();
        $sql = "SELECT transaction.id, transaction.num_transaction,TIME(transaction.date) as date, transaction.montant, transaction.nombre_section, trajet.lieu_depart, trajet.lieu_arrive, transaction.fkcarte FROM transaction INNER JOIN voyage ON trajet = voyage.id INNER JOIN trajet ON voyage.trajet_id = trajet.id WHERE DATE(date) = :today AND transaction.etat = 1 AND transaction.bus = :bus AND transaction.trajet = :trajet AND transaction.uuid = :uuid AND receveur = :iduser ORDER BY transaction.id DESC";
        $stmt = $dbh->prepare($sql);
        $stmt->bindValue('today', $date);
        $stmt->bindValue('bus', $idbus);
        $stmt->bindValue('trajet', $trajet);
        $stmt->bindValue('uuid', $uuid);
        $stmt->bindValue('iduser', $iduser);
        $stmt->execute();
        if($stmt->rowCount() > 0)
            return $stmt->fetchAll();
        else
            return [];
    }
    catch (PDOException $e){
        return $e;
    }
}

function fermerVoyage($voyage, $bus, $iduser){
    try{
        $dbh = Connection();
        $sql = "UPDATE voyage SET etat = 2 WHERE id = :id AND bus_id = :bus_id AND receveur_id = :receveur_id";
        $stmt = $dbh->prepare($sql);
        $stmt->bindValue('bus_id', $bus);
        $stmt->bindValue('receveur_id', $iduser);
        $stmt->bindValue('id', $voyage);
        $stmt->execute();
        return $stmt->rowCount();

    }
    catch (PDOException $e){
        return -1;
    }
}
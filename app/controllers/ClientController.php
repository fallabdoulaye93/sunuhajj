<?php

/**
 * Created by PhpStorm.
 * User: Seyni FAYE
 * Date: 15/02/2017
 * Time: 21:11
 */

namespace app\controllers;

use app\core\BaseController;
use app\core\Session;
use app\core\Utils;
use app\models\ClientModel;

class ClientController extends BaseController
{
    private $clientModels;


    public function __construct()
    {

        parent::__construct();
        $this->clientModels = new ClientModel();

        $this->views->initTemplate(["header" => "header", "footer" => "footer", "sidebar" => "sidebar_client"]);

    }

    /**************************************************************** DEBUT EMPLOYE ******************************************************************/



    /************************ Gestion des Receveurs  **********************/
    // Modal Ajout Receveur

    public function ajoutClientModal()
    {
        $this->modal();
    }

    public function ajoutRechargementModal()
    {
        //var_dump($this->paramGET);exit;

        $data['idcarte'] = $this->paramGET[0];
        $this->views->setData($data);
        $this->modal();
    }




    public function updateClient()
    {
        $id = $this->paramPOST['id'] ;
        unset($this->paramPOST['id']);
        $data['champs'] = $this->paramPOST;
        //var_dump($data); exit;

        $resultUpdate = $this->clientModels->set(["table"=>"client","champs" => $data['champs'], "condition"=>["id ="=>base64_decode($id)]]);
        if ($resultUpdate !== false) Utils::setMessageALert(["success",$this->lang["succes_update"]]);
        else Utils::setMessageALert(["danger", $this->lang["echec_update"]]);
        Utils::redirect("client", "liste");
    }



    public function verifExistenceEmail()
    {
        $verif = $this->clientModels->verifEmailModel($this->paramPOST['email']);
        if($verif==1) echo 1;
        else echo -1;
    }

    /*public function verifExistenceCarte($numSerie)
    {
        if ($numSerie == '')
            $numSerie = $this->paramPOST['numcarte'] ;

        $param1 = [
            "table"=>"carte c",
            "champs"=>["c.numero_serie"],
            "condition"=>["c.numero_serie = " => $numSerie]
        ];
        $carte = $this->clientModels->get($param1);

        if($carte){
            $param = [
                "table"=>"carte c",
                "champs"=>["u.id","u.nom", "u.prenom","telephone", "c.numero_serie"],
                "jointure" => ["INNER JOIN client u on u.numcarte = c.numero_serie"],

                "condition"=>["c.numero_serie = " => $numSerie]
            ];
            $client = $this->clientModels->get($param);
            if ($client){
                $message = $this->lang['carte_deja_attribue_a'].$client[0]->prenom.' '.$client[0]->nom.' Telephone'.$client[0]->telephone ;
                if ($type != '')
                   return array('code'=>-2,'message'=>$message) ;
                else
                    echo json_encode(array('code'=>-2,'message'=>$message)) ;
            }else{
                $message = $this->lang['carte_disponible'] ;

                if ($type != '')
                    return array('code'=>1,'message'=>$message) ;
                else
                    echo json_encode(array('code'=>1,'message'=>$message)) ;
            }
        }else{
            $message = $this->lang['carte_inexsistante'] ;

            if ($type != '')
                return array('code'=>-1,'message'=>$message) ;
            else
                echo json_encode(array('code'=>-1,'message'=>$message)) ;
        }

    }*/

    public function verifExistenceCarte()
    {
        $numSerie = $this->paramPOST['numcarte'] ;
        $param1 = [
            "table"=>"carte c",
            "champs"=>["c.*"],
            "condition"=>["c.numero_serie = " => $numSerie]
        ];
        $carte = $this->clientModels->get($param1);
        if(count($carte) === 1){
            if($carte[0]->client == 0 && $carte[0]->statut == 0){
                $message = $this->lang['carte_disponible'];
                return array('code'=>1,'message'=>$message);
            }
            else{
                $message = $this->lang['carte_deja_attribue_a'];
                return array('code'=>-2,'message'=>$message) ;
            }
        }else{
            $message = $this->lang['carte_inexsistante'] ;
            echo json_encode(array('code'=>-1,'message'=>$message)) ;

        }

    }


    public function verifNumSerieCarte()
    {
        $numSerie = $this->paramPOST['numcarte'] ;
        $param1 = [
            "table"=>"carte c",
            "champs"=>["c.*"],
            "condition"=>["c.numero_serie = " => $numSerie]
        ];
        $carte = $this->clientModels->get($param1);
        if(count($carte) === 1){
            if($carte[0]->client == 0 && $carte[0]->statut == 0){
                $message = $this->lang['carte_disponible'];
                echo json_encode(array('code'=>1,'message'=>$message));
                exit();
            }
            else{
                $message = $this->lang['carte_deja_attribue_a'];
                echo json_encode(array('code'=>-2,'message'=>$message));
                exit();
            }
        }else{
            $message = $this->lang['carte_inexsistante'] ;
            echo json_encode(array('code'=>-1,'message'=>$message));
            exit();

        }

    }

    // Ajout Receveur
    public function ajoutClient__()
    {
        $this->paramPOST['gie'] = $this->_USER->gie;

        try{
            $this->clientModels->__beginTransaction() ;

            $numserie = $this->paramPOST['numcarte'] ;

            $retour = $this->verifExistenceCarte($numserie);

            if($retour['code'] == 1){

                if (Utils::validateMail($this->paramPOST["email"])) {

                    $this->paramPOST["telephone"] = str_replace('+', '00', $this->paramPOST["telephone"]);
                    $this->paramPOST["user_creation"]= $this->_USER->id;
                    $this->paramPOST["date_creation"]= date('Y-m-d H:i:s');
                    $this->paramPOST["profession"]= 1;
                    $this->paramPOST["etat"]= 0;
                    $this->paramPOST["adresse"]= '';
                    unset($this->paramPOST["numcarte"]);

                    $result = $this->clientModels->insertClient(["champs" => $this->paramPOST]);

                    if (!($result))
                        throw new \Exception($this->lang["echec_add_client"].' table client') ;

                    $resultUpdateCarte = $this->clientModels->set(["table" => "carte", "champs" => ["client = " => $result, "statut = " => 1, "user_creation = " => $this->_USER->id], "condition" => ["numero_serie =" => $numserie]]);

                    if (!$resultUpdateCarte)
                        throw new \Exception($this->lang["echec_add_client"].' table carte') ;

                } else
                    throw new \Exception($this->lang["emailInvalide"]) ;

            }else
                throw new \Exception($retour['message']) ;

            $this->clientModels->__commit() ;
            Utils::setMessageALert(["success", $this->lang["client_ajouté_avec_succes"]]);

        }catch (\Exception $exception){

            $this->clientModels->__rollBack() ;
            Utils::setMessageALert(["danger", $exception->getMessage()]);
        }

        Utils::redirect("client", "liste");

    }

    // Vérifier si email existe déjà


    // Vérifier si email existe déjà
    public function verifExistenceLogin()
    {
        $verif = $this->utilisateurModels->verifLoginModel($this->paramPOST['login']);
        if($verif==1) echo 1;
        else echo -1;
    }

    // Modification Droit
    public function modifClientModal()
    {
        $data['client'] = $this->clientModels->get(["table"=>"client","champs"=>["*"],"condition" => ["id = " => $this->paramGET[2]]])[0];
        $this->views->setData($data);
        $this->modal();

    }

    public function liste__()
    {
        $this->views->getTemplate("client/liste");
    }

    // Processing Droit
    public function listePro__()
    {
        if ($this->_USER) {
            if ($this->_USER->admin == 1 || \app\core\Utils::getModel('client')->__authorized($this->_USER->idprofil, 'client', 'modifClientModal') > 0) {
                $param = [
                    "button" => [
                        "modal" => [
                            ["client/modifClientModal", "client/modifClientModal", "fa fa-edit"]
                        ],
                        "default" => [
                            ["champ" => "etat","val" => ["0" => ["client/activateClient/","fa fa-toggle-off"],"1" => ["client/desactivateClient/", "fa fa-toggle-on"]]],
                            ["client/detailClient/", "fa fa-search"],
                        ]
                        //"custom" => ["<span style='color: red;'>test</span>",["champ"=>"nom","val"=>["Faye"=>"<span style='color: red;'>faye</span>"]]]
                    ],
                    "tooltip" => [
                        "modal" => [$this->lang['Modifier'],["champ"=>"_etat_","val"=>["0"=>$this->lang['Activer'],"1"=>$this->lang['Désactiver']]]],
                        "default" => [["champ"=>"etat","val"=>["0"=>$this->lang['Activer'],"1"=>$this->lang['Désactiver']]], $this->lang['Detail']]
                    ],
                    "classCss" => [
                        "modal" => [],
                        "default" => ["confirm"]
                    ],
                    "attribut" => [],
                    "args" => $this->_USER,
                    "dataVal" => [
                        ["champ" => "etat", "val" => ["0" => ["<i class='text-danger'>".$this->lang['Desactive']." </i>"], "1" => ["<i class='text-success'>".$this->lang['Active']."</i>"]]]
                    ],
                    "fonction" => ["solde"=>"getMontant"]
                ];
            }
            $this->processing($this->clientModels, 'getAllClient', $param);
        }
    }

    public function rechargementPro__()
    {
        //var_dump($this->paramGET);
       // if ($this->_USER) {
           // if ($this->_USER->admin == 1 || \app\core\Utils::getModel('client')->__authorized($this->_USER->idprofil, 'client', 'modifClientModal') > 0) {
                $param = [
                    "button" => [
                        "modal" => [
                            ["client/modifClientModal", "client/modifClientModal", "fa fa-edit"]
                        ],
                        "default" => [
                            ["champ" => "etat","val" => ["0" => ["client/activateClient/","fa fa-toggle-off"],"1" => ["client/desactivateClient/", "fa fa-toggle-on"]]],
                            ["client/detailClient/", "fa fa-search"],
                        ]
                        //"custom" => ["<span style='color: red;'>test</span>",["champ"=>"nom","val"=>["Faye"=>"<span style='color: red;'>faye</span>"]]]
                    ],
                    "tooltip" => [
                        "modal" => [$this->lang['Modifier'],["champ"=>"_etat_","val"=>["0"=>$this->lang['Activer'],"1"=>$this->lang['Désactiver']]]],
                        "default" => [["champ"=>"etat","val"=>["0"=>$this->lang['Activer'],"1"=>$this->lang['Désactiver']]], $this->lang['Detail']]
                    ],
                    "classCss" => [
                        "modal" => [],
                        "default" => ["confirm"]
                    ],
                    "attribut" => [],
                    "args" => $this->paramGET,
                    "dataVal" => [
                        ["champ" => "etat", "val" => ["0" => ["<i class='text-danger'>".$this->lang['Desactive']." </i>"], "1" => ["<i class='text-success'>".$this->lang['Active']."</i>"]]]
                    ],
                    "fonction" => ["montant"=>"getMontant","solde_avant"=>"getMontant","solde_apres"=>"getMontant"]
                ];
            //}
            $this->processing($this->clientModels, 'getAllRechargementClient', $param);

       // }
    }

    public function detailClient(){

        $data['client'] = $this->clientModels->get(["table"=>"client c","champs"=>["c.* "," ca.id as idCarte" ,"ca.solde" , "ca.numero_serie"],"jointure"=>[" LEFT JOIN carte ca on  c.id = ca.client  "],"condition" => ["c.id = " => $this->paramGET[0]]])[0];

        $this->views->setData($data);
        $this->views->getTemplate('client/detailClient');

    }






    public function updateEtatReceveur()
    {
        //parent::validateToken("administration", "listeUtilisateur");

        $data['condition'] = ["id = " => base64_decode($this->paramPOST['id'])];
        $id = $this->paramPOST['id'];
        unset($this->paramPOST['id']);
        $data['champs'] = $this->paramPOST;
        $result = $this->receveurModels->updateReceveur($data);
        if ($result !== false) Utils::setMessageALert(["success",  $this->lang["succes_update_receveur"]]);
        else Utils::setMessageALert(["danger", $this->lang["echec_update_receveur"]]);

        if($this->paramGET[0]=="r"){Utils::redirect("employe", "detailReceveur");
        }else{Utils::redirect("employe",  "detailReceveur"."/".$id);}
    }


    // Activation droit
    public function activateClient()
    {
        if (intval($this->paramGET[0]) > 0) {
            $result = $this->clientModels->set(["table"=>"client","champs" => ["etat" => 1], "condition" => ["id = " => intval($this->paramGET[0])]]);
            if ($result !== false) Utils::setMessageALert(["success", $this->lang["succes_activate_element"]]);
            else Utils::setMessageALert(["danger", $this->lang["echec_activate_element"]]);
        } else Utils::setMessageALert(["danger",  $this->lang["echec_activate_element"]]);
        Utils::redirect("client", "liste");
    }

    // Desactivation droit
    public function desactivateClient()
    {
        //var_dump($this->paramGET[0]);exit;
        if (intval($this->paramGET[0]) > 0) {
            $result = $this->clientModels->set(["table"=>"client","champs" => ["etat" => 0], "condition" => ["id = " => intval($this->paramGET[0])]]);
            if ($result !== false) Utils::setMessageALert(["success", $this->lang["succes_activate_element"]]);
            else Utils::setMessageALert(["danger", $this->lang["echec_activate_element"]]);
        } else Utils::setMessageALert(["danger",  $this->lang["echec_activate_element"]]);
        Utils::redirect("client", "liste");
    }

    public function ajoutRechargement()
    {
    $this->clientModels->__beginTransaction() ;
        try{
            $idCarte = $this->paramPOST['idCarte'] ;
            $idClient = $this->paramPOST['idClient'] ;


            if ($idCarte){

                $montant = $this->paramPOST['montant'] ;
                $ancien_solde = $this->paramPOST['ancien_solde'] ;

                $champs = array();
                $champs['user_id'] = $this->_USER->id ;
                $champs['carte_id'] = $idCarte ;
                $champs['date_transac'] = date("Y-m-d H:i:s") ;

                $champs['num_transac'] = $this->clientModels->Generer_numtransaction() ;
                $champs['montant'] = $montant;
                $champs['solde_avant'] = $ancien_solde;
                $champs['solde_apres'] = intval($montant + $ancien_solde);

                $resultHisto = $this->clientModels->set(["table"=>"histo_rechargement","champs" => $champs]);
                if (!($resultHisto))
                    throw new \Exception($this->lang["echec_add_element"].' table histo_rechargement') ;


                $resultUpdateCarte = $this->clientModels->set(["table"=>"carte", "champs"=>["solde = solde +  " => $montant], "condition"=>["id ="=>$idCarte]]);

                if (!$resultUpdateCarte)
                    throw new \Exception('echec insert table carte') ;

            }else
                throw new \Exception($this->lang["carte_inexsistante"]) ;


            $this->clientModels->__commit() ;
            Utils::setMessageALert(["success", $this->lang["succes_add_element"]]);

        }catch (\Exception $e){
            $this->clientModels->__rollBack() ;
            Utils::setMessageALert(["danger",  $this->lang["echec_add_element"]." ".$e->getMessage()]);
        }

        Utils::redirect("client", "detailClient/".$idClient);

    }




    /************************ Gestion des Controleurs  **********************/
    // Modal Ajout Controleur


    /******************** FIN Gestion Controleur ******************************/


    /**************************************************************** FIN PARAMETRAGE ******************************************************************/





}
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
use app\models\ControleurModel;
use app\models\BagagesModel;
use app\models\ReceveurModel;

class BagagesController extends BaseController
{
    private $bagagesModels;


    public function __construct()
    {

        parent::__construct();
        $this->bagagesModels = new BagagesModel();
        $this->receveurModels = new ReceveurModel();
        $this->controleurModels = new ControleurModel();


        //var_dump($this->_USER);die;

        $this->views->initTemplate(["header" => "header", "footer" => "footer", "sidebar" => "sidebar_bagages"]);

    }

    public function index__()
    {
        $this->views->getTemplate('bagages/listbagages');

    }



    /**************************************************************** DEBUT EMPLOYE ******************************************************************/

    /*********************** DEBUT Gestion des CHauffeur ************************/

    // Ajout Droit
    public function ajoutChauffeurModal()
    {
        //$data['bagages '] = $this->bagagesModels->getChauffeur();
        //$this->views->setData($data);
        $this->modal();
    }

    // Ajout Droit
    public function insertChauffeur__()
    {
  // var_dump($this->paramPOST);die;
        $dossier_photo = ROOT."assets/pictures/";
        $file_photo = basename($_FILES['photo']['name']);
        if ($file_photo != null) {

            if (move_uploaded_file($_FILES['photo']['tmp_name'], $dossier_photo.$file_photo)) //Si la fonction renvoie TRUE, c'est que &ccedil;a a fonctionn&eacute;...
            {
                $info = new \SplFileInfo($file_photo);
                $new_name = date("YmdHis") . '.' . $info->getExtension();
                rename($dossier_photo . $file_photo, $dossier_photo . $new_name);
                $file_photo = $new_name;
            }
        }
        $this->paramPOST['photo'] = $file_photo;
        $this->paramPOST['numGie'] = $this->_USER->gie;

        $result = $this->bagagesModels->insertChauffeur(["champs" => $this->paramPOST]);

        if ($result !== false) Utils::setMessageALert(["success", $this->lang["Chauffeur_ajouté_avec_succes"]]);
        else Utils::setMessageALert(["danger", $this->lang["Echec_de_lajout_du_chauffeur"]]);
        Utils::redirect("bagages ", "listeChauffeur");

    }

    // Modification Droit
    public function modifChauffeurModal()

    {//var_dump($this->paramGET[2]);die();
        $data['bagages '] = $this->bagagesModels->getChauffeur(["condition" => ["id = " => $this->paramGET[2]]])[0];
       // $data['module'] = $this->moduleModels->getModule();

        $this->views->setData($data);
        $this->modal();

    }

    // Update Droit
    public function updateChauffeur()
    {
        //parent::validateToken("administration", "listeDroit");
        //var_dump($this->paramPOST['id']);die();
        $data['condition'] = ["id = " => base64_decode($this->paramPOST['id'])];

        unset($this->paramPOST['id']);
        $data['champs'] = $this->paramPOST;

        $result = $this->bagagesModels->updateChauffeur($data);
        if ($result !== false) Utils::setMessageALert(["success", $this->lang["succes_update_chauffeur"]]);
        else Utils::setMessageALert(["danger", $this->lang["echec_update_chauffeur"]]);
        Utils::redirect("bagages ", "listeChauffeur");
    }
    public function updateChauffeurDetail()
    {
        //parent::validateToken("administration", "listeDroit");
        //var_dump($this->paramPOST['id']);die();
        $data['condition'] = ["id = " => base64_decode($this->paramPOST['id'])];
        $id = $this->paramPOST['id'];
        unset($this->paramPOST['id']);
        $data['champs'] = $this->paramPOST;
        $result = $this->bagagesModels->updateChauffeurDetail($data);
        if ($result !== false) Utils::setMessageALert(["success", $this->lang["succes_update_chauffeur"]]);
        else Utils::setMessageALert(["danger",$this->lang["echec_update_chauffeur"]]);

        if($this->paramGET[0]=="r"){Utils::redirect("bagages ", "detailChauffeur");
        }else{Utils::redirect("bagages ",  "detailChauffeur"."/".$id);}
    }
    // Supression droit
    public function removeChauffeur()
    {
        if (intval($this->paramGET[0]) > 0) {
            $result = $this->bagagesModels->deleteChauffeur(["condition" => ["id = " => $this->paramGET[0]]]);
            if ($result !== false) Utils::setMessageALert(["success", $this->lang["succes_delete_chauffeur"]]);
            else Utils::setMessageALert(["danger", $this->lang["echec_delete_chauffeur"]]);
        } else Utils::setMessageALert(["danger", $this->lang["echec_delete_chauffeur"]]);
        Utils::redirect("bagages ", "listeChauffeur");
    }

    //  Liste droit
    public function listeChauffeur__()
    {
        $this->views->getTemplate("bagages /listeChauffeur");
    }

    // Processing Droit
    public function listeChauffeurPro__()
    { //var_dump($this->_USER);die;
        if ($this->_USER) {
            if ($this->_USER->admin == 1  || \app\core\Utils::getModel('bagages ')->__authorized($this->_USER->idprofil, 'bagages ', 'modifChauffeurModal') > 0) {
                $param = [

                "button" => [
                        "modal" => [
                            ["bagages /modifChauffeurModal", "bagages /modifChauffeurModal", "fa fa-edit"]
                        ],
                        "default" => [
                            ["champ" => "etat","val" => ["0" => ["bagages /activateChauffeur/","fa fa-toggle-off"],"1" => ["bagages /deactivateChauffeur/", "fa fa-toggle-on"]]],
                            ["bagages /removeChauffeur/", "fa fa-trash"],
                            ["bagages /detailChauffeur/", "fa fa-search"],
                        ]
                        //"custom" => ["<span style='color: red;'>test</span>",["champ"=>"nom","val"=>["Faye"=>"<span style='color: red;'>faye</span>"]]]
                    ],
                    "tooltip" => [
                        "modal" => [$this->lang['Modifier'],["champ"=>"_etat_","val"=>["0"=>$this->lang['Activer'],"1"=>$this->lang['Désactiver']]]],

                        "default" => [["champ"=>"etat","val"=>["0"=>$this->lang['Activer'],"1"=>$this->lang['Désactiver']]], $this->lang['Supprimer'],$this->lang['Detail']]
                    ],
                    "classCss" => [
                        "modal" => [],
                        "default" => ["confirm","confirm"]
                    ],
                    "attribut" => [],
                    "args" =>  $this->_USER,
                    "dataVal" => [
                        ["champ" => "etat", "val" => ["0" => ["<i class='text-danger'>".$this->lang['Desactive']." </i>"], "1" => ["<i class='text-success'>".$this->lang['Active']."</i>"]]]
                    ],
                    "fonction" => []
                ];
                $this->processing($this->bagagesModels, 'getAllChauffeur', $param);


            } else {
                $param = [
                    "button" => [
                        "modal" => [],
                        "default" => []
                        //"custom" => ["<span style='color: red;'>test</span>",["champ"=>"nom","val"=>["Faye"=>"<span style='color: red;'>faye</span>"]]]
                    ],
                    "tooltip" => [],
                    "classCss" => [
                        "modal" => [],
                        "default" => ["confirm"]
                    ],
                    "attribut" => [],
                    "args" => null,
                    "dataVal" => [],
                    "fonction" => []
                ];
                $this->processing($this->bagagesModels, 'getAllChauffeur', $param);


            }

        }
    }

    public function detailChauffeur(){

        $etat = 1;

        $data['bagages '] = $this->bagagesModels->getOneChauffeur(["condition" => ["e.id = " => $this->paramGET[0]]]);
        //var_dump($data['bagages ']);die();

        $this->views->setData($data);
        $this->views->getTemplate('bagages /detailChauffeur');

    }


    // Activation droit
    public function activateChauffeur()
    {
        if (intval($this->paramGET[0]) > 0) {
            $result = $this->bagagesModels->updateChauffeur(["champs" => ["etat" => 1], "condition" => ["id = " => $this->paramGET[0]]]);
            if ($result !== false) Utils::setMessageALert(["success", $this->lang["succes_activate_chauffeur"]]);
            else Utils::setMessageALert(["danger", $this->lang["echec_activate_chauffeur"]]);
        } else Utils::setMessageALert(["danger", $this->lang["echec_activate_chauffeur"]]);
        Utils::redirect("bagages ", "listeChauffeur");
    }

    // Desactivation droit
    public function deactivateChauffeur()
    {
        if (intval($this->paramGET[0]) > 0) {
            $result = $this->bagagesModels->updateChauffeur(["champs" => ["etat" => 0], "condition" => ["id = " => $this->paramGET[0]]]);
            if ($result !== false) Utils::setMessageALert(["success", $this->lang["succes_desactivate_chauffeur"]]);
            else Utils::setMessageALert(["danger", $this->lang["echec_desactivate_chauffeur"]]);
        } else Utils::setMessageALert(["danger", $this->lang["echec_desactivate_chauffeur"]]);
        Utils::redirect("bagages ", "listeChauffeur");
    }
    public function updateChauffeurUser()
    {
        //parent::validateToken("administration", "listeUtilisateur");

        $data['condition'] = ["id = " => base64_decode($this->paramPOST['id'])];
        $id = $this->paramPOST['id'];
        unset($this->paramPOST['id']);
        $data['champs'] = $this->paramPOST;
        $result = $this->bagagesModels->updateChauffeur($data);
        if ($result !== false) Utils::setMessageALert(["success",  $this->lang["succes_desactivate_chauffeur"]]);
        else Utils::setMessageALert(["danger", $this->lang["echec_desactivate_chauffeur"]]);

        if($this->paramGET[0]=="r"){Utils::redirect("bagages ", "detailChauffeur");
        }else{Utils::redirect("bagages ",  "detailChauffeur"."/".$id);}
    }
    public function updateEtatChauffeur()
    {
        //parent::validateToken("administration", "listeUtilisateur");

        $data['condition'] = ["id = " => base64_decode($this->paramPOST['id'])];
        $id = $this->paramPOST['id'];
        unset($this->paramPOST['id']);
        $data['champs'] = $this->paramPOST;
        $result = $this->bagagesModels->updateChauffeur($data);
        if ($result !== false) Utils::setMessageALert(["success", $this->lang["succes_activate_chauffeur"]]);
        else Utils::setMessageALert(["danger",  $this->lang["echec_activate_chauffeur"]]);

        if($this->paramGET[0]=="r"){Utils::redirect("bagages ", "detailChauffeur");
        }else{Utils::redirect("bagages ",  "detailChauffeur"."/".$id);}
    }

    // Update utilisateur
    public function updatePhotoChauffeur()
    {
        $data['condition'] = ["id = " => base64_decode($this->paramPOST['id'])];
        $id = $this->paramPOST['id'];
        unset($this->paramPOST['id']);
        $dossier_photo = ROOT."assets/pictures/";
        //AJOUT PHOTO ET SIGNATURE
        $file_photo = basename($_FILES['photo']['name']);
        //var_dump($dossier_photo);exit;
        if ($file_photo != null) {

            if (move_uploaded_file($_FILES['photo']['tmp_name'], $dossier_photo.$file_photo)) //Si la fonction renvoie TRUE, c'est que &ccedil;a a fonctionn&eacute;...
            {
                //var_dump($file_photo);exit;
                $info = new \SplFileInfo($file_photo);
                $new_name = date("YmdHis") . '.' . $info->getExtension();
                rename($dossier_photo . $file_photo, $dossier_photo . $new_name);
                $file_photo = $new_name;
            }
        }
        $this->paramPOST['photo'] = $file_photo;



        $data['champs'] = $this->paramPOST;

        //var_dump($data);die();

        $rst= $this->bagagesModels->updatePhotoChauffeur($data);
        //var_dump($rst);
        if($rst >0)
        {
            Utils::setMessageALert(["type"=>"success","alert"=>$this->lang["action_success"]]);
            //$this->utilisateurModels->log_journal('Modification Photo', 'Photo : '.$_POST['photo'], 'modification avec succès', 1, $this->_USER->id);
        }
        else
        {
            Utils::setMessageALert(["type"=>"danger","alert"=>$this->lang["action_error"]]);
            //$this->utilisateurModels->log_journal('Modification Photo', 'Photo : '.$_POST['photo'], 'modification echouée', 1, $this->_USER->id);
        }
        Utils::redirect('bagages ', "detailChauffeur"."/".$id);
    }

    /*********************** FIN Gestion des Chauffeurs*********************/


       /************************ Gestion des Receveurs  **********************/
    // Modal Ajout Receveur

    public function ajoutReceveurModal()
    {

//        $data['bagages '] = $this->bagagesModels->getReceveur();
        $data['profil'] = $this->receveurModels->getProfil();
        $data['idGIE'] = $this->_USER->gie;
        $this->views->setData($data);
        $this->modal();
    }

    // Ajout Receveur
    public function ajoutReceveur__()
    {
        //var_dump($this->paramPOST);die;
        $pass['pass'] = "Passer@2019";
        //$pass = Utils::getGeneratePassword(12);
        $pwd = $pass['pass'];
        $this->paramPOST["password"] = sha1($pwd);
        $prenom = $this->paramPOST["prenom"];
        $nom = $this->paramPOST["nom"];
        $email = $this->paramPOST["email"];
        $login = $this->paramPOST["login"];


        $dossier_photo = ROOT."app/pictures/";
        $file_photo = basename($_FILES['photo']['name']);
        if ($file_photo != null) {

            if (move_uploaded_file($_FILES['photo']['tmp_name'], $dossier_photo.$file_photo)) //Si la fonction renvoie TRUE, c'est que &ccedil;a a fonctionn&eacute;...
            {
                $info = new \SplFileInfo($file_photo);
                $new_name = date("YmdHis") . '.' . $info->getExtension();
                rename($dossier_photo . $file_photo, $dossier_photo . $new_name);
                $file_photo = $new_name;
            }
        }
        $this->paramPOST['photo'] = $file_photo;
        $this->paramPOST['gie'] = $this->_USER->gie;
        $this->paramPOST['type'] = 3;

        if (Utils::validateMail($this->paramPOST["email"])) {

            if (!$this->receveurModels->VerifEmail(['utilisateur', 'email'], $this->paramPOST["email"])) {

                $this->paramPOST["user_creation"]= $this->_USER->id;
                $result = $this->bagagesModels->insertReceveur(["champs" => $this->paramPOST]);

                if ($result !== false){
                    Utils::envoiparametre($prenom.' '.$nom, $email, $login, $pwd);
                    Utils::setMessageALert(["success", $this->lang["receveur_ajouté_avec_succes"]]);
                }

                else Utils::setMessageALert(["danger", $this->lang["Echec_de_lajout_du_receveur"]]);

            } else Utils::setMessageALert(["danger", $this->lang["email_existe"]]);


        } else Utils::setMessageALert(["warning", $this->lang["emailInvalide"]]);

        Utils::redirect("bagages ", "listeReceveur");

    }

    // Vérifier si email existe déjà
    public function verifExistenceEmail()
    {
        $verif = $this->utilisateurModels->verifEmailModel($this->paramPOST['email']);
        if($verif==1) echo 1;
        else echo -1;
    }

    // Vérifier si email existe déjà
    public function verifExistenceLogin()
    {
        $verif = $this->utilisateurModels->verifLoginModel($this->paramPOST['login']);
        if($verif==1) echo 1;
        else echo -1;
    }

    // Modification Droit
    public function modifReceveurModal()

    {//var_dump($this->paramGET[2]);die();
        $data['utilisateur'] = $this->receveurModels->getReceveur(["condition" => ["id = " => $this->paramGET[2]]])[0];

        // $data['module'] = $this->moduleModels->getModule();

        $this->views->setData($data);
        $this->modal();

    }

    // Update Droit
    public function updateReceveur()
    {
        //parent::validateToken("administration", "listeDroit");
//var_dump($this->paramPOST['id']);die();
        $data['condition'] = ["id = " => base64_decode($this->paramPOST['id'])];

        unset($this->paramPOST['id']);
        $data['champs'] = $this->paramPOST;

        $result = $this->receveurModels->updateReceveur($data);
        if ($result !== false) Utils::setMessageALert(["success",$this->lang["succes_update_receveur"]]);
        else Utils::setMessageALert(["danger", $this->lang["echec_update_receveur"]]);
        Utils::redirect("bagages ", "listeReceveur");
    }


    public function updateReceveurDetail()
    {
        //parent::validateToken("administration", "listeDroit");
        //var_dump($this->paramPOST['id']);die();
        $data['condition'] = ["id = " => base64_decode($this->paramPOST['id'])];
        $id = $this->paramPOST['id'];
        unset($this->paramPOST['id']);
        $data['champs'] = $this->paramPOST;
        $result = $this->receveurModels->updateReceveurDetail($data);
        if ($result !== false) Utils::setMessageALert(["success", $this->lang["succes_update_receveur"]]);
        else Utils::setMessageALert(["danger", $this->lang["echec_update_receveur"]]);
        if($this->paramGET[0]=="r"){Utils::redirect("bagages ", "detailReceveur"."/".$id);
        }else{Utils::redirect("bagages ",  "detailReceveur"."/".$id);}
    }
    // Supression droit
    public function removeReceveur()
    {
        if (intval($this->paramGET[0]) > 0) {
            $result = $this->receveurModels->deleteReceveur(["condition" => ["id = " => $this->paramGET[0]]]);
            if ($result !== false) Utils::setMessageALert(["success", $this->lang["succes_delete_receveur"]]);
            else Utils::setMessageALert(["danger", $this->lang["echec_delete_receveur"]]);
        } else Utils::setMessageALert(["danger", $this->lang["echec_delete_receveur"]]);
        Utils::redirect("bagages ", "listeReceveur");
    }

    //  Liste droit
    public function listeReceveur__()
    {
        $this->views->getTemplate("bagages /listeReceveur");
    }

    // Processing Droit
    public function listeReceveurPro__()
    {
        if ($this->_USER) {
            if ($this->_USER->admin == 1 || \app\core\Utils::getModel('receveur')->__authorized($this->_USER->idprofil, 'receveur', 'modifReceveurModal') > 0) {
                $param = [
                    "button" => [
                        "modal" => [
                            ["bagages /modifReceveurModal", "bagages /modifReceveurModal", "fa fa-edit"]
                        ],
                        "default" => [
                            ["champ" => "etat","val" => ["0" => ["bagages /activateReceveur/","fa fa-toggle-off"],"1" => ["bagages /deactivateReceveur/", "fa fa-toggle-on"]]],
                            ["bagages /removeReceveur/", "fa fa-trash"],
                            ["bagages /detailReceveur/", "fa fa-search"],
                        ]
                        //"custom" => ["<span style='color: red;'>test</span>",["champ"=>"nom","val"=>["Faye"=>"<span style='color: red;'>faye</span>"]]]
                    ],
                    "tooltip" => [
                        "modal" => [$this->lang['Modifier'],["champ"=>"_etat_","val"=>["0"=>$this->lang['Activer'],"1"=>$this->lang['Désactiver']]]],
                        "default" => [["champ"=>"etat","val"=>["0"=>$this->lang['Activer'],"1"=>$this->lang['Désactiver']]], $this->lang['Supprimer'],$this->lang['Detail']]
                    ],
                    "classCss" => [
                        "modal" => [],
                        "default" => ["confirm","confirm"]
                    ],
                    "attribut" => [],
                    "args" => $this->_USER,
                    "dataVal" => [
                        ["champ" => "etat", "val" => ["0" => ["<i class='text-danger'>".$this->lang['Desactive']." </i>"], "1" => ["<i class='text-success'>".$this->lang['Active']."</i>"]]]
                    ],
                    "fonction" => []
                ];
                $this->processing($this->receveurModels, 'getAllReceveur', $param);


//            } else {
//                $param = [
//                    "button" => [
//                        "modal" => [],
//                        "default" => []
//                        //"custom" => ["<span style='color: red;'>test</span>",["champ"=>"nom","val"=>["Faye"=>"<span style='color: red;'>faye</span>"]]]
//                    ],
//                    "tooltip" => [],
//                    "classCss" => [
//                        "modal" => [],
//                        "default" => ["confirm"]
//                    ],
//                    "attribut" => [],
//                    "args" => null,
//                    "dataVal" => [],
//                    "fonction" => []
//                ];
//                $this->processing($this->bagagesModels, 'getAllReceveur', $param);
//
//
//            }

        }
    }
    }


    public function detailReceveur(){

        $etat = 1;
        $data['user'] = $this->receveurModels->getOneReceveur(["condition" => ["u.id = " => $this->paramGET[0]]]);
        $data['profil'] = $this->receveurModels->getProfil(["condition" => ["etat = " => $etat]]);
        //echo '<pre>'; var_dump($data['user']);die();
        $this->views->setData($data);
        $this->views->getTemplate('bagages /detailReceveur');

    }
    public function updatePhotoReceveur()
    {
        $data['condition'] = ["id = " => base64_decode($this->paramPOST['id'])];
        $id = $this->paramPOST['id'];
        unset($this->paramPOST['id']);
        $dossier_photo = ROOT."assets/pictures/";
        //AJOUT PHOTO ET SIGNATURE
        $file_photo = basename($_FILES['photo']['name']);
        //var_dump($dossier_photo);exit;
        if ($file_photo != null) {

            if (move_uploaded_file($_FILES['photo']['tmp_name'], $dossier_photo.$file_photo)) //Si la fonction renvoie TRUE, c'est que &ccedil;a a fonctionn&eacute;...
            {
                //var_dump($file_photo);exit;
                $info = new \SplFileInfo($file_photo);
                $new_name = date("YmdHis") . '.' . $info->getExtension();
                rename($dossier_photo . $file_photo, $dossier_photo . $new_name);
                $file_photo = $new_name;
            }
        }
        $this->paramPOST['photo'] = $file_photo;



        $data['champs'] = $this->paramPOST;

        //var_dump($data);die();

        $rst= $this->receveurModels->updatePhotoReceveur($data);

        if($rst >0)
        {
            Utils::setMessageALert(["type"=>"success","alert"=>$this->lang["action_success"]]);
            //$this->utilisateurModels->log_journal('Modification Photo', 'Photo : '.$_POST['photo'], 'modification avec succès', 1, $this->_USER->id);
        }
        else
        {
            Utils::setMessageALert(["type"=>"danger","alert"=>$this->lang["action_error"]]);
            //$this->utilisateurModels->log_journal('Modification Photo', 'Photo : '.$_POST['photo'], 'modification echouée', 1, $this->_USER->id);
        }
        Utils::redirect('bagages ', "detailReceveur"."/".$id);
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

        if($this->paramGET[0]=="r"){Utils::redirect("bagages ", "detailReceveur");
        }else{Utils::redirect("bagages ",  "detailReceveur"."/".$id);}
    }


    // Activation droit
    public function activateReceveur()
    {
        if (intval($this->paramGET[0]) > 0) {
            $result = $this->receveurModels->updateReceveur(["champs" => ["etat" => 1], "condition" => ["id = " => $this->paramGET[0]]]);
            if ($result !== false) Utils::setMessageALert(["success", $this->lang["succes_activate_receveur"]]);
            else Utils::setMessageALert(["danger", $this->lang["echec_activate_receveur"]]);
        } else Utils::setMessageALert(["danger",  $this->lang["echec_activate_receveur"]]);
        Utils::redirect("bagages ", "listeReceveur");
    }

    // Desactivation droit
    public function deactivateReceveur()
    {
        if (intval($this->paramGET[0]) > 0) {
            $result = $this->receveurModels->updateReceveur(["champs" => ["etat" => 0], "condition" => ["id = " => $this->paramGET[0]]]);
            if ($result !== false) Utils::setMessageALert(["success", $this->lang["succes_desactivate_receveur"]]);
            else Utils::setMessageALert(["danger", $this->lang["echec_desactivate_receveur"]]);
        } else Utils::setMessageALert(["danger",$this->lang["echec_desactivate_receveur"]]);
        Utils::redirect("bagages ", "listeReceveur");
    }
    /******************** FIN Gestion Receveur ******************************/

    /************************ Gestion des Controleurs  **********************/
    // Modal Ajout Controleur

    public function ajoutControleurModal()
    {
        $data['bagages '] = $this->bagagesModels->getControleur();
        $this->views->setData($data);
        $this->modal();
    }

    // Ajout Controleur
    public function ajoutControleur()
    {
        $dossier_photo = ROOT."assets/pictures/";
        $file_photo = basename($_FILES['photo']['name']);
        if ($file_photo != null) {

            if (move_uploaded_file($_FILES['photo']['tmp_name'], $dossier_photo.$file_photo)) //Si la fonction renvoie TRUE, c'est que &ccedil;a a fonctionn&eacute;...
            {
                $info = new \SplFileInfo($file_photo);
                $new_name = date("YmdHis") . '.' . $info->getExtension();
                rename($dossier_photo . $file_photo, $dossier_photo . $new_name);
                $file_photo = $new_name;
            }
        }
        $this->paramPOST['photo'] = $file_photo;
        $this->paramPOST['numGie'] = $this->_USER->gie;

        $result = $this->controleurModels->insertControleur(["champs" => $this->paramPOST]);

        if ($result !== false) Utils::setMessageALert(["success", $this->lang['controleurAjoute']]);
        else Utils::setMessageALert(["danger", "Echec_d'ajout_du_controleur"]);
        Utils::redirect("bagages ", "listeControleur");

    }

    // Modification Droit
    public function modifControleurModal()

    {
        $data['controleur'] = $this->controleurModels->getControleur(["condition" => ["id = " => $this->paramGET[2]]])[0];
        // $data['module'] = $this->moduleModels->getModule();

        $this->views->setData($data);
        $this->modal();

    }

    // Update Droit
    public function updateControleur()
    {
        //parent::validateToken("administration", "listeDroit");
//var_dump($this->paramPOST['id']);die();
        $data['condition'] = ["id = " => base64_decode($this->paramPOST['id'])];

        unset($this->paramPOST['id']);
        $data['champs'] = $this->paramPOST;

        $result = $this->controleurModels->updateControleur($data);
        if ($result !== false) Utils::setMessageALert(["success", $this->lang["succes_update_controleur"]]);
        else Utils::setMessageALert(["danger", $this->lang["echec_update_controleur"]]);
        Utils::redirect("bagages ", "listeControleur");
    }
    public function updateControleurDetail()
    {
        //parent::validateToken("administration", "listeDroit");
        //var_dump($this->paramPOST['id']);die();
        $data['condition'] = ["id = " => base64_decode($this->paramPOST['id'])];
        $id = $this->paramPOST['id'];
        unset($this->paramPOST['id']);
        $data['champs'] = $this->paramPOST;
        $result = $this->controleurModels->updateControleurDetail($data);
        if ($result !== false) Utils::setMessageALert(["success", $this->lang["succes_update_controleur"]]);
        else Utils::setMessageALert(["danger", $this->lang["echec_update_controleur"]]);

        if($this->paramGET[0]=="r"){Utils::redirect("bagages ", "detailControleur");
        }else{Utils::redirect("bagages ",  "detailControleur"."/".$id);}
    }
    public function updatePhotoControleur()
    {
        $data['condition'] = ["id = " => base64_decode($this->paramPOST['id'])];
        $id = $this->paramPOST['id'];
        unset($this->paramPOST['id']);
        $dossier_photo = ROOT."assets/pictures/";
        //AJOUT PHOTO ET SIGNATURE
        $file_photo = basename($_FILES['photo']['name']);
        //var_dump($dossier_photo);exit;
        if ($file_photo != null) {

            if (move_uploaded_file($_FILES['photo']['tmp_name'], $dossier_photo.$file_photo)) //Si la fonction renvoie TRUE, c'est que &ccedil;a a fonctionn&eacute;...
            {
                //var_dump($file_photo);exit;
                $info = new \SplFileInfo($file_photo);
                $new_name = date("YmdHis") . '.' . $info->getExtension();
                rename($dossier_photo . $file_photo, $dossier_photo . $new_name);
                $file_photo = $new_name;
            }
        }
        $this->paramPOST['photo'] = $file_photo;



        $data['champs'] = $this->paramPOST;

        //var_dump($data);die();

        $rst= $this->controleurModels->updatePhotoControleur($data);

        if($rst >0)
        {
            Utils::setMessageALert(["type"=>"success","alert"=>$this->lang["action_success"]]);
            //$this->utilisateurModels->log_journal('Modification Photo', 'Photo : '.$_POST['photo'], 'modification avec succès', 1, $this->_USER->id);
        }
        else
        {
            Utils::setMessageALert(["type"=>"danger","alert"=>$this->lang["action_error"]]);
            //$this->utilisateurModels->log_journal('Modification Photo', 'Photo : '.$_POST['photo'], 'modification echouée', 1, $this->_USER->id);
        }
        Utils::redirect('bagages ', "detailControleur"."/".$id);
    }

    // Supression droit
    public function removeControleur()
    {
        if (intval($this->paramGET[0]) > 0) {
            $result = $this->controleurModels->deleteControleur(["condition" => ["id = " => $this->paramGET[0]]]);
            if ($result !== false) Utils::setMessageALert(["success", $this->lang["succes_delete_controleur"]]);
            else Utils::setMessageALert(["danger", $this->lang["echec_delete_controleur"]]);
        } else Utils::setMessageALert(["danger", $this->lang["echec_delete_controleur"]]);
        Utils::redirect("bagages ", "listeControleur");
    }

    //  Liste droit
    public function listeControleur__()
    {
        $this->views->getTemplate("bagages /listeControleur");
    }

    // Processing Droit
    public function listeControleurPro()
    {
        if ($this->_USER) {
            if ($this->_USER->admin == 1 || \app\core\Utils::getModel('bagages ')->__authorized($this->_USER->idprofil, 'bagages ', 'modifControleurmodal') > 0) {
                $param = [
                    "button" => [
                        "modal" => [
                            ["bagages /modifControleurModal", "bagages /modifControleurModal", "fa fa-edit"]
                        ],
                        "default" => [
                            ["champ" => "etat","val" => ["0" => ["bagages /activateControleur/","fa fa-toggle-off"],"1" => ["bagages /deactivateControleur/", "fa fa-toggle-on"]]],
                            ["bagages /removeControleur/", "fa fa-trash"],
                            ["bagages /detailControleur/", "fa fa-search"],
                        ]
                        //"custom" => ["<span style='color: red;'>test</span>",["champ"=>"nom","val"=>["Faye"=>"<span style='color: red;'>faye</span>"]]]
                    ],
                    "tooltip" => [
                        "modal" => [$this->lang['Modifier'],["champ"=>"_etat_","val"=>["0"=>$this->lang['Activer'],"1"=>$this->lang['Désactiver']]]],
                        "default" => [["champ"=>"etat","val"=>["0"=>$this->lang['Activer'],"1"=>$this->lang['Désactiver']]], $this->lang['Supprimer'],$this->lang['Detail']]
                    ],
                    "classCss" => [
                        "modal" => [],
                        "default" => ["confirm","confirm"]
                    ],
                    "attribut" => [],
                    "args" => $this->_USER,
                    "dataVal" => [
                        ["champ" => "etat", "val" => ["0" => ["<i class='text-danger'>".$this->lang['Desactive']." </i>"], "1" => ["<i class='text-success'>".$this->lang['Active']."</i>"]]]
                    ],
                    "fonction" => []
                ];
                $this->processing($this->controleurModels, 'getAllControleur', $param);


            } else {
                $param = [
                    "button" => [
                        "modal" => [],
                        "default" => []
                        //"custom" => ["<span style='color: red;'>test</span>",["champ"=>"nom","val"=>["Faye"=>"<span style='color: red;'>faye</span>"]]]
                    ],
                    "tooltip" => [],
                    "classCss" => [
                        "modal" => [],
                        "default" => ["confirm"]
                    ],
                    "attribut" => [],
                    "args" => null,
                    "dataVal" => [],
                    "fonction" => []
                ];
                $this->processing($this->bagagesModels, 'getAllControleur', $param);


            }

        }
    }

    public function detailControleur(){

        $data['controleur'] = $this->controleurModels->getOneControleur(["condition" => ["c.id = " => $this->paramGET[0]]]);
        //var_dump($data['controleur']);die();

        $this->views->setData($data);
        $this->views->getTemplate('bagages /detailControleur');
    }
    public function updateEtatControleur()
    {
        //parent::validateToken("administration", "listeUtilisateur");

        $data['condition'] = ["id = " => base64_decode($this->paramPOST['id'])];
        $id = $this->paramPOST['id'];
        unset($this->paramPOST['id']);
        $data['champs'] = $this->paramPOST;
        $result = $this->controleurModels->updateControleur($data);
        if ($result !== false) Utils::setMessageALert(["success",$this->lang["succes_update_controleur"]]);
        else Utils::setMessageALert(["danger", $this->lang["echec_update_controleur"]]);

        if($this->paramGET[0]=="r"){Utils::redirect("bagages ", "detailControleur");
        }else{Utils::redirect("bagages ",  "detailControleur"."/".$id);}
    }

    // Activation droit
    public function activateControleur()
    {
        if (intval($this->paramGET[0]) > 0) {
            $result = $this->controleurModels->updateControleur(["champs" => ["etat" => 1], "condition" => ["id = " => $this->paramGET[0]]]);
            if ($result !== false) Utils::setMessageALert(["success", $this->lang["succes_activate_controleur"]]);
            else Utils::setMessageALert(["danger", $this->lang["echec_activate_controleur"]]);
        } else Utils::setMessageALert(["danger", $this->lang["echec_activate_controleur"]]);
        Utils::redirect("bagages ", "listeControleur");
    }

    // Desactivation droit
    public function deactivateControleur()
    {
        if (intval($this->paramGET[0]) > 0) {
            $result = $this->controleurModels->updateControleur(["champs" => ["etat" => 0], "condition" => ["id = " => $this->paramGET[0]]]);
            if ($result !== false) Utils::setMessageALert(["success", $this->lang["succes_desactivate_controleur"]]);
            else Utils::setMessageALert(["danger", $this->lang["echec_desactivate_controleur"]]);
        } else Utils::setMessageALert(["danger", $this->lang["echec_desactivate_controleur"]]);
        Utils::redirect("bagages ", "listeControleur");
    }
    /******************** FIN Gestion Controleur ******************************/


    /**************************************************************** FIN PARAMETRAGE ******************************************************************/





}

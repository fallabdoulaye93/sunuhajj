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
use app\models\TierModel;
use app\models\ReceveurModel;

class TierController extends BaseController
{
    private $tierModels;


    public function __construct()
    {

        parent::__construct();
        $this->tierModels = new TierModel();
        $this->receveurModels = new ReceveurModel();
        $this->controleurModels = new ControleurModel();


        //var_dump($this->_USER);die;

        $this->views->initTemplate(["header" => "header", "footer" => "footer", "sidebar" => "sidebar_tier"]);

    }

    public function index__()
    {
        $this->views->getTemplate('tier/listtiers');

    }



    /**************************************************************** DEBUT EMPLOYE ******************************************************************/

    /*********************** DEBUT Gestion des CHauffeur ************************/

    // Ajout Droit
    public function ajoutChauffeurModal()
    {
        //$data['tier '] = $this->tierModels->getChauffeur();
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

        $result = $this->tierModels->insertChauffeur(["champs" => $this->paramPOST]);

        if ($result !== false) Utils::setMessageALert(["success", $this->lang["Chauffeur_ajouté_avec_succes"]]);
        else Utils::setMessageALert(["danger", $this->lang["Echec_de_lajout_du_chauffeur"]]);
        Utils::redirect("tier ", "listeChauffeur");

    }

    // Modification Droit
    public function modifChauffeurModal()

    {//var_dump($this->paramGET[2]);die();
        $data['tier '] = $this->tierModels->getChauffeur(["condition" => ["id = " => $this->paramGET[2]]])[0];
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

        $result = $this->tierModels->updateChauffeur($data);
        if ($result !== false) Utils::setMessageALert(["success", $this->lang["succes_update_chauffeur"]]);
        else Utils::setMessageALert(["danger", $this->lang["echec_update_chauffeur"]]);
        Utils::redirect("tier ", "listeChauffeur");
    }
    public function updateChauffeurDetail()
    {
        //parent::validateToken("administration", "listeDroit");
        //var_dump($this->paramPOST['id']);die();
        $data['condition'] = ["id = " => base64_decode($this->paramPOST['id'])];
        $id = $this->paramPOST['id'];
        unset($this->paramPOST['id']);
        $data['champs'] = $this->paramPOST;
        $result = $this->tierModels->updateChauffeurDetail($data);
        if ($result !== false) Utils::setMessageALert(["success", $this->lang["succes_update_chauffeur"]]);
        else Utils::setMessageALert(["danger",$this->lang["echec_update_chauffeur"]]);

        if($this->paramGET[0]=="r"){Utils::redirect("tier ", "detailChauffeur");
        }else{Utils::redirect("tier ",  "detailChauffeur"."/".$id);}
    }
    // Supression droit
    public function removeChauffeur()
    {
        if (intval($this->paramGET[0]) > 0) {
            $result = $this->tierModels->deleteChauffeur(["condition" => ["id = " => $this->paramGET[0]]]);
            if ($result !== false) Utils::setMessageALert(["success", $this->lang["succes_delete_chauffeur"]]);
            else Utils::setMessageALert(["danger", $this->lang["echec_delete_chauffeur"]]);
        } else Utils::setMessageALert(["danger", $this->lang["echec_delete_chauffeur"]]);
        Utils::redirect("tier ", "listeChauffeur");
    }

    //  Liste droit
    public function listeChauffeur__()
    {
        $this->views->getTemplate("tier /listeChauffeur");
    }

    // Processing Droit
    public function listeChauffeurPro__()
    { //var_dump($this->_USER);die;
        if ($this->_USER) {
            if ($this->_USER->admin == 1  || \app\core\Utils::getModel('tier ')->__authorized($this->_USER->idprofil, 'tier ', 'modifChauffeurModal') > 0) {
                $param = [

                "button" => [
                        "modal" => [
                            ["tier /modifChauffeurModal", "tier /modifChauffeurModal", "fa fa-edit"]
                        ],
                        "default" => [
                            ["champ" => "etat","val" => ["0" => ["tier /activateChauffeur/","fa fa-toggle-off"],"1" => ["tier /deactivateChauffeur/", "fa fa-toggle-on"]]],
                            ["tier /removeChauffeur/", "fa fa-trash"],
                            ["tier /detailChauffeur/", "fa fa-search"],
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
                $this->processing($this->tierModels, 'getAllChauffeur', $param);


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
                $this->processing($this->tierModels, 'getAllChauffeur', $param);


            }

        }
    }

    public function detailChauffeur(){

        $etat = 1;

        $data['tier '] = $this->tierModels->getOneChauffeur(["condition" => ["e.id = " => $this->paramGET[0]]]);
        //var_dump($data['tier ']);die();

        $this->views->setData($data);
        $this->views->getTemplate('tier /detailChauffeur');

    }


    // Activation droit
    public function activateChauffeur()
    {
        if (intval($this->paramGET[0]) > 0) {
            $result = $this->tierModels->updateChauffeur(["champs" => ["etat" => 1], "condition" => ["id = " => $this->paramGET[0]]]);
            if ($result !== false) Utils::setMessageALert(["success", $this->lang["succes_activate_chauffeur"]]);
            else Utils::setMessageALert(["danger", $this->lang["echec_activate_chauffeur"]]);
        } else Utils::setMessageALert(["danger", $this->lang["echec_activate_chauffeur"]]);
        Utils::redirect("tier ", "listeChauffeur");
    }

    // Desactivation droit
    public function deactivateChauffeur()
    {
        if (intval($this->paramGET[0]) > 0) {
            $result = $this->tierModels->updateChauffeur(["champs" => ["etat" => 0], "condition" => ["id = " => $this->paramGET[0]]]);
            if ($result !== false) Utils::setMessageALert(["success", $this->lang["succes_desactivate_chauffeur"]]);
            else Utils::setMessageALert(["danger", $this->lang["echec_desactivate_chauffeur"]]);
        } else Utils::setMessageALert(["danger", $this->lang["echec_desactivate_chauffeur"]]);
        Utils::redirect("tier ", "listeChauffeur");
    }
    public function updateChauffeurUser()
    {
        //parent::validateToken("administration", "listeUtilisateur");

        $data['condition'] = ["id = " => base64_decode($this->paramPOST['id'])];
        $id = $this->paramPOST['id'];
        unset($this->paramPOST['id']);
        $data['champs'] = $this->paramPOST;
        $result = $this->tierModels->updateChauffeur($data);
        if ($result !== false) Utils::setMessageALert(["success",  $this->lang["succes_desactivate_chauffeur"]]);
        else Utils::setMessageALert(["danger", $this->lang["echec_desactivate_chauffeur"]]);

        if($this->paramGET[0]=="r"){Utils::redirect("tier ", "detailChauffeur");
        }else{Utils::redirect("tier ",  "detailChauffeur"."/".$id);}
    }
    public function updateEtatChauffeur()
    {
        //parent::validateToken("administration", "listeUtilisateur");

        $data['condition'] = ["id = " => base64_decode($this->paramPOST['id'])];
        $id = $this->paramPOST['id'];
        unset($this->paramPOST['id']);
        $data['champs'] = $this->paramPOST;
        $result = $this->tierModels->updateChauffeur($data);
        if ($result !== false) Utils::setMessageALert(["success", $this->lang["succes_activate_chauffeur"]]);
        else Utils::setMessageALert(["danger",  $this->lang["echec_activate_chauffeur"]]);

        if($this->paramGET[0]=="r"){Utils::redirect("tier ", "detailChauffeur");
        }else{Utils::redirect("tier ",  "detailChauffeur"."/".$id);}
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

        $rst= $this->tierModels->updatePhotoChauffeur($data);
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
        Utils::redirect('tier ', "detailChauffeur"."/".$id);
    }

    /*********************** FIN Gestion des Chauffeurs*********************/


       /************************ Gestion des Receveurs  **********************/
    // Modal Ajout Receveur

    public function ajoutReceveurModal()
    {

//        $data['tier '] = $this->tierModels->getReceveur();
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
                $result = $this->tierModels->insertReceveur(["champs" => $this->paramPOST]);

                if ($result !== false){
                    Utils::envoiparametre($prenom.' '.$nom, $email, $login, $pwd);
                    Utils::setMessageALert(["success", $this->lang["receveur_ajouté_avec_succes"]]);
                }

                else Utils::setMessageALert(["danger", $this->lang["Echec_de_lajout_du_receveur"]]);

            } else Utils::setMessageALert(["danger", $this->lang["email_existe"]]);


        } else Utils::setMessageALert(["warning", $this->lang["emailInvalide"]]);

        Utils::redirect("tier ", "listeReceveur");

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
        Utils::redirect("tier ", "listeReceveur");
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
        if($this->paramGET[0]=="r"){Utils::redirect("tier ", "detailReceveur"."/".$id);
        }else{Utils::redirect("tier ",  "detailReceveur"."/".$id);}
    }
    // Supression droit
    public function removeReceveur()
    {
        if (intval($this->paramGET[0]) > 0) {
            $result = $this->receveurModels->deleteReceveur(["condition" => ["id = " => $this->paramGET[0]]]);
            if ($result !== false) Utils::setMessageALert(["success", $this->lang["succes_delete_receveur"]]);
            else Utils::setMessageALert(["danger", $this->lang["echec_delete_receveur"]]);
        } else Utils::setMessageALert(["danger", $this->lang["echec_delete_receveur"]]);
        Utils::redirect("tier ", "listeReceveur");
    }

    //  Liste droit
    public function listeReceveur__()
    {
        $this->views->getTemplate("tier /listeReceveur");
    }

    // Processing Droit
    public function listeReceveurPro__()
    {
        if ($this->_USER) {
            if ($this->_USER->admin == 1 || \app\core\Utils::getModel('receveur')->__authorized($this->_USER->idprofil, 'receveur', 'modifReceveurModal') > 0) {
                $param = [
                    "button" => [
                        "modal" => [
                            ["tier /modifReceveurModal", "tier /modifReceveurModal", "fa fa-edit"]
                        ],
                        "default" => [
                            ["champ" => "etat","val" => ["0" => ["tier /activateReceveur/","fa fa-toggle-off"],"1" => ["tier /deactivateReceveur/", "fa fa-toggle-on"]]],
                            ["tier /removeReceveur/", "fa fa-trash"],
                            ["tier /detailReceveur/", "fa fa-search"],
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
//                $this->processing($this->tierModels, 'getAllReceveur', $param);
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
        $this->views->getTemplate('tier /detailReceveur');

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
        Utils::redirect('tier ', "detailReceveur"."/".$id);
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

        if($this->paramGET[0]=="r"){Utils::redirect("tier ", "detailReceveur");
        }else{Utils::redirect("tier ",  "detailReceveur"."/".$id);}
    }


    // Activation droit
    public function activateReceveur()
    {
        if (intval($this->paramGET[0]) > 0) {
            $result = $this->receveurModels->updateReceveur(["champs" => ["etat" => 1], "condition" => ["id = " => $this->paramGET[0]]]);
            if ($result !== false) Utils::setMessageALert(["success", $this->lang["succes_activate_receveur"]]);
            else Utils::setMessageALert(["danger", $this->lang["echec_activate_receveur"]]);
        } else Utils::setMessageALert(["danger",  $this->lang["echec_activate_receveur"]]);
        Utils::redirect("tier ", "listeReceveur");
    }

    // Desactivation droit
    public function deactivateReceveur()
    {
        if (intval($this->paramGET[0]) > 0) {
            $result = $this->receveurModels->updateReceveur(["champs" => ["etat" => 0], "condition" => ["id = " => $this->paramGET[0]]]);
            if ($result !== false) Utils::setMessageALert(["success", $this->lang["succes_desactivate_receveur"]]);
            else Utils::setMessageALert(["danger", $this->lang["echec_desactivate_receveur"]]);
        } else Utils::setMessageALert(["danger",$this->lang["echec_desactivate_receveur"]]);
        Utils::redirect("tier ", "listeReceveur");
    }
    /******************** FIN Gestion Receveur ******************************/

    /************************ Gestion des Controleurs  **********************/
    // Modal Ajout Controleur

    public function ajoutControleurModal()
    {
        $data['tier '] = $this->tierModels->getControleur();
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
        Utils::redirect("tier ", "listeControleur");

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
        Utils::redirect("tier ", "listeControleur");
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

        if($this->paramGET[0]=="r"){Utils::redirect("tier ", "detailControleur");
        }else{Utils::redirect("tier ",  "detailControleur"."/".$id);}
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
        Utils::redirect('tier ', "detailControleur"."/".$id);
    }

    // Supression droit
    public function removeControleur()
    {
        if (intval($this->paramGET[0]) > 0) {
            $result = $this->controleurModels->deleteControleur(["condition" => ["id = " => $this->paramGET[0]]]);
            if ($result !== false) Utils::setMessageALert(["success", $this->lang["succes_delete_controleur"]]);
            else Utils::setMessageALert(["danger", $this->lang["echec_delete_controleur"]]);
        } else Utils::setMessageALert(["danger", $this->lang["echec_delete_controleur"]]);
        Utils::redirect("tier ", "listeControleur");
    }

    //  Liste droit
    public function listeControleur__()
    {
        $this->views->getTemplate("tier /listeControleur");
    }

    // Processing Droit
    public function listeControleurPro()
    {
        if ($this->_USER) {
            if ($this->_USER->admin == 1 || \app\core\Utils::getModel('tier ')->__authorized($this->_USER->idprofil, 'tier ', 'modifControleurmodal') > 0) {
                $param = [
                    "button" => [
                        "modal" => [
                            ["tier /modifControleurModal", "tier /modifControleurModal", "fa fa-edit"]
                        ],
                        "default" => [
                            ["champ" => "etat","val" => ["0" => ["tier /activateControleur/","fa fa-toggle-off"],"1" => ["tier /deactivateControleur/", "fa fa-toggle-on"]]],
                            ["tier /removeControleur/", "fa fa-trash"],
                            ["tier /detailControleur/", "fa fa-search"],
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
                $this->processing($this->tierModels, 'getAllControleur', $param);


            }

        }
    }

    public function detailControleur(){

        $data['controleur'] = $this->controleurModels->getOneControleur(["condition" => ["c.id = " => $this->paramGET[0]]]);
        //var_dump($data['controleur']);die();

        $this->views->setData($data);
        $this->views->getTemplate('tier /detailControleur');
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

        if($this->paramGET[0]=="r"){Utils::redirect("tier ", "detailControleur");
        }else{Utils::redirect("tier ",  "detailControleur"."/".$id);}
    }

    // Activation droit
    public function activateControleur()
    {
        if (intval($this->paramGET[0]) > 0) {
            $result = $this->controleurModels->updateControleur(["champs" => ["etat" => 1], "condition" => ["id = " => $this->paramGET[0]]]);
            if ($result !== false) Utils::setMessageALert(["success", $this->lang["succes_activate_controleur"]]);
            else Utils::setMessageALert(["danger", $this->lang["echec_activate_controleur"]]);
        } else Utils::setMessageALert(["danger", $this->lang["echec_activate_controleur"]]);
        Utils::redirect("tier ", "listeControleur");
    }

    // Desactivation droit
    public function deactivateControleur()
    {
        if (intval($this->paramGET[0]) > 0) {
            $result = $this->controleurModels->updateControleur(["champs" => ["etat" => 0], "condition" => ["id = " => $this->paramGET[0]]]);
            if ($result !== false) Utils::setMessageALert(["success", $this->lang["succes_desactivate_controleur"]]);
            else Utils::setMessageALert(["danger", $this->lang["echec_desactivate_controleur"]]);
        } else Utils::setMessageALert(["danger", $this->lang["echec_desactivate_controleur"]]);
        Utils::redirect("tier ", "listeControleur");
    }
    /******************** FIN Gestion Controleur ******************************/


    /**************************************************************** FIN PARAMETRAGE ******************************************************************/





}

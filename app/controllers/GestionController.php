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
use app\models\GestionModel ;

class GestionController extends BaseController
{
    private $gestionModels;


    public function __construct()
    {

        parent::__construct();
        $this->gestionModels = new GestionModel();



        //var_dump($this->_USER);die;

        $this->views->initTemplate(["header" => "header", "footer" => "footer", "sidebar" => "sidebar_admin"]);

    }

    public function index__()
    {
        $this->views->getTemplate('administration/admin');

    }



    /**************************************************************** DEBUT Gestion ******************************************************************/

    /*********************** DEBUT Gestion des types de materiels ************************/

    // Ajout Droit
    public function ajoutTypeModal()
    {
        //$data['employe'] = $this->employeModels->getChauffeur();
        //$this->views->setData($data);
        $this->modal();
    }

    // Ajout Droit
    public function insertType__()
    {
        $this->paramPOST['numGie'] = $this->_USER->gie;

        $result = $this->gestionModels->insertType(["champs" => $this->paramPOST]);

        if ($result !== false) Utils::setMessageALert(["success", $this->lang["type_add_succes"]]);
        else Utils::setMessageALert(["danger", $this->lang["echec_add_type"]]);
        Utils::redirect("gestion", "listeType");

    }

    // Modification Droit
    public function modifTypeModal()

    {//var_dump($this->paramGET[2]);die();
        $data['type_materiel'] = $this->gestionModels->getType(["condition" => ["rowid = " => $this->paramGET[2]]])[0];
        // $data['module'] = $this->moduleModels->getModule();

        $this->views->setData($data);
        $this->modal();

    }

    // Update Droit
    public function updateType()
    {
        //parent::validateToken("administration", "listeDroit");
        //var_dump($this->paramPOST['id']);die();
        $data['condition'] = ["rowid = " => base64_decode($this->paramPOST['rowid'])];

        unset($this->paramPOST['rowid']);
        $data['champs'] = $this->paramPOST;

        $result = $this->gestionModels->updateType($data);
        if ($result !== false) Utils::setMessageALert(["success", $this->lang["succes_update_type"]]);
        else Utils::setMessageALert(["danger", $this->lang["echec_update_type"]]);
        Utils::redirect("gestion", "listeType");
    }
    public function updateTypeDetail()
    {
        //parent::validateToken("administration", "listeDroit");
        //var_dump($this->paramPOST['id']);die();
        $data['condition'] = ["rowid = " => base64_decode($this->paramPOST['rowid'])];
        $rowid = $this->paramPOST['rowid'];
        unset($this->paramPOST['rowid']);
        $data['champs'] = $this->paramPOST;
        $result = $this->gestionModels->updateTypeDetail($data);
        if ($result !== false) Utils::setMessageALert(["success", $this->lang["succes_update_type"]]);
        else Utils::setMessageALert(["danger", $this->lang["echec_update_type"]]);

        if($this->paramGET[0]=="r"){Utils::redirect("gestion", "detailType");
        }else{Utils::redirect("gestion",  "detailType"."/".$rowid);}
    }
    // Supression droit
    public function removeType()
    {
        if (intval($this->paramGET[0]) > 0) {
            $result = $this->gestionModels->deleteType(["condition" => ["rowid = " => $this->paramGET[0]]]);
            if ($result !== false) Utils::setMessageALert(["success", $this->lang["succes_delete_type"]]);
            else Utils::setMessageALert(["danger", $this->lang["echec_delete_type"]]);
        } else Utils::setMessageALert(["danger", $this->lang["echec_delete_type"]]);
        Utils::redirect("gestion", "listeType");
    }

    //  Liste droit
    public function listeType__()
    {
        $this->views->getTemplate("gestion/listeType");
    }

    // Processing Droit
    public function listeTypePro__()
    { //var_dump($this->_USER);die;
        if ($this->_USER) {
           // if ($this->_USER->admin == 1 || \app\core\Utils::getModel('gestion')->__authorized($this->_USER->idprofil, 'gestion', 'modifTypeModal') > 0) {
                $param = [

                    "button" => [
                        "modal" => [
                            ["gestion/modifTypeModal", "gestion/modifTypeModal", "fa fa-edit"]
                        ],
                        "default" => [
                            ["champ" => "etat","val" => ["0" => ["gestion/activateType/","fa fa-toggle-off"],"1" => ["gestion/deactivateType/", "fa fa-toggle-on"]]],
                            ["gestion/removeType/", "fa fa-trash"],
                            ["gestion/detailType/", "fa fa-search"],
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
                $this->processing($this->gestionModels, 'getAllType', $param);


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
                $this->processing($this->gestionModels, 'getAllType', $param);


            }

        }
  //  }

    public function detailType(){

        $etat = 1;

        $data['type_materiel'] = $this->gestionModels->getOneType(["condition" => ["t.rowid = " => $this->paramGET[0]]]);
        //var_dump($data['employe']);die();

        $this->views->setData($data);
        $this->views->getTemplate('gestion/detailType');

    }


    // Activation droit
    public function activateType()
    {
        if (intval($this->paramGET[0]) > 0) {
            $result = $this->gestionModels->updateType(["champs" => ["etat" => 1], "condition" => ["rowid = " => $this->paramGET[0]]]);
            if ($result !== false) Utils::setMessageALert(["success", $this->lang["succes_activate_type"]]);
            else Utils::setMessageALert(["danger", $this->lang["echec_activate_type"]]);
        } else Utils::setMessageALert(["danger", $this->lang["echec_activate_type"]]);
        Utils::redirect("gestion", "listeType");
    }

    // Desactivation droit
    public function deactivateType()
    {
        if (intval($this->paramGET[0]) > 0) {
            $result = $this->gestionModels->updateType(["champs" => ["etat" => 0], "condition" => ["rowid = " => $this->paramGET[0]]]);
            if ($result !== false) Utils::setMessageALert(["success", $this->lang["succes_desactivate_type"]]);
            else Utils::setMessageALert(["danger", $this->lang["echec_desactivate_type"]]);
        } else Utils::setMessageALert(["danger", $this->lang["echec_desactivate_type"]]);
        Utils::redirect("gestion", "listeType");
    }
    public function updateTypeUser()
    {
        //parent::validateToken("administration", "listeUtilisateur");

        $data['condition'] = ["rowid = " => base64_decode($this->paramPOST['rowid'])];
        $rowid = $this->paramPOST['rowid'];
        unset($this->paramPOST['rowid']);
        $data['champs'] = $this->paramPOST;
        $result = $this->gestionModels->updateType($data);
        if ($result !== false) Utils::setMessageALert(["success", $this->lang["succes_desactivate_type"]]);
        else Utils::setMessageALert(["danger", $this->lang["echec_desactivate_type"]]);

        if($this->paramGET[0]=="r"){Utils::redirect("gestion", "detailType");
        }else{Utils::redirect("gestion",  "detailType"."/".$rowid);}
    }
    public function updateEtatType()
    {
        //parent::validateToken("administration", "listeUtilisateur");

        $data['condition'] = ["rowid = " => base64_decode($this->paramPOST['rowid'])];
        $rowid= $this->paramPOST['rowid'];
        unset($this->paramPOST['rowid']);
        $data['champs'] = $this->paramPOST;
        $result = $this->gestionModels->updateType($data);
        if ($result !== false) Utils::setMessageALert(["success", $this->lang["succes_update_type"]]);
        else Utils::setMessageALert(["danger", $this->lang["echec_update_type"]]);

        if($this->paramGET[0]=="r"){Utils::redirect("gestion", "detailType");
        }else{Utils::redirect("gestion",  "detailType"."/".$rowid);}
    }

    // Update utilisateur



    /*********************** FIN Gestion des Types materiels*********************/
    /*******************************************************************************************************************************************************************************************
     *
     */
    /************************ Gestion des Materiels  **********************/
    public function listeMateriel__()
    {
        $this->views->getTemplate("gestion/listeMateriel");

    }

    public function listeMaterielPro__()
    {
        //var_dump(1);die;
        if ($this->_USER) {
            //if ($this->_USER->admin == 1 || \app\core\Utils::getModel('utilsateur')->__authorized($this->_USER->idprofil, 'administration', 'modifUtilisateurModal') > 0) {
                $param = [
                    "button" => [

                        "modal" => [
                            ["gestion/removeMaterielModal", "gestion/removeMaterielModal", "fa fa-trash"],
                            ["champ" => "etat", "val" => ["0" => ["gestion/activateMaterielModal", "gestion/activateMaterielModal", "fa fa-toggle-off"], "1" => ["gestion/desactivateMaterielModal", "gestion/desactivateMaterielModal", "fa fa-toggle-on"]]],


                        ],
                        "default" => [
                            /*["champ" => "etat", "val" => ["0" => ["gestion/activate/", "fa fa-toggle-off"], "1" => ["gestion/deactivate/", "fa fa-toggle-on"]]],
                            ["gestion/removeMateriel/", "fa fa-trash"],
                            ["gestion/detailMateriel/", "fa fa-search"]*/
                        ]

                        //"custom" => ["<span style='color: red;'>test</span>",["champ"=>"nom","val"=>["Faye"=>"<span style='color: red;'>faye</span>"]]]
                    ],
                    "tooltip" => [
                       "modal" => [["champ"=>"_etat_","val"=>["0"=>$this->lang['Activer'],"1"=>$this->lang['Désactiver']]],$this->lang['supprimer']],
                        "default" => [["champ"=>"etat","val"=>["0"=>$this->lang['Activer'],"1"=>$this->lang['Désactiver']]], $this->lang['Supprimer'],$this->lang['Detail']]
                    ],
                    "classCss" => [
                        "modal" => [],
                        "default" => ["confirm", "confirm"]
                    ],
                    "attribut" => [],
                    "args" => $this->_USER,
                    "dataVal" => [
                        ["champ" => "etat", "val" => ["0" => ["<i class='text-danger'>".$this->lang['Desactive']." </i>"], "1" => ["<i class='text-success'>".$this->lang['Active']."</i>"]]]
                    ],
                    "fonction" => ["user_creation"=>"getUserAjout"]
                ];
                $this->processing($this->gestionModels, 'getAllMateriel', $param);

            }
        }

    public function ajoutMaterielModal()
    {
        //$data['type_materiel'] = $this->gestionModels->getTypeMateriel($param);

        //$this->views->setData($data);
        //var_dump($data['nbre']);die();
        // $data['bus'] = $this->busModels->getBus($param);
        //$this->views->setData($data);
        $this->modal();

    }

    public function ajoutMateriel__()
    {
        //parent::validateToken("administration", "listeProfil");
        /*$dossier_photo = ROOT."assets/pictures/";
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
        $this->paramPOST['numGie'] = $this->_USER->gie;*/
        //var_dump($this->paramPOST);die;
        $result = $this->gestionModels->insertMateriel(["champs" => $this->paramPOST]);
        if ($result !== false) Utils::setMessageALert(["success", $this->lang["materiel_add_succes"]]);
        else Utils::setMessageALert(["danger", $this->lang["echec_add_materiel"]]);
        Utils::redirect("gestion", "listeMateriel");

    }

    public function activate()
    {

        if (intval($this->paramGET[0]) > 0) {
            $result = $this->gestionModels->updateMateriel(["champs" => ["etat" => 1], "condition" => ["rowid = " => $this->paramGET[0]]]);
            if ($result !== false) Utils::setMessageALert(["success",   $this->lang["succes_activate_materiel"]]);
            else Utils::setMessageALert(["danger", $this->lang["echec_activate_materiel"]]);
        } else Utils::setMessageALert(["danger", $this->lang["echec_activate_materiel"]]);
        Utils::redirect("gestion", "listeMateriel");
    }

    public function deactivate()
    {
        if (intval($this->paramGET[0]) > 0) {
            $result = $this->gestionModels->updateMateriel(["champs" => ["etat" => 0], "condition" => ["rowid = " => $this->paramGET[0]]]);
            if ($result !== false) Utils::setMessageALert(["success", $this->lang["succes_desactivate_materiel"]]);
            else Utils::setMessageALert(["danger", $this->lang["echec_desactivate_materiel"]]);
        } else Utils::setMessageALert(["danger", $this->lang["echec_desactivate_materiel"]]);
        Utils::redirect("gestion", "listeMateriel");
    }

    public function removeMateriel()
    {
        if (intval($this->paramGET[0]) > 0) {
            $result = $this->gestionModels->deleteMateriel(["condition" => ["rowid = " => $this->paramGET[0]]]);
            if ($result !== false) Utils::setMessageALert(["success", $this->lang["succes_delete_materiel"]]);
            else Utils::setMessageALert(["danger", $this->lang["echec_delete_materiel"]]);
        } else Utils::setMessageALert(["danger", $this->lang["echec_delete_materiel"]]);
        Utils::redirect("gestion", "listeMateriel");

        /*$data['condition'] = ["rowid = " => base64_decode($this->paramPOST['rowid'])];
        unset($this->paramPOST['rowid']);
        $data['champs'] = ["etat = " => (int)base64_decode($this->paramPOST['etat'])];
        $result = $this->gestionModels->updateMateriel($data);
        if ($result !== false) Utils::setMessageALert(["success", $this->lang["succes_delete_materiel"]]);
        else Utils::setMessageALert(["danger",  $this->lang["echec_delete_materiel"]]);
        Utils::redirect("gestion", "listeMateriel");*/
    }

    public function removeMaterielModal()
    {
        //$data['materiel'] = $this->gestionModels->getMateriel(["condition" => ["rowid = " => $this->paramGET[2]]])[0];
      //  $data['type_materiel'] = $this->gestionModels->AllMateriel();
        $data['materiel'] = $this->paramGET[2];
        $this->views->setData($data);

        $this->modal();

    }

    public function activateMaterielModal()
    {

        //$data['materiel'] = $this->gestionModels->getMateriel(["condition" => ["rowid = " => $this->paramGET[2]]])[0];
        //  $data['type_materiel'] = $this->gestionModels->AllMateriel();
        $data['materiel'] = $this->paramGET[2];
        $this->views->setData($data);

        $this->modal();

    }

    public function desactivateMaterielModal()
    {
        $data['materiel'] = $this->paramGET[2];
        $this->views->setData($data);

        $this->modal();

    }


    public function updateMateriel()
    {
        $data['condition'] = ["rowid = " => base64_decode($this->paramPOST['rowid'])];
        unset($this->paramPOST['rowid']);
        $data['champs'] = ["etat = " => (int)base64_decode($this->paramPOST['etat'])];
        $result = $this->gestionModels->updateMateriel($data);
        if ($result !== false) Utils::setMessageALert(["success", $this->lang["succes_update_materiel"]]);
        else Utils::setMessageALert(["danger",  $this->lang["echec_update_materiel"]]);
        Utils::redirect("gestion", "listeMateriel");

    }

    public function detailMateriel(){

        $etat = 1;
        //var_dump($this->paramGET);die();
        $data['materiel'] = $this->gestionModels->getOneMateriel(["condition" => ["m.rowid = " => $this->paramGET[0]]]);
       // $data['type_materiel'] = $this->gestionModels->AllMateriel(["condition" => ["etat = " => $etat]]);
        //echo '<pre>'; var_dump($data['bus']);die();
        $this->views->setData($data);
        $this->views->getTemplate('gestion/detailMateriel');

        //$this->modal();
    }

    public function updateMaterielDetail()
    {


        $data['condition'] = ["rowid = " => base64_decode($this->paramPOST['rowid'])];
        $rowid = $this->paramPOST['rowid'];
        unset($this->paramPOST['rowid']);
        $data['champs'] = $this->paramPOST;
        $result = $this->gestionModels->updateMaterielDetail($data);
        if ($result !== false) Utils::setMessageALert(["success", $this->lang["succes_update_materiel"]]);
        else Utils::setMessageALert(["danger", $this->lang["echec_update_materiel"]]);

        if($this->paramGET[0]=="r"){Utils::redirect("gestion", "detailMateriel"."/".$rowid);
        }else{Utils::redirect("gestion",  "detailMateriel"."/".$rowid);}
    }


    public function updateEtatMateriel()
    {
        //parent::validateToken("administration", "listeUtilisateur");

        $data['condition'] = ["rowid = " => base64_decode($this->paramPOST['rowid'])];
        $rowid = $this->paramPOST['rowid'];
        unset($this->paramPOST['rowid']);
        $data['champs'] = $this->paramPOST;
        $result = $this->gestionModels->updateMateriel($data);
        if ($result !== false) Utils::setMessageALert(["success", $this->lang["succes_update_materiel"]]);
        else Utils::setMessageALert(["danger", $this->lang["echec_update_materiel"]]);
        if($this->paramGET[0]=="r"){Utils::redirect("gestion", "detailMateriel"."/".$rowid);
        }else{Utils::redirect("gestion",  "detailMateriel"."/".$rowid);}
    }

    public function updatePhoto()
    {
        $data['condition'] = ["rowid = " => base64_decode($this->paramPOST['rowid'])];

        $rowid = $this->paramPOST['rowid'];
        unset($this->paramPOST['rowid']);
        $dossier_photo = ROOT."assets/pictures/";
        //AJOUT PHOTO ET SIGNATURE
        $file_photo = basename($_FILES['photo']['name']);

        //exit;
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



        $data['champs'] = $this->paramPOST;
        //var_dump($this->paramPOST);exit();



        $rst= $this->gestionModels->updatePhoto($data);


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
        Utils::redirect('gestion', "detailMateriel"."/".$rowid);
    }

    /**************************************************************** FIN GESTION MATERIELS ******************************************************************/

    /**************************************************************** DEBUT GESTION AFFECTATION ******************************************************************/

public function affectMateriel__()
{
    $this->views->getTemplate("gestion/affectMateriel");
}

// Processing Droit
public function affectMaterielPro__()
{ //var_dump($this->_USER);die;
    if ($this->_USER) {
        // if ($this->_USER->admin == 1 || \app\core\Utils::getModel('gestion')->__authorized($this->_USER->idprofil, 'gestion', 'modifTypeModal') > 0) {
        $param = [

            "button" => [
                "modal" => [
                    [],

                    //    ["gestion/modifAffectMaterielModal", "gestion/modifAffectMaterielModal", "fa fa-edit"]
                ],
                "default" => [
                    ["champ" => "etat","val" => ["0" => ["gestion/affecte/","fa fa-toggle-off"],"1" => ["gestion/desaffecte/", "fa fa-toggle-on"]]],
                    //["gestion/removeAffectMateriel/", "fa fa-trash"],
                   // ["gestion/detailAffectMateriel/", "fa fa-search"],
                ]
                //"custom" => ["<span style='color: red;'>test</span>",["champ"=>"nom","val"=>["Faye"=>"<span style='color: red;'>faye</span>"]]]
            ],
            "tooltip" => [
                "modal" => [$this->lang['Modifier'],["champ"=>"_etat_","val"=>["0"=>$this->lang['Activer'],"1"=>$this->lang['Désactiver']]]],
                "default" => [["champ"=>"etat","val"=>["0"=>$this->lang['Activer'],"1"=>$this->lang['Désactiver']]], $this->lang['Supprimer'],$this->lang['Detail']]
            ],
            "classCss" => [
                "modal" => [],
                "default" => ["confirm"]
            ],
            "attribut" => [],
            "args" =>  $this->_USER,
            "dataVal" => [
                ["champ" => "etat", "val" => ["0" => ["<i class='text-danger'>".$this->lang['Desactive']." </i>"], "1" => ["<i class='text-success'>".$this->lang['Active']."</i>"]]]
            ],
            "fonction" => []
        ];
        $this->processing($this->gestionModels, 'getAllAffectMateriel', $param);


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
        $this->processing($this->gestionModels, 'getAllAffectMateriel', $param);


    }

}
    public function affecte()
    {

        if (intval($this->paramGET[0]) > 0) {
            $result = $this->gestionModels->updateAffectMateriel(["champs" => ["etat" => 1], "condition" => ["rowid = " => $this->paramGET[0]]]);
            if ($result !== false) Utils::setMessageALert(["success", $this->lang["succes_affecte_materiel"]]);
            else Utils::setMessageALert(["danger", $this->lang["echec_affecte_materiel"]]);
        } else Utils::setMessageALert(["danger", $this->lang["echec_affecte_materiel"]]);
        Utils::redirect("gestion", "affectMateriel");
    }

    public function desaffecte()
    {
        //var_dump($this->paramGET[0]); exit;
        if (intval($this->paramGET[0]) > 0) {
            $result = $this->gestionModels->updateAffectMateriel(["champs" => ["etat" => 0], "condition" => ["rowid = " => $this->paramGET[0]]]);
            if ($result !== false) Utils::setMessageALert(["success",  $this->lang["succes_desaffecte_materiel"]]);
            else Utils::setMessageALert(["danger", $this->lang["echec_desaffecte_materiel"]]);
        } else Utils::setMessageALert(["danger", $this->lang["echec_desaffecte_materiel"]]);
        Utils::redirect("gestion", "affectMateriel");
    }

    public function ajoutAffectMaterielModal()
    {

        $data['receveur'] = $this->gestionModels->getReceveur2($this->_USER->gie);

        $data['materiel'] = $this->gestionModels->getMateriel2($this->_USER->gie);

        $data['bus'] = $this->gestionModels->getBus2($this->_USER->gie);

        $this->views->setData($data);
        //$data['employe'] = $this->employeModels->getChauffeur();
        //$this->views->setData($data);
        $this->modal();
    }

    // Ajout Droit
    public function insertAffectMateriel__()
    {
        try{

            $device = explode('-' ,$this->paramPOST['materiel']);
            $this->gestionModels->__beginTransaction() ;

            if (!(count($device) == 2))
                throw new \Exception($this->lang["device_required"]) ;

            $result = $this->gestionModels->insertAffectMateriel(["champs" => ['bus_id' => $this->paramPOST['bus_id'], 'receveur_id' =>$this->paramPOST['receveur_rowid'], 'device_id' =>$device[0], 'date_debut' => Utils::date_aaaa_mm_jj($this->paramPOST['date_debut_affect']), 'date_fin' => Utils::date_aaaa_mm_jj($this->paramPOST['date_fin_affect']), 'etat' => 1, 'gie' =>$this->_USER->gie, 'user_creation' =>$this->_USER->id, 'date_creation' => date('Y-m-d H:i:s')]]);

            if (!($result))
                throw new \Exception('Echec insertion dans affectation_materiel') ;

            /*$resultUpdateMateriel = $this->gestionModels->set(["table"=>"devices", "champs"=>["affecte = "=>1], "condition"=>["rowid ="=>$device[0]]]);

            if (!($resultUpdateMateriel))
                throw new \Exception('Echec update dans devices') ;

            $resultUiidUser = $this->gestionModels->set(["table"=>"utilisateur", "champs"=>["uuid = "=>$device[1]], "condition"=>["id ="=>$this->paramPOST['receveur_rowid']]]);

            if (!($resultUiidUser))
                throw new \Exception('Echec update dans utilisateur') ;*/

            $this->gestionModels->__commit() ;
            Utils::setMessageALert(["success", $this->lang["succes_add_affecte"]]);

        }catch (\Exception $ex){
            $this->gestionModels->__rollBack() ;
            Utils::setMessageALert(["danger", $this->lang["echec_add_affecte"]." ".$ex->getMessage()]);
        }


        Utils::redirect("gestion", "affectMateriel");

    }

    public function removeAffectMateriel()
    {
        if (intval($this->paramGET[0]) > 0) {
            $result = $this->gestionModels->deleteAffectMateriel(["condition" => ["rowid = " => $this->paramGET[0]]]);
            if ($result !== false) Utils::setMessageALert(["success", $this->lang["succes_delete_affecte"]]);
            else Utils::setMessageALert(["danger", $this->lang["echec_delete_affecte"]]);
        } else Utils::setMessageALert(["danger", $this->lang["echec_delete_affecte"]]);
        Utils::redirect("gestion", "affectMateriel");
    }



}







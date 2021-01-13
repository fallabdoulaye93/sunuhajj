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

class ReportingController extends BaseController
{
    private $reportingModels;
    private $partenaireModels;
    private $serviceModels;

    public function __construct()
    {
        parent::__construct();
        $this->reportingModels = $this->model("reporting");
        $this->partenaireModels = $this->model("partenaire");
        $this->serviceModels = $this->model("service");
        $this->views->initTemplate(["header" => "header", "footer" => "footer", "sidebar" => "sidebar_reporting"]);
    }

    public function index__()
    {
        $this->views->getTemplate('reporting/reporting');

    }


    /**************************************************************** DEBUT GESTION DES Reporting ********************************************************/

    /************************ Reporting Par Partenaire **********************/

    // Liste Transactions par Partenaire
    public function transactPartenaire()
    {
        $data['liste_part'] = $this->partenaireModels->getPartenaire();
        $this->views->setData($data);
        $param['part'] = $this->paramPOST['fk_partenaire'];

        if (isset($this->paramPOST["datedeb"]) & isset($this->paramPOST["datefin"])) {

            $param['datedeb'] = Utils::date_aaaa_mm_jj($this->paramPOST['datedeb']) ;
            $param['datefin'] = Utils::date_aaaa_mm_jj($this->paramPOST['datefin']);

        }else{
            $param['datedeb'] = date('Y-m-d');
            $param['datefin'] = date('Y-m-d');
        }

        $this->views->setData($param);
        $this->views->getTemplate('reporting/transactPartenaire');
    }

    // Processing Transactions Partenaires
    public function transactPartenairePro__()
    {
       // var_dump($this->paramGET); die();
        $param = [
                    "button" => [
                        "modal" => [
                            ["reporting/detailTransactPartModal", "reporting/detailTransactPartModal", "fa fa-search"],
                        ],
                        "default" => [
                        ]
                    ],
                    "tooltip" => [
                        "modal" => ["Détail"]
                    ],
                    "classCss" => [
                        "modal" => [],
                        "default" => ["confirm"]
                    ],
                    "attribut" => [],
                    "args" => $this->paramGET,
                    "dataVal" => [
                    ],
                    "fonction" => ["date_transaction"=>"getDateFR","montant"=>"getFormatMoney","commission"=>"getFormatMoney"]
                ];
                $this->processing($this->reportingModels, 'getAllTransactionPartenaire', $param);
    }

    // Détail Transaction Partenaire
    public function detailTransactPartModal()
    {
        $data['transactPart'] = $this->reportingModels->getOneTransaction(["condition" => ["t.rowid = " => $this->paramGET[2]]]);
        $this->views->setData($data);
        $this->modal();
    }

    // Impression transaction Par Service
    public function impressionTransactionPart()
    {
        $datedebut = $this->paramPOST['datedeb'];
        $datefin = $this->paramPOST['datefin'];
        $partenaire = $this->paramPOST['fk_partenaire'];
        $param = [
            "condition"=>["rowid ="=>$partenaire]
        ];
        $data['parte'] = $this->reportingModels->getUnPartenaire($param)[0]->raison_sociale;

        $data['transac'] = $this->reportingModels->getTransactionPartenaire(["condition" =>["t.statut="=>1,"t.fk_partenaire=" => $partenaire, "DATE(t.date_transaction)>=" => $datedebut, "DATE(t.date_transaction)<=" => $datefin]]);
        
        $this->views->setData($data);
        $this->views->exportToPdf("reporting/printTransactionsPart");

    }

    /************************ Reporting Par Partenaire **********************/


    /************************ Reporting Par Service **********************/

    // Liste Transactions par Service
    public function transactService()
    {
        $data['liste_serv'] = $this->serviceModels->getService();
        $this->views->setData($data);
        $param['serv'] = $this->paramPOST['fk_service'];

        if (isset($this->paramPOST["datedeb"]) & isset($this->paramPOST["datefin"])) {

            $param['datedeb'] = Utils::date_aaaa_mm_jj($this->paramPOST['datedeb']) ;
            $param['datefin'] = Utils::date_aaaa_mm_jj($this->paramPOST['datefin']);

        }else{
            $param['datedeb'] = date('Y-m-d');
            $param['datefin'] = date('Y-m-d');
        }

        $this->views->setData($param);
        $this->views->getTemplate('reporting/transactService');
    }

    // Processing Transactions pour un Service
    public function transactServicePro__()
    {
        //var_dump($this->paramGET); die();
        $param = [
            "button" => [
                "modal" => [
                    ["reporting/detailTransactServModal", "reporting/detailTransactServModal", "fa fa-search"],
                ],
                "default" => [
                ]
            ],
            "tooltip" => [
                "modal" => ["Détail"]
            ],
            "classCss" => [
                "modal" => [],
                "default" => ["confirm"]
            ],
            "attribut" => [],
            "args" => $this->paramGET,
            "dataVal" => [
            ],
            "fonction" => ["date_transaction"=>"getDateFR","montant"=>"getFormatMoney","commission"=>"getFormatMoney"]
        ];
        $this->processing($this->reportingModels, 'getAllTransactionService', $param);
    }

    // Détail Transaction d'un Service
    public function detailTransactServModal()
    {
        $data['transactServ'] = $this->reportingModels->getOneService(["condition" => ["t.rowid = " => $this->paramGET[2]]]);
        $this->views->setData($data);
        $this->modal();
    }

    // Impression transaction Par Service
    public function impressionTransactionServ()
    {
        $datedebut = $this->paramPOST['datedeb'];
        $datefin = $this->paramPOST['datefin'];
        $service = $this->paramPOST['fk_service'];

        $param = [
            "condition"=>["rowid ="=>$service]
        ];
        $data['service'] = $this->reportingModels->getUnService($param)[0]->label;

        $data['transact'] = $this->reportingModels->getTransactionService(["condition" =>["t.statut="=>1,"t.fk_service=" => $service, "DATE(t.date_transaction)>=" => $datedebut, "DATE(t.date_transaction)<=" => $datefin]]);
        $this->views->setData($data);
        $this->views->exportToPdf('reporting/printTransactionsServ');
    }

    /************************ Reporting par Service **********************/


    /************************ Commission Partenaire **********************/

    public function commissionPartenaire()
    {
        $data['liste_part'] = $this->partenaireModels->getPartenaire();
        $this->views->setData($data);

        $this->views->getTemplate('reporting/commissionPartenaire');
    }

    public function reportingParPart()
    {

        $data['part'] = $this->paramPOST['fk_partenaire'];

        if (isset($this->paramPOST["datedeb"]) & isset($this->paramPOST["datefin"])) {

            $data['datedeb'] = Utils::date_aaaa_mm_jj($this->paramPOST['datedeb']) ;
            $data['datefin'] = Utils::date_aaaa_mm_jj($this->paramPOST['datefin']);

        }else{
            $data['datedeb'] = date('Y-m-d');
            $data['datefin'] = date('Y-m-d');
        }

        $data['res'] = $this->reportingModels->getComParPart($data['datedeb'],$data['datefin'],$data['part']);

        $data['liste_part'] = $this->partenaireModels->getPartenaire();
        $this->views->setData($data);
        $this->views->getTemplate('reporting/comParPartenaire');
    }

    public function printCommissionPart()
    {
        //var_dump($this->paramPOST); die();

        $datedebut = $this->paramPOST['datedeb'];
        $datefin = $this->paramPOST['datefin'];
        $partenaire = $this->paramPOST['fk_partenaire'];
        $param = [
            "condition"=>["rowid ="=>$partenaire]
        ];
        $data['parte'] = $this->reportingModels->getUnPartenaire($param)[0]->raison_sociale;

        $data['trans'] = $this->reportingModels->getComParPart($datedebut,$datefin,$partenaire);
        //var_dump($data['trans']); die();

        $this->views->setData($data);
        $this->views->exportToPdf('reporting/printCommissionPart');
    }

    /************************ Commission Partenaire **********************/


    /**************************************************************** FIN GESTION DES Reporting ********************************************************/




}
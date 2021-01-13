<?php
/**
 * Created by PhpStorm.
 * User: Seyni FAYE
 * Date: 27/02/2017
 * Time: 16:03
 */

namespace app\models;

use app\core\BaseModel;
use app\core\Security;
use app\core\Utils;

class ReportingModel extends BaseModel
{

    /**
     * HomeModel constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * HomeModel destruct.
     */
    public function __destruct()
    {
        parent::__destruct();
    }

    /**************************************************************** DEBUT TRANSACTIONS PAR PARTENAIRE  ***************************************************/

    /**
     * Lister Transaction Partenaire
     */
    public function getAllTransactionPartenaire($param)
    {
        $this->table = "sva_transaction t";
        $this->champs = ["t.rowid","t.num_transaction","t.date_transaction","t.montant","t.commission","s.label as service","t.commentaire as _commentaire_","t.statut as _statut_"];
        $this->jointure = ["
                        INNER JOIN sva_service_sunusva as s ON t.fk_service = s.rowid
        "];
        $this->condition=["t.statut="=>1, "t.fk_partenaire="=>$param[0], "DATE(t.date_transaction) >="=>$param[1], "DATE(t.date_transaction) <="=>$param[2]];
        return $this->__processing();
    }

    /**
     * Get Transaction Partenaire
     */
    public function getPartenaire($param = null)
    {
        $this->table = "sva_transaction";
        $this->__addParam($param);
        return $this->__select();
    }

    /**
     * Get un Partenaire
     */
    public function getUnPartenaire($param = null)
    {
        $this->table = "sva_partenaire";
        $this->__addParam($param);
        return $this->__select();
    }

    /**
     * Détail Transaction Partenaire
     */
    public function getOneTransaction($param = null)
    {
        $this->table = "sva_transaction t";
        $this->champs = ["t.rowid","t.num_transaction","t.date_transaction","t.montant","t.commission","s.label as service","t.commentaire","t.statut"];
        $this->jointure = ["
                        INNER JOIN sva_service_sunusva as s ON t.fk_service = s.rowid
        "];
        $this->condition = ["t.rowid >="=>$param];
        $this->__addParam($param);
        return $this->__detail();
    }

    /**
     * Impression Transaction Partenaire
     */
    public function getTransactionPartenaire($param)
    {
        $this->table = "sva_transaction t";
        $this->champs = ["t.rowid","t.num_transaction","t.date_transaction","t.montant","t.commission","s.label as service","p.raison_sociale as partenaire","t.commentaire","t.statut"];
        $this->jointure = ["
                        INNER JOIN sva_service_sunusva as s ON t.fk_service = s.rowid
                        INNER JOIN sva_partenaire as p ON t.fk_partenaire = p.rowid
        "];
        $this->__addParam($param);
        return $this->__select();
    }

    /**************************************************************** FIN TRANSACTIONS PAR PARTENAIRE  ***************************************************/



    /**************************************************************** DEBUT TRANSACTIONS PAR SERVICE  ***************************************************/

    /**
     * Lister Transaction par Service
     */
    public function getAllTransactionService($param)
    {
        $this->table = "sva_transaction t";
        $this->champs = ["t.rowid","t.num_transaction","t.date_transaction","t.montant","t.commission","p.raison_sociale as partenaire","t.commentaire as _commentaire_","t.statut as _statut_"];
        $this->jointure = ["
                        INNER JOIN sva_partenaire as p ON t.fk_partenaire = p.rowid
        "];
        $this->condition=["t.statut="=>1, "t.fk_service="=>$param[0], "DATE(t.date_transaction) >="=>$param[1], "DATE(t.date_transaction) <="=>$param[2]];
        return $this->__processing();
    }

    /**
     * Get Transaction par Service
     */
    public function getService($param = null)
    {
        $this->table = "sva_transaction";
        $this->__addParam($param);
        return $this->__select();
    }

    /**
     * Get un Service
     */
    public function getUnService($param = null)
    {
        $this->table = "sva_service_sunusva";
        $this->__addParam($param);
        return $this->__select();
    }

    /**
     * Détail Transaction par Service
     */
    public function getOneService($param = null)
    {
        $this->table = "sva_transaction t";
        $this->champs = ["t.rowid","t.num_transaction","t.date_transaction","t.montant","t.commission","p.raison_sociale as partenaire","t.commentaire","t.statut"];
        $this->jointure = ["
                        INNER JOIN sva_partenaire as p ON t.fk_partenaire = p.rowid
        "];
        $this->condition = ["t.rowid >="=>$param];
        $this->__addParam($param);
        return $this->__detail();
    }

    /**
     * Impression Transaction pour un Service donné
     */
    public function getTransactionService($param)
    {
        $this->table = "sva_transaction t";
        $this->champs = ["t.rowid","t.num_transaction","t.date_transaction","t.montant","t.commission","p.raison_sociale as partenaire","t.commentaire","t.statut"];
        $this->jointure = ["
                        INNER JOIN sva_partenaire as p ON t.fk_partenaire = p.rowid
        "];
        $this->__addParam($param);
        return $this->__select();
    }

    /**************************************************************** FIN TRANSACTIONS PAR SERVICE  ***************************************************/



    /**************************************************************** DEBUT COMMISSIONS PAR PARTENAIRE  ***************************************************/

    public function getComParPart($datedeb,$datefin,$fk_partenaire)
    {
        $this->table = "sva_transaction as t";
        $this->champs = ["sum(t.commission) as com_total", "fk_service", "s.label", "t.date_transaction"];
        $this->jointure = [" 
        INNER JOIN sva_service_sunusva as s ON t.fk_service = s.rowid
        "];
        $this->condition = ["t.date_transaction >="=>$datedeb,"t.date_transaction <="=>$datefin];
        $this->group = [$fk_partenaire];
        return $this->__select();
    }

    /**************************************************************** FIN COMMISSIONS PAR PARTENAIRE  ***************************************************/


}
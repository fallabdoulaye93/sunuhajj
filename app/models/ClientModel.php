<?php
/**
 * Created by PhpStorm.
 * User: Seyni FAYE
 * Date: 27/02/2017
 * Time: 16:03
 */

namespace app\models;

use app\core\BaseModel;

class ClientModel extends BaseModel
{
    private $gie;

    /**
     * HomeModel constructor.
     */
    public function __construct()
    {

        parent::__construct();
        $this->gie = $this->_USER->gie ;
    }

    /**
     * HomeModel destruct.
     */
    public function __destruct()
    {
        parent::__destruct();
    }

    /**
     * @param $param
     * @return bool|mixed
     */

    /**
     * Ajout Chauffeur
     */
    public function insertChauffeur($param)
    {
        $this->table = "client";
        $this->__addParam($param);
        return $this->__insert();
    }

    public function insertClient($param){
        $this->table = "client";
        $this->__addParam($param);
        return $this->__insert();
    }

    public function verifEmailModel($email)
    {
        $this->table = "client";
        $this->champs = ["id"];
        $this->condition=["email ="=>$email];
        $count = count($this->__select());
        if($count > 0) return 1;
        else return -1;
    }

    /**
     * Processing Chauffeur
     */
    public function getAllClient($param = null)
    {
        $this->table = "client c";
        $this->champs = ["c.id","c.prenom","c.nom","c.email","c.telephone","ca.numero_serie", "ca.solde","c.etat"];
        $this->jointure = ["INNER JOIN carte ca on ca.client = c.id"];
        $this->condition = ["c.gie = "=>$this->gie];


        return $this->__processing();
    }

    public function getAllRechargementClient($param = null)
    {
      // var_dump($param[0]) ;

        $this->table = "histo_rechargement r";
        $this->champs = ["r.id","r.date_transac","r.num_transac","r.montant","r.solde_avant","r.solde_apres", 'concat(u.nom," ",u.prenom) as receveur'];
        $this->jointure = ["LEFT JOIN utilisateur u on u.id = r.user_id"];
       $this->condition = ["r.carte_id = "=> $param[0]];


        return $this->__processing();
    }

    public function Generer_numtransaction()
    {
        $found = 0;
        do {
            $code = rand(1, 9) . rand(0, 9) . rand(0, 9) . rand(0, 9) . rand(0, 9) . rand(0, 9) . rand(0, 9) . rand(0, 9) . rand(0, 9) . rand(0, 9) . rand(0, 9) . rand(0, 9) . rand(0, 9) . rand(0, 9) . rand(1, 9);
            $etat =  $this->verifyTransaction($code);
            if ($etat == 1) {
                $found = 1;
            }
        } while ($found == 0);
        return $code;
    }

    public function verifyTransaction($code)
    {

        $this->table = "histo_rechargement";
        $this->champs =['id'];
        $this->condition=["num_transac  ="=>$code, "etat ="=>1];
        $a = count($this->__select());
        if ($a > 0) {
            return 0;
        } else {
            return 1;
        }
    }



}
<?php
/**
 * Created by PhpStorm.
 * User: Seyni FAYE
 * Date: 27/02/2017
 * Time: 16:03
 */

namespace app\models\admin;

use app\core\BaseModel;

class AdminModel extends BaseModel
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

    public function getUtilisateur($param = null)
    {
        $this->table = "utilisateur";
        $this->__addParam($param);
        return $this->__select();
    }
    public function getOneUtilisateur($param = null)
    {
        $this->table = "utilisateur";
        $this->__addParam($param);
        return $this->__detail();
    }

  
    public function nbreGie()
    {
        $this->table = "gie g";
        $this->champs = ["COUNT(g.id) AS nbre"];
        //$this->condition =["g.numGIE = " => $this->_USER->gie];
        //$this->group = ["b.numGIE"];

        return $this->__detail()->nbre;

    }

    public function nbreBus()
    {
        $this->table = "bus b";
        $this->champs = ["COUNT(b.id) AS nbre"];
        //$this->condition =["b.numGIE = " => $this->_USER->gie];
        //$this->group = ["b.numGIE"];

        return $this->__detail()->nbre;

    }
}
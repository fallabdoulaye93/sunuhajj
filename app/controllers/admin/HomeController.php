<?php

/**
 * Created by PhpStorm.
 * User: Seyni FAYE
 * Date: 15/02/2017
 * Time: 21:11
 */

namespace app\controllers\admin;

use app\core\BaseController;
use app\core\Session;
use app\core\Utils;

class HomeController extends BaseController
{
    private $homeModels;

    public function __construct()
    {
        parent::__construct(false);
        $this->homeModels = $this->model("admin");
    }


    public function index__()
    {
        $this->views->getPage('home/acceuil');
    }

    public function login__()
    {




        $param =["condition" =>["login = "=>$this->paramPOST["login"], "password = "=>sha1($this->paramPOST["password"]),"admin ="=>1, "gie = "=>0, "etat = "=>1, "type = "=>1]];
        $result = $this->homeModels->getOneUtilisateur($param);
        if($result !== false)
        {
            Session::set_User_Connecter([$result]);
            if($result->connect == 1) {
                Utils::redirect("menu", "menu");
            }
            else{
                Utils::redirect("menu", "firstConnect");
            }
        }
        else
        {
            Utils::setMessageALert(["danger",$this->lang["LoginouMotdepasseincorrect"]]);
            Utils::redirect("admin", "index");
        }
    }
}
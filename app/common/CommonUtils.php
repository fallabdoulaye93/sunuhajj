<?php
/**
 * Created by PhpStorm.
 * User: Seyni FAYE
 * Date: 31/01/2018
 * Time: 12:52
 */

namespace app\common;

use app\core\Utils;

trait CommonUtils
{
    public static function getUserAffecte($uuid){

        $param = [
            "table"=>"utilisateur u",
            "champs"=>["u.nom", "u.prenom"],
            "jointure" => ["INNER JOIN devices d on d.uuid = u.uuid"],

            "condition"=>["u.uuid = " => $uuid]
        ];

        $result = self::getModel("gestion")->get($param);
        if ($result)
            return $result[0]->prenom.' '.$result[0]->nom ;
        else return "<i class='text-info'>available</i>";
        //var_dump($result);


    }
    public static function getMontant($montant){
        return '<div style="text-align: center ">'.Utils::getFormatMoney($montant).'</div>' ;
    }

    public static function getMontantSimple($montant){
        return '<div style="text-align: center ">'.$montant.'</div>' ;
    }

    public static function getUserAjout($id){

        $param = [
            "table"=>"utilisateur u",
            "champs"=>["u.nom", "u.prenom"],
            "condition"=>["u.id = " => $id]
        ];

        $result = self::getModel("gestion")->get($param);
        if ($result)
            return $result[0]->prenom.' '.$result[0]->nom ;
        else return "<i class='text-info'>available</i>";
        //var_dump($result);


    }


    public static function paiementPar($fk_carte){
        return ($fk_carte == 1) ? "<i class='text-primary'>Card</i>"  : "<i class='text-info'>Cash</i>";
    }

    /**
     * Ici vous devez créer uniquement des méthodes avec le mot clé << static >>
     * Vous pouvez acceder à votre méthode partout dans le projet en faisant
     * Utils::votre_nom_de_methode();
     */

    static function villes()
    {

        $token = Utils::auth2('311f9e8368f470edb94b');
        $obj = json_decode($token);
        $token1 = $obj->{'token'};
        $ch = curl_init();
        $headers = array(
            "Authorization-Token:".$token1,
            "Api-key:d47aa6470be64485f78f6ff27e633b59d62fcf73087cbeb8f74fbd7aad42f79d2969fa20161045cf705ee3ec44ee8b3860d3b18a36c53165646eaf95d51c4ab7"
        );
        curl_setopt($ch, CURLOPT_URL, "https://www.api-sn.aprilapps.com/api/villes/");
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_VERBOSE, 1);
        //curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($ch);
        $error_msg = curl_error($ch);
        return $result;
        //return json_decode($result);
    }

    static function auth2($identifier,$key,$url)
    {

        $ch = curl_init();
        $data = array(
            'identifier' => $identifier
        );
        $headers = array(
            "Api-key:".$key
        );
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_VERBOSE, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($ch);
        $error_msg = curl_error($ch);
        return $result;
    }
    static function Method_POST($data,$url,$key,$token)
    {
        $ch = curl_init();
        $headers = array(
            "Authorization-Token:".$token,
            "Api-key:".$key
        );
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_VERBOSE, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($ch);
        $error_msg = curl_error($ch);
        // return json_decode($result);
        return $result;
    }
    static function Method_GET($url,$key,$token)
    {
        $ch = curl_init();
        $headers = array(
            "Authorization-Token:".$token,
            "Api-key:".$key
        );
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_VERBOSE, 1);
        curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($ch);
        $error_msg = curl_error($ch);
        return $result;
    }

}
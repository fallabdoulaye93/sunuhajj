<?php
/**
 * Created by PhpStorm.
 * User: Seyni FAYE
 * Date: 17/08/2017
 * Time: 11:01
 */

namespace app\core;

use Spipu\Html2Pdf\Exception\Html2PdfException;
use Spipu\Html2Pdf\Html2Pdf;
use ReCaptcha\Captcha;
class BaseViews
{
    private $lang     = null;
    private $url      = null;
    private $data     = null;
    private $_USER    = null;
    private $token    = null;
    private $captcha  = null;
    private $_message = [];
    private $header   = 'header';
    private $sidebar  = 'sidebar';
    private $footer   = 'footer';

    /**
     * BaseViews constructor.
     * @param string $lang
     * @param array $url
     * @param array $template
     */
    public function __construct($lang, $url, $template)
    {
        $this->token = Session::getAttribut('token');
        $this->_USER = (Session::existeAttribut(SESSIONNAME)) ? Session::getAttributArray(SESSIONNAME)[0] : null;
        $this->lang  = $lang;
        $this->url   = $url;
        $this->initTemplate($template);
//        $this->captcha = new Captcha();
//        $this->captcha->setPublicKey('6LcCpmIUAAAAAOHqTSo_ljMJoqrMxdlii-vrYf_U');
//        $this->captcha->setPrivateKey('6LcCpmIUAAAAAEDIW9015kLvJM3To7VeQ8EhGNYp');
//
//        $this->captcha = $this->captcha->displayHTML();
    }

    /**
     * @param null $data
     */
    public function setData($data)
    {
        if(!is_array($this->data)) $this->data = (is_null($this->data)) ? [] : [$this->data];
        $this->data = (!is_array($data)) ? array_merge($this->data,[$data]) : array_merge($this->data,$data);
    }

    /**
     * @return null
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @param $param
     */
    public function initTemplate($param)
    {
        extract($param);
        $this->header  =
            (isset($header) && file_exists(ROOT . Prefix_View . 'template/'.$header.'.php'))
                ? $header : "header";
        $this->sidebar =
            (isset($sidebar) && file_exists(ROOT . Prefix_View . 'template/'.$sidebar.'.php'))
                ? $sidebar : "sidebar";
        $this->footer  =
            (isset($footer) && file_exists(ROOT . Prefix_View . 'template/'.$footer.'.php'))
            ? $footer : "footer";
    }

    /**
     * Construit la vue.
     * @param null $page
     */
    public function getTemplate($page = null)
    {
        if(is_null($page)) $page = strtolower(implode("/", $this->url));

        $token = $this->token;
        $captcha = $this->captcha;

        if(count($this->data) > 0) extract($this->data);
        $this->initMessage();

        if(!is_null($this->header) && file_exists(ROOT . Prefix_View . 'template/'.$this->header.'.php'))
            require_once (ROOT . Prefix_View . 'template/'.$this->header.'.php');

        require_once (ROOT . 'app/core/message.php');

        if(!is_null($this->sidebar) && file_exists(ROOT . Prefix_View . 'template/'.$this->sidebar.'.php'))
            require_once (ROOT . Prefix_View . 'template/'.$this->sidebar.'.php');

        if(file_exists(ROOT . Prefix_View . $page.'.php')) require_once (ROOT . Prefix_View . $page.'.php');

        if(!is_null($this->footer) && file_exists(ROOT . Prefix_View . 'template/'.$this->footer.'.php'))
            require_once (ROOT . Prefix_View . 'template/'.$this->footer.'.php');
    }

    /**
     * Construit la vue.
     * @param null $page
     */
    public function getModal($page = null)
    {
        if(is_null($page)) $page = strtolower(implode("/", $this->url));

        $token = $this->token;
        $captcha = $this->captcha;

        if(count($this->data) > 0) extract($this->data);
        $this->initMessage();
        require_once (ROOT . Prefix_View . 'template/header.php');
        require_once (ROOT . Prefix_View . $page.'.php');
        require_once (ROOT . Prefix_View . 'template/footer.php');
    }

    /**
     * @param null $page
     */
    public function getPage($page = null)
    {
       //echo ROOT . Prefix_View . $page.'.php' ; exit;
        //echo ROOT . Prefix_View . $page .'.php' ; exit;
        $token = $this->token;
        $captcha = $this->captcha;

        if(count($this->data) > 0) extract($this->data);
        $this->initMessage();
        if($page == null || !file_exists(ROOT . Prefix_View . $page.'.php')) require_once (ROOT . 'app/core/error.php');
        else require_once (ROOT . Prefix_View . $page .'.php');
    }

    /**
     * @param $page
     * @param null $namePDF
     * @param string $output
     * @return bool|string
     */
    public function exportToPdf($page, $namePDF = null, $output = 'I')
    {
        if(count($this->data) > 0) extract($this->data);

        if(file_exists(ROOT . Prefix_View . $page . '.php')){
            ob_start();
            include(ROOT . Prefix_View . $page . '.php');
            $content = ob_get_clean();
        }else  $content = $page;

        $namePDF = ($namePDF === null) ? (explode("/",$page)[1]) : $namePDF;

        try {
            $html2pdf = new Html2Pdf('P', 'A4', 'fr', true, 'UTF-8', 0);
            $html2pdf->setDefaultFont('Times');
            $html2pdf->writeHTML($content);
            return $html2pdf->Output($namePDF.'.pdf',$output);
        }
        catch(Html2PdfException $e)
        {
            Utils::setMessageError([$e->getMessage()]);
            Utils::redirect("error","error", [], "default");
            return false;
        }
    }

    /**
     * @param $page
     * @param null $namePDF
     */
    public function exportToExcel($page, $namePDF = null)
    {
        $namePDF = ($namePDF === null) ? gmdate("YmdHis") : $namePDF;
        header("Content-type: application/vnd.ms-excel");
        header("Content-Disposition: attachment; filename=$namePDF.xls");
        if(file_exists(ROOT . 'app/views/'  . $page . '.php')){
            ob_start();
            include(ROOT . 'app/views/'  . $page . '.php');
            $content = ob_get_clean();
        }else $content = $page;
        print $content;
        exit();
    }

    /**
     * initialise les messages d'alert et d'erreur
     */
    private function initMessage()
    {
        $this->_message['MSG_ERROR'] = Utils::getMessageError();
        $this->_message['MSG_ALERT'] = Utils::getMessageALert();
    }
}
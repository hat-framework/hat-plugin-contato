<?php

 use classes\Controller\CController;
class assuntoController extends CController{
    
    public $model_name = "contato/assunto";
    
    public function index($display = true, $link = ""){
        if(!isset ($_POST['ajax'])){
            $assunto = array_shift($this->vars);
            $it   = $this->model->selecionar(array('anome', 'cod_assunto'), "cod_assunto = '$assunto'", 1, null);
            $it   = array_shift($it);
            if($assunto == "" || $assunto != @$it['cod_assunto']) {
                $it   = $this->model->selecionar(array('anome', 'cod_assunto'), '', 1, null);
                if(!empty ($it)){
                    $url  = (CURRENT_MODULE . "/" . CURRENT_CONTROLLER."/formulario/");
                    $it   = array_shift($it);
                    $link = $url . $it['cod_assunto'] . "/" . GetPlainName($it['anome']);
                    $assunto = $it['cod_assunto'];
                    //Redirect($link);
                }
            }
            $title = isset($it['anome'])?$it['anome']:"Contato ". SITE_NOME;
            $this->genTags($title);
            $this->registerVar("titulo", $title);
            //$_POST['form'] = $assunto;
            //$this->ajax();
            $this->registerVar('dados' , $this->model->getform($assunto));
            $this->genTags($title, "Envie um email para ". SITE_NOME, 'fale com ' . SITE_NOME);
        }else $this->enviaMensagem();
        $this->display(LINK."/formulario");
    }
    
    public function listar(){
        parent::index();
    }

    public function enviaMensagem(){
        $this->LoadModel("contato/mensagem", 'msg');
        $assunto = isset($_POST['cod_assunto'])?$_POST['cod_assunto']:"";
        $this->registerVar("status", $this->msg->send($assunto, $_POST));
        $this->setVars($this->msg->getMessages());
    }
    
    public function ajax(){
        $cod_assunto = $_POST['form'];
        $var = $this->model->getForm($cod_assunto);
        unset($var['cod_mensagem']);
        unset($var['cod_assunto']);
        unset($var['data']);
        unset($var['email_remetente']);
        unset($var['mensagem']);
        if(empty ($var)) die();
        ob_start();
        $this->LoadResource('formulario', 'form');
        $this->form->printable();
        $this->form->omitir_cabecalho();
        $var = $this->form->NewForm($var);
        $scripts = ob_get_contents();
        ob_end_clean();
        echo "<div id='extrafield'>$var</div>";
    }
    
}
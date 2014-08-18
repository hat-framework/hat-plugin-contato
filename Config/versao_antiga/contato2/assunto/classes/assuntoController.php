<?php

namespace classes\Controller;
class assuntoController extends \classes\Controller\Controller{
    
    public function __construct($vars) {
        parent::__construct($vars);
        $this->LoadModel("contato/setores", 'model');
        $this->enviaMensagem();
    }
    
    public function index(){
        
        if(!isset ($_POST['ajax'])){
            $assunto     = array_shift($this->vars);
            if($assunto == "") Redirect (CURRENT_MODULE . "/" . CURRENT_CONTROLLER."/index/outros");

            $this->registerVar("titulo", $this->model->getTitle($assunto));
            $this->registerVar('dados' , $this->model->getform($assunto));
            $this->genTags("Contato ". SITE_NOME, "envie um email para ". SITE_NOME, 'fale com ' . SITE_NOME);
        }else{
            
        }
        $this->display("admin/auto/formulario");
    }
    
    private function enviaMensagem(){
        $assunto = isset($this->vars[0])?$this->vars[0]:"";
        $this->registerVar("status", $this->model->SendMessage($_POST, $assunto));
        $this->setVars($this->model->getMessages());
    }
    
}

?>

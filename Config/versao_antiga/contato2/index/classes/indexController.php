<?php
namespace classes\Controller;
class indexController extends \classes\Controller\Controller{
    
    public function __construct($vars) {
        $this->LoadModel("contato/setores", 'model');
        parent::__construct($vars);
    }
    
    public function index(){
        $this->genTags("Contato ". SITE_NOME, "envie um email para ". SITE_NOME, 'fale com ' . SITE_NOME);
        $this->display("contato/index/index");
    }
    
}

?>

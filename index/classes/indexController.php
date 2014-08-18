<?php

namespace classes\Controller;
class indexController extends \classes\Controller\Controller{
    
    public function index(){
        $this->genTags("Contato ". SITE_NOME, "envie um email para ". SITE_NOME, 'fale com ' . SITE_NOME);
        if(CONTATO_FORMULARIO_DIRETO == true) Redirect('contato/assunto/');
        $this->display("contato/index/index");
    }
    
}

?>

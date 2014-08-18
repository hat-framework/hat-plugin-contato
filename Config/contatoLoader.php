<?php

use classes\Classes\PluginLoader;
class contatoLoader extends classes\Classes\PluginLoader{
    
    public function setCommonVars(){
        
        if(!array_key_exists("ajax", $_POST)){
            //$this->setVar("menu_title", CONTATO_MENU_TITLE);
            $this->LoadModel("contato/assunto", 'model');
            $assuntos = array(CONTATO_MENU_TITLE => $this->model->getAssuntos());
            $assuntos[CONTATO_MENU_TITLE][CONTATO_MENU_TITLE] = 'contato';
            $this->setVar('menu', $assuntos);
        }
    }
    
    public function setAdminVars(){
        return array();
        
    }
    
}

?>

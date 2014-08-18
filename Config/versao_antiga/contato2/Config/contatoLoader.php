<?php

use classes\Classes\PluginLoader;
class contatoLoader extends classes\Classes\PluginLoader{
    
    public function setCommonVars(){
        if(!array_key_exists("ajax", $_POST)){
            $this->LoadModel("contato/setores", 'model');
            $this->setVar('menu', $this->model->getAssuntos());
            $this->setVar("menu_title", "Qual o seu interesse?");
        }
    }
    
    public function setAdminVars(){
        
        
    }
    
}

?>

<?php

class plugins_contato_Config_contatoConfig extends configModel {
    
    public $name = "Definições Gerais";
    public function  __construct() {
        $this->setFilename(__FILE__, __CLASS__);
    }

}

?>
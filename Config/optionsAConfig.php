<?php

class plugins_contato_Config_optionsAConfig extends configModel {
    
    public $name = "Opções do plugin";
    public function  __construct() {
        $this->setFilename(__FILE__, __CLASS__);
    }

    public function select(){
        $var = parent::select();
        $var['CONTATO_TIPO']['name'] = 'Tipo de formulário';
        $var['CONTATO_TIPO']['type'] = 'enum';
        $var['CONTATO_TIPO']['options'] = array('simples', "completo");
        $var['CONTATO_GRAVA_MENSAGEM_NO_SITE']['name'] = 'Gravar mensagem no site?';
        $var['CONTATO_FORMULARIO_DIRETO']['name'] = 'Exibir mensagem de boas vindas antes da mensagem?';
        return $var;
    }

}

?>
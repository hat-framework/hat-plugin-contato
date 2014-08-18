<?php

class mensagemAdmin extends Admin{
    
    public $model_name = "contato/mensagem";
    public function __construct($vars) {
        parent::__construct($vars);
        unset($this->variaveis['actions'][$this->model_name."/inserir"] );
    }
    
    public function inserir(){
        $this->index();
    }
    
}

?>

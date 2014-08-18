<?php

class indexAdmin extends Admin{
    
    public $model_name = "galeria/album";
    public function __construct($vars) {
        $this->LoadModel($this->model_name, "model");
        parent::__construct($vars);
    }
    
    public function index(){
        $this->display("galeria/index/admin");
    }
    
}

?>

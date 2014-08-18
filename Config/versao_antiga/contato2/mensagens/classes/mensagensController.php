<?php
namespace classes\Controller;
class mensagensController extends \classes\Controller\Controller{
    
    public $model_name = "contato/mensagens";
    public function __construct($vars) {
        $this->LoadModel("usuario/login", 'uobj');
        $this->LoadModel("contato/mensagens", 'model');
        $this->uobj->needLogin('contato/mensagens');
        parent::__construct($vars);
    }
    
    public function index(){
        $this->registerVar('mensagens', $this->model->selecionar());
        $this->display("contato/mensagens/index");
    }
    
}

?>

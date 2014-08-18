<?php

class contato_alertasModel extends \classes\Model\Model{
     
    protected $tabela = "contato_alertas";
    protected $pkey   = "cod";
    
    public function __construct() {
        parent::__construct();
        $this->LoadResource("html", 'Html');
    }
    private $remetente_default = array(
        'user_name'  => SITE_NOME,
        'user_cargo' => '',
        'email'      => SITE_EMAIL
    );
    public function alertar($assunto, $texto, $destinatarios, $user = array(), $blockSelfAlert = true){
        if(empty($user)){$user = $this->remetente_default;}
        $destinatarios = $this->filterDestinatarios($user['email'], $destinatarios, $blockSelfAlert);
        if(false === $this->valida($texto, $destinatarios)) {return false;}
        
        $this->assunto           = $assunto; 
        $this->texto             = $texto;
        $this->destinatarios     = $destinatarios;
        $this->nome_remetente    = $user['user_name'].($user['user_cargo'] != "")?"(".$user['user_cargo'].")":"";
        $this->email_remetente   = $user['email'];
        return $this->escolhe_alertas();        
    }
    
    private function escolhe_alertas(){
        $bool = true;
        $tipo = $this->LoadTiposAlerta();
        foreach($tipo as $a){
            $b = $this->envia_alerta($a);
            $bool = $bool & $b;
        }
        return $bool;
    }
    
    private function envia_alerta($a){
        if(!isset($this->$a)){
            $model = "contato/alertas/alert/$a";
            $this->LoadModel($model, $a, false);
        }
        $bool = true;
        if(is_object($this->$a)) {
            $bool = $this->$a->setAssunto($this->assunto)
                    ->setRemetente($this->nome_remetente, $this->email_remetente)
                    ->setDestinatarios($this->destinatarios)
                    ->alertar($this->texto);
            $this->setMessages($this->$a->getMessages());
        }
        return $bool;
    }
    
    /**
     * Nesta função será possível carregar tipos diferentes de alertas 
     * de acordo com as configurações do usuário. Atualmente só existe o
     * tipo email, logo só este tipo será usado.
     */
    private $tipos = array('email' => "email");
    private function LoadTiposAlerta(){
        return $this->tipos;
    }
    
    public function addAlerta($tipo){
        $this->tipos[$tipo] = $tipo;
        return $this;
    }
    
    private function valida($texto, $destinatarios){
        if(empty($destinatarios)){
            $this->setAlertMessage('Nenhum Destinatário selecionado');
            return false;
        }
        
        if(trim($texto) === ""){
            $this->setAlertMessage("O texto de notificação não pode ser vazio");
            return false;
        }
        
        return true;
    }
    
    private function filterDestinatarios($email_remetente, $destinatarios, $blockSelfAlert){
        if(empty($destinatarios)) return array();
        if(!is_array($destinatarios)){$destinatarios = array($destinatarios);}
        $out = array();
        foreach($destinatarios as $dest){
            if($email_remetente === $dest && $blockSelfAlert) continue;
            $out[$dest] = $dest;
        }
        //print_r($out);
        return $out;
    }
    
    private function salvarAlerta(){
        $arr['assunto']         = $this->assunto;
        $arr['texto']           = $this->texto;
        $arr['destinatarios']   = implode(", ", $this->destinatarios);
        $arr['nome_remetente']  = $this->nome_remetente;
        $arr['email_remetente'] = $this->email_remetente;
        $arr['autor']           = \usuario_loginModel::CodUsuario();
        $this->inserir($arr);
    }
}
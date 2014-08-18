<?php

class contato_smsModel extends classes\Classes\Object implements alerta_interface{
    
    private $destinararios = array();
    public function alertar($mensagem){
        if(!$this->valida($mensagem)){return false;}
        $this->LoadResource('sms', 'sms')->setService('ring3');
        foreach ($this->destinararios as $numTelefone){
            if(trim($numTelefone) === ""){continue;}
            $numTelefone = str_replace(array("(", ")", " ", "-"), "", $numTelefone);
            if(!is_numeric($numTelefone)){continue;}
            $this->sms->sendSms($numTelefone, $mensagem);
        }
    }
    
    private $caracteres = '100';
    private function valida($mensagem){
        if(empty($this->destinararios)){
            $this->setErrorMessage("Selecione pelo menos um destinatário para enviar o sms");
            return false;
        }
        
        if(trim($mensagem) === ""){
            $this->setErrorMessage("O SMS que você está tentando enviar está sem corpo de texto!");
            return false;
        }
        
        if(strlen($mensagem) > $this->caracteres){
            $this->setErrorMessage("Atenção, o Tamanho da mensagem de SMS não pode ultrapassar $this->caracteres Caracteres");
            return false;
        }
        
        return true;
    }
    
    public function setAssunto($assunto){
        return $this;
    }
    
    public function setDestinatarios($destinatarios){
        $this->destinararios = is_array($destinatarios)?$destinatarios:array($destinatarios);
        return $this;
    }
    
    public function setRemetente($nome_remetente, $contato_remetente){
        return $this;
    }
}
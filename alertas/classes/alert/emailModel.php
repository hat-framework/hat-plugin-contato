<?php

class contato_emailModel extends classes\Classes\Object implements alerta_interface{
         
    private $destinararios     = array();
    private $assunto           = '';
    private $nome_remetente    = '';
    private $contato_remetente = 'array()';
    public function alertar($corpo){
        if(!$this->LoadResource("email", 'mail')->sendMail($this->assunto, $corpo, $this->destinararios, $this->contato_remetente, $this->nome_remetente)){
            $this->setErrorMessage($this->mail->getErrorMessage());
            return false;
        }
        return true;
    }
    
    public function setAssunto($assunto){
        $this->assunto = $assunto;
        return $this;
    }
    
    public function setDestinatarios($destinatarios){
        $this->destinararios = is_array($destinatarios)?$destinatarios:array($destinatarios);
        return $this;
    }
    
    public function setRemetente($nome_remetente, $contato_remetente){
        $this->nome_remetente    = $nome_remetente;
        $this->contato_remetente = $contato_remetente;
        return $this;
    }
}
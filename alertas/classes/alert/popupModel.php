<?php

use classes\Classes\Object;
class contato_popupModel extends classes\Classes\Object implements alerta_interface{
         
    public function alertar($assunto, $corpo, $destinatarios, $url, $email_remetente){
        $this->LoadModel('usuario/login', 'uobj');
        $cod_usuario = $this->uobj->getCodUsuario($email_remetente);
        $this->LoadModel('notificacao/notifica', 'not');
        
        foreach($destinatarios as $dest){
            $cod_destinatario = $this->uobj->getCodUsuario($dest);
            $post = array(
                'notificacao_notifica_autor'        => $cod_usuario,
                'notificacao_notifica_destinatario' => $cod_destinatario,
                'notificacao_notifica_titulo'       => $assunto,
                'notificacao_notifica_mensagem'     => $corpo,
                'notificacao_notifica_url'          => $url
            );
            if($cod_usuario == 0) unset($post['notificacao_notifica_autor']);
            if(!$this->not->inserir($post)){
                $this->setErrorMessage($this->not->getErrorMessage());
                return false;
            }
        }
        return true;
    }
}

?>
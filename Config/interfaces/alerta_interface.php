<?php

interface alerta_interface{
    public function setAssunto($assunto);
    public function setDestinatarios($destinatarios);
    public function setRemetente($nome_remetente, $contato_remetente);
    public function alertar($message);
}
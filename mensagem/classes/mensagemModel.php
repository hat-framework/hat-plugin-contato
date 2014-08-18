<?php

class contato_mensagemModel extends \classes\Model\Model{
    protected $tabela = "contato_mensagem";
    protected $pkey   = "cod_mensagem";
    protected $dados = array(
        
        'cod_mensagem' => array(
            'name'    => "Código",
            'pkey'    => true,
            'ai'      => true,
            'type'    => 'int',
            'size'    => '11',
            'grid'    => true,
            'notnull' => true
         ),

        'cod_assunto' => array(
            'name'    => "Assunto",
            'type'    => 'int',
            'notnull' => true,
            'grid'    => true,
            'select_type'   => 'simple',
            'select_order'  => 'ordem',
            //'especial'=> 'hide',
            'fkey'    => array(
                'model'         => 'contato/assunto',
                'cardinalidade' => '1n',
                'keys'          => array('cod_assunto', 'anome')
            ),
            'feature' => array(
                'feature_name'  => 'CONTATO_TIPO',
                'feature_value' => 'completo'
            )
         ),
        
        'assunto' => array(
            'name'    => "Assunto da Mensagem",
            'type'    => 'varchar',
            'grid'    => true,
            'notnull' => true,
            'size'    => '64',
            'feature' => array(
                'feature_name'  => 'CONTATO_TIPO',
                'feature_value' => 'simples'
            )
         ),
        
        'data' => array(
            'name'     => 'Data de envio',
            'type'     => 'timestamp',
            'especial' => 'hide',
            'grid'     => true,
            'notnull'  => true
        ),
        
        'email_remetente' => array(
            'name'     => 'Email',
            'type'     => 'varchar',
            'especial' => 'email',
            'size'     => '64',
            'grid'     => true,
            'notnull'  => true,
          //  'html'     => '<div id="extrafield">'
        ),
        /*
        'temp' => array(
            'especial' => 'hide',
            'html'     => '</div>'
        ),*/
        
        'mensagem' => array(
            'name'     => 'Mensagem',
            'type'     => 'text',
            'notnull'  => true,
        ),
        
        'cod_mensagem_pai' => array(
            'name'     => 'Mensagem original',
            'type'     => 'int',
            'default'  => 'NULL',
            'especial' => 'hide',
            'fkey'    => array(
                'model'         => 'contato/mensagem',
                'cardinalidade' => '1n',
                'keys'          => array('cod_mensagem', 'assunto')
            ),
            'feature' => array(
                'feature_name'  => 'CONTATO_MENSAGEM_CONVERSA',
                'feature_value' => true
            )
        ),
        'cod_autor' => array(
            'name'     => 'Autor da Mensagem',
            'type'     => 'int',
            'notnull'  => true,
            'fkey'    => array(
                'model'         => 'usuario/login',
                'cardinalidade' => '1n',
                'keys'          => array('cod_usuario', 'email')
            ),
            'feature' => array(
                'feature_name'  => 'CONTATO_MENSAGEM_CONVERSA',
                'feature_value' => true
            ),
            'especial' => 'autentication',
            'autentication' => array(
                'needlogin' => false
             )
        )
        
    );
    
    public function SendMessage($assunto, $corpo, $email_remetente, $destinatarios = "", $nomeRemetente = ""){

        $this->LoadResource("html", 'html');
        $link = $this->html->getLink('contato/mensagens/');
        $corpo .= "<hr> <p>Para visualizar sua mensagem no site <a href='$link'>clique aqui</a></p>";
        
        $this->LoadResource("email", 'mail');
        try{
            /*if(!$this->mail->sendMail($assunto, $corpo, $email_remetente, $destinatarios, $nomeRemetente)){
                $this->setErrorMessage($this->mail->getErrorMessage());
                return false;
            }*/
            return true;
        }catch (Exception $e){
            $this->setErrorMessage($e->getMessage());
            return false;
        }
        
        
    }

    public function Send($cod_assunto, $dados){
        
        if(empty ($dados)) return true;

        //associa os dados
        $bool = $bool2 = true;
        $this->post = $dados;
        
        $this->associa();
        
        //recupera os dados
        $out      = $this->processaDados($dados, $cod_assunto);
        $out      = array_merge_recursive($this->post, $out);
        $mensagem = $this->geraMensagem($out);
        $dados['mensagem'] = $mensagem;
        //carrega o assunto
        $this->LoadModel("contato/assunto", 'aobj');
        $assunto = $this->aobj->getSimpleItem($cod_assunto, array('anome'));
        if($assunto != NULL || !empty ($assunto))$assunto = array_shift($assunto);
        else $assunto = "Outros";
        
        $bool2 = true;
        $bool  = $this->SendMessage($assunto, $mensagem, $this->post['email_remetente']);
        if(CONTATO_GRAVA_MENSAGEM_NO_SITE) $bool2 = $this->inserir($dados);
        if ($bool == $bool2 && $bool === true){
            $this->setSuccessMessage("Mensagem Enviada Corretamente!");
            return true;
        }
        return false;
    }
    
    private function geraMensagem($out){
        
        if(isset($out['assunto']))     unset($out['assunto']);
        if(isset($out['cod_assunto'])) unset($out['cod_assunto']);
        if(isset($out[$this->pkey]))   unset($out[$this->pkey]);
        $fmsg = $out['mensagem'];
        unset($out['mensagem']);
        $out['mensagem'] = $fmsg;
        $msg = "";
        foreach($out as $name => $var){
            if(array_key_exists($name, $this->dados)) $msg .= $this->dados[$name]['name'];
            else $msg .= "$name";
            $msg .= " : $var <br/>";
        }
        return $msg;
    }
    
    private function processaDados($dados, $cod_assunto){
        foreach($this->post as $name => $arr){
            if(array_key_exists($name, $dados))unset($dados[$name]);
        }
        if(isset($dados['enviar']))   unset($dados['enviar']);
        if(isset($dados['antispam'])) unset($dados['antispam']);
        if(isset($dados['ajax']))     unset($dados['ajax']);
        
        $this->LoadModel('contato/campo', 'campo');
        $consulta = $this->campo->listSimpleItem($cod_assunto, array(), 'cod_assunto');
        $out = array();
        foreach($consulta as $cons){
            if(array_key_exists($cons['cod_campo'], $dados)){
                $out[$cons['label']] = $dados[$cons['cod_campo']];
            }
        }
        
        return $out;
    }

    

}

?>

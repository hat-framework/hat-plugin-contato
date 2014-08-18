<?php

class mensagensModel extends \classes\Model\Model{
    protected $tabela = "contato_mensagem";
    protected $pkey   = "cod_mensagem";
    protected $dados = array(
        
        'cod_mensagem' => array(
            'name'    => "Código da Mensagem",
            'pkey'    => true,
            'ai'      => true,
            'type'    => 'int',
            'size'    => '11',
            'grid'    => true,
            'notnull' => true
         ),

        'cod_remetente' => array(
            'name'    => "Remetente",
            'type'    => 'int',
            'especial'=> 'hide',
            'fkey'    => array(
                'model'         => 'usuario/login',
                'cardinalidade' => '1n',
                'keys'          => array('cod_usuario', 'email')
            )
         ),

        'cod_destinatario' => array(
            'name'    => "Destinatário",
            'type'    => 'int',
            'notnull' => true,
            'especial'=> 'hide',
            'fkey'    => array(
                'model'         => 'usuario/login',
                'cardinalidade' => '1n',
                'keys'          => array('cod_usuario', 'email')
            )
         ),

        'assunto' => array(
            'name'      => 'Assunto',
            'type' 	=> 'varchar',
            'grid'      => true,
            'size'      => '128',
            'notnull'   => true
         ),

        'email_remetente' => array(
            'name'     => 'Email',
            'type'     => 'varchar',
            'especial' => 'email',
            'size'     => '64',
            'grid'     => true,
            'notnull'  => true
        ),
        
        'telefone' => array(
            'name'     => 'Telefone' ,
            'type'     => 'varchar',
            'especial' => 'telefone',
            'size'     => '13',
            'notnull'  => true
         ),
        
        'mensagem' => array(
            'name'     => 'Mensagem',
            'type'     => 'text',
            'notnull'  => true
        ),

        'data' => array(
            'name'     => 'Data de envio',
            'type'     => 'timestamp',
            'especial' => 'hide',
            'grid'     => true,
            'notnull'  => true
        )
    );

    public function inserir($dados){

        //se já enviou notificacao de mensagem hoje e usuário não respondeu
        if(!isset($dados['cod_destinatario'])){
            $this->LoadModel("usuario/login", 'uobj');
            $where = "`permissao` = 'Admin'";
            $cod = $this->uobj->selecionar(array('cod_usuario'), $where, "1", $offset = "", $orderby = "cod_usuario DESC");
            if(empty ($cod)) $cod['cod_usuario'] = 1;
            else $cod = array_shift($cod);
            
            $dados['cod_destinatario'] = $cod['cod_usuario'];
        }

        $this->SendMessage($dados['assunto'], $dados['mensagem'], $dados['email_remetente']);
        $dados['email_remetente'] = (!isset($dados['email_remetente']) ||$dados['email_remetente'] == "")?
                                    "sistema@hatstore.com": $dados['email_remetente'];

        return parent::inserir($dados);
    }

    public function SendMessage($assunto, $corpo, $email_remetente, $destinatarios = "", $nomeRemetente = ""){

        $this->LoadResource("html", 'html');
        $link = $this->html->getLink('contato/mensagens/');

        $this->LoadResource("email", 'mail');
        $corpo .= "<hr> <p>Para visualizar sua mensagem no site <a href='$link'>clique aqui</a></p>";
        if(!$this->mail->sendMail($assunto, $corpo, $destinatarios, $email_remetente, $nomeRemetente)){
            $this->setErrorMessage($this->mail->getErrorMessage());
            return false;
        }
        return true;
    }
    
}
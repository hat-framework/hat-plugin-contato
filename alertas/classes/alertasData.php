<?php

class contato_alertasData extends \classes\Model\DataModel{
    
    protected $dados = array(
        'cod' => array(
            'name'    => "Código",
            'pkey'    => true,
            'ai'      => true,
            'type'    => 'int',
            'display' => true,
            'size'    => '11',
            'grid'    => true,
            'private' => true,
            'notnull' => true
         ),

        'nome_remetente' => array(
            'name'      => 'Nome',
            'type'      => 'varchar',
            'size'      => '128',
            'notnull'   => true,
            'confirm'   => true,
            'private'   => true,
         ),
        
        'email_remetente' => array(
            'name'     => 'Email',
            'type'     => 'varchar',
            'display'  => true,
            'size'     => '128',
            'search'   => true,
            'notnull'  => true,
            'grid'     => true,
            'especial' => 'email',
         ),
        
        'enviadoem' => array(
	    'name'     => 'Enviado Em',
	    'type'     => 'timestamp',
	    'notnull' => true,
            'default' => "CURRENT_TIMESTAMP",
            'especial' => 'hide'
        ),
        
        'destinatarios' => array(
            'name'     => 'Destinatários',
            'type'     => 'text',
            'display'  => true,
            'search'   => true,
            'notnull'  => true,
            'grid'     => true,
         ),
        
        'assunto' => array(
            'name'     => 'Assunto',
            'type'     => 'varchar',
            'display'  => true,
            'title'    => true,
            'size'     => '128',
            'notnull'  => true,
            'search'   => true,
            'grid'     => true,
         ),
        
        'texto' => array(
            'name'        => 'Texto',
            'type'        => 'text',
            'display'     => true,
            'search'      => true,
         ),
 
        'autor' => array(
	    'name'     => 'Autor',
	    'type'     => 'int',
	    'size'     => '11',
	    'grid'    => true,
	    'display' => true,
            'especial' => 'autentication',
            'autentication' => array(
                'needlogin' => true
            ),
	    'fkey' => array(
	        //'model' => 'usuario/login',
                'model' => 'usuario/login',
	        'cardinalidade' => '1n',
	        'keys' => array('cod_usuario', 'user_name'),
                'onupdate' => 'cascade',
                'ondelete' => 'restrict'
	    ),
         ),
        
        'button' => array(
            'button' => "Enviar"
         )
    );
    
}

?>
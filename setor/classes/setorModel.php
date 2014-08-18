<?php

class contato_setorModel extends \classes\Model\Model{
    protected $tabela = "contato_setor";
    protected $pkey   = "cod_setor";
    protected $dados = array(
        
        'cod_setor' => array(
            'name'    => "Setor",
            'pkey'    => true,
            'ai'      => true,
            'type'    => 'int',
            'size'    => '11',
            'grid'    => true,
            'display' => true,
            'private' => true,
            'notnull' => true
         ),

        'nome_setor' => array(
            'name'    => "Nome do Setor",
            'type'    => 'varchar',
            'size'    => '64',
            'grid'    => true,
            'notnull' => true,
            'display' => true,
            'unique'  => array('model' => 'contato/setor'),
         ),

        'email' => array(
            'name'    => "Email",
            'type'    => 'varchar',
            'size'    => '64',
            'grid'    => true,
            'notnull' => true,
            'display' => true,
            'especial'=> 'email'
         ),
        '__assuntos' => array(
            'name'    => 'Assuntos',
            'private' => true,
            'fkey'    => array(
                'model' 	=> 'contato/assunto',
                'keys'          => array('cod_assunto', 'anome'),
                'cardinalidade' => 'n1'//nn 1n 11
            )
         ),
    );
}

?>

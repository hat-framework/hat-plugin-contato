<?php

class assuntoModel extends \classes\Model\Model{
    protected $tabela = "contato_assunto";
    protected $pkey   = "nome";
    protected $dados = array(

        'nome' => array(
            'name'    => "Assunto",
            'type'    => 'varchar',
            'pkey'    => true,
            'grid'    => true,
            'size'    => '64',
            'notnull' => true,
            'unique'  => array('model' => 'contato/assunto'),
         ),

        'cod_setor' => array(
            'name'    => "Setor",
            'type'    => 'varchar',
            'grid'    => true,
            'notnull' => true,
            'fkey'      => array(
                'model' 	=> 'contato/setores',
                'cardinalidade' => '1n',//nn 1n 11
                'keys'          => array("cod_setor", "nome_setor")//nn 1n 11
            )
         )
    );
    
}

?>

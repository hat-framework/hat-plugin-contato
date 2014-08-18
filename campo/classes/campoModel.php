<?php

class contato_campoModel extends \classes\Model\Model{
    protected $tabela = "contato_campo";
    protected $pkey   = "cod_campo";
    protected $dados = array(
        
        'cod_campo' => array(
            'name'    => "Código",
            'pkey'    => true,
            'ai'      => true,
            'type'    => 'int',
            'size'    => '11',
            'grid'    => true,
            'display' => true,
            'private' => true,
            'notnull' => true
         ),
        
        'label' => array(
            'name'     => 'Nome',
            'type'     => 'varchar',
            'size'     => '32',
            'grid'     => true,
            'display'  => true,
            'notnull'  => true
        ),

        'cod_assunto' => array(
            'name'     => "Assunto",
            'type'     => 'int',
            'display'  => true,
            //'private'  => true,
            'especial' => 'session',
            'session'  => 'contato/assunto',
            'notnull'  => true,
            'fkey'     => array(
                'model'         => 'contato/assunto',
                'cardinalidade' => '1n',
                'keys'          => array('cod_assunto', 'anome')
            )
         ),
        
        'type' => array(
            'name'      => 'Tipos de dados',
            'type'      => 'enum',
            'default'   => 'varchar',
            'display'   => true,
            'options'   => array(
                'varchar'     => 'Texto',
                'text'        => 'Texto Longo',
                'int'         => 'Inteiro',
                'float'       => 'Real',
                'timestamp'   => 'Data',
                'enum'        => 'Lista Simples',
                'multi_enum'  => 'Lista Múltipla',
                'file'        => 'Arquivo',
                'telefone'    => 'Telefone',
                'calendar'    => 'Calendário',
                'porcentagem' => 'Porcentagem',
                'monetary'    => 'Valor em Reais',
                'cep'         => 'CEP',
                'CPF'         => 'CPF',
                'CNPJ'        => 'CNPJ',
            ),
            'notnull'   => true,
            'grid'     => true
       	 ),
        
        'size' => array(
            'name'     => 'Tamanho do dado ou opções da lista',
            'type'     => 'varchar',
            'display'  => true,
            'size'     => '128'
        ),
        
        'descricao' => array(
            'name'     => 'Descrição',
            'type'     => 'varchar',
            'display'  => true,
            'size'     => '256',
        ),
        
        'dinamic' => array(
            'name'     => 'Campo Dinâmico',
            'type'      => 'enum',
            'default'   => 'n',
            'options'   => array(
                's'     => 'Sim',
                'n'     => 'Não',
            ),
        ),
        
        'depende_de' => array(
            'name'     => 'Campo Dinâmico',
            'type'      => 'varchar',
            'size'      => '50',
            'dinamic'   => array(
                'depende' => 'dinamic',
                'valor'   => 's'
            )
        ),

        'ordem' => array(
            'name'     => 'Ordem',
            'type'     => 'int',
            'size'     => '5',
            'grid'     => true
        )

    );
}

?>

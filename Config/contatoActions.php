<?php

use classes\Classes\Actions;
class contatoActions extends Actions{
    
    protected $permissions = array(
        
        "CONTATO_ENTRAR" => array(
            "nome"      => "CONTATO_ENTRAR",
            "label"     => "Entrar em contato",
            "descricao" => "Permissão para que um usuário entre em contato com o site",
            'default'   => 's',
        ),
        
        "CONTATO_ADMINISTRAR" => array(
            "nome"      => "CONTATO_ADMINISTRAR",
            "label"     => "Administrar plugin de contato",
            "descricao" => "Permite gerenciar departamentos e tipos de assunto ",
            'default'   => 'n',
        ),
    
    );
    
    protected $actions = array( 
        
        "contato/index/index" => array(
            "label" => "Contato", "publico" => "s", "default" => "n",
            "permission" => "CONTATO_ENTRAR",
            "menu" => array()
        ),
        
        "contato/assunto/index" => array(
            "label" => "Página de Mensagens", "publico" => "s", "default" => "n",
            "permission" => "CONTATO_ENTRAR",
            "menu" => array(
                'Setores'  => array('contato/setor/formulario'  , 'contato/setor/index',),
                'Assuntos' => array('contato/assunto/formulario','contato/assunto/listar' ,)
             )
        ),
        
        "contato/assunto/ajax" => array(
            "label" => "Página de Mensagens", "publico" => "s", "default" => "n",
            "permission" => "CONTATO_ENTRAR",
            "menu" => array()
        ),
        
        'contato/setor/index' => array(
            'label' => 'Setores Cadastrados', 'publico' => 'n', 'default' => 'n',
            "permission" => "CONTATO_ADMINISTRAR",
            'menu' => array('contato/assunto/index','contato/setor/formulario')
        ),
        
        'contato/setor/formulario' => array(
            'label' => 'Criar Setor', 'publico' => 'n', 'default' => 'n',
            "permission" => "CONTATO_ADMINISTRAR",
            'menu' => array('contato/setor/index')
        ),
        
        'contato/setor/show' => array(
            'label' => 'Página do Setor', 'publico' => 'n', 'default' => 'n',
            "permission" => "CONTATO_ADMINISTRAR", 'needcod' => true,
            'menu' => array(
                'contato/setor/index', 
                'contato/assunto/formulario',
                'Gerenciar' => array('contato/setor/edit', 'contato/setor/apagar'),
             )
        ),
        
        'contato/setor/edit' => array(
            'label' => 'Editar Setor', 'publico' => 'n', 'default' => 'n',
            "permission" => "CONTATO_ADMINISTRAR", 'needcod' => true,
            'menu' => array('contato/setor/index', 'contato/setor/show')
        ),
        
        'contato/setor/apagar' => array(
            'label' => 'Excluir Setor', 'publico' => 'n', 'default' => 'n',
            "permission" => "CONTATO_ADMINISTRAR", 'needcod' => true,
            'desc'  => 'Permite a exclusão do Setor'
        ),
        
        
        
        
        'contato/assunto/listar' => array(
            'label' => 'Assuntos Cadastrados', 'publico' => 'n', 'default' => 'n',
            "permission" => "CONTATO_ENTRAR",
            'menu' => array('contato/assunto/formulario','contato/setor/index')
        ),
        
        'contato/assunto/formulario' => array(
            'label' => 'Criar Assunto', 'publico' => 'n', 'default' => 'n',
            "permission" => "CONTATO_ADMINISTRAR",
            'menu' => array('contato/setor/index','contato/assunto/listar')
        ),
        
        'contato/assunto/edit' => array(
            'label' => 'Editar Assunto', 'publico' => 'n', 'default' => 'n',
            "permission" => "CONTATO_ADMINISTRAR", 'needcod' => true,
            'menu' => array('contato/assunto/listar', 'contato/assunto/show')
        ),

        'contato/assunto/apagar' => array(
            'label' => 'Apagar Assunto', 'publico' => 'n', 'default' => 'n',
            "permission" => "CONTATO_ADMINISTRAR", 'needcod' => true,
        ),
        
        'contato/assunto/show' => array(
            'label' => 'Visualizar Assunto', 'publico' => 's', 'default' => 's',
            "permission" => "CONTATO_ENTRAR", 'needcod' => true,
            'menu' => array('contato/assunto/listar', 'contato/assunto/edit', 'contato/assunto/apagar')
        ),

    );
}

?>
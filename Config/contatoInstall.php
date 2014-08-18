<?php

class contatoInstall extends classes\Classes\InstallPlugin{
    
    protected $dados = array(
        'pluglabel' => 'Contato',
        'isdefault' => 'n',
        'detalhes'  => 'O plugin de contatos permite que um visitante do site envie emails de contato para o seu site.
            Sua versão completa permite ainda distribuir os emails enviados pelos usuários por setor da sua empresa. Cada
            setor pode ainda cadastrar novos assuntos. Cada assunto permite ainda cadastrar campos extras no formulário de contato.
            Desta forma você pode direcionar os visitantes do seu site para que se comuniquem com sua empresa de uma melhor forma',
        'preco' => '4,90',
        'system'    => 'n',
    );
    
    public function install(){
        return true;
    }
    
    public function unstall(){
        return true;
    }
}

?>
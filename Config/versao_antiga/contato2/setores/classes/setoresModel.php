<?php

class setoresModel extends \classes\Model\Model{
    protected $tabela = "contato_setor";
    protected $pkey   = "cod_setor";
    protected $dados = array(
        
        'cod_setor' => array(
            'name'    => "Setor",
            'pkey'    => true,
            'ai'      => true,
            'type'    => 'int',
            'grid'    => true,
            'notnull' => true
         ),

        'nome_setor' => array(
            'name'    => "Nome do Setor",
            'type'    => 'varchar',
            'size'    => '64',
            'grid'    => true,
            'notnull' => true,
            'unique'  => array('model' => 'contato/setores'),
         ),

        'email' => array(
            'name'    => "Email",
            'type'    => 'varchar',
            'size'    => '64',
            'grid'    => true,
            'notnull' => true,
            'especial'=> 'email'
         )
    );

    
    private $assuntos = array(
        
        'ser-investidor-ou-comprador' => array(
            'cep'    => array('name' => 'Cep', 'type' => 'int', 'size' => '8', 'notnull' => true, 'especial' => 'cep'),
            'rua'    => array('name' => 'Logradouro', 'type' => 'varchar', 'size' => '64', 'notnull'  => true),
            'numero' => array('name' => 'Número','type' => 'varchar', 'size' => '10', 'notnull'  => true),
            'complemento' => array('name' => 'Complemento', 'type' => 'varchar', 'size' => '128'),
            'bairro'   => array('name' => 'Bairro'   ,'type' => 'varchar','size' => '64','notnull' => true),
            'cidade'   => array('name' => 'Cidade'   ,'type' => 'varchar','size' => '64','notnull' => true),
            'estado'   => array('name' => 'Estado'   ,'type' => 'varchar','size' => '64','notnull' => true),

            'país'     => array('name' => 'País'     ,'type' => 'varchar', 'default' => 'Brasil', 'size' => '64','notnull' => true)
        ),
        
        'quero-oferecer-terreno' => array(
            //'cep'    => array('name' => 'Cep', 'type' => 'int', 'size' => '8', 'notnull' => true, 'especial' => 'cep'),
            'temp'   => array('fieldset' => 'Endereço do terreno'),
            'rua'    => array('name' => 'Logradouro', 'type' => 'varchar', 'size' => '64', 'notnull'  => true),
            'numero' => array('name' => 'Número','type' => 'varchar', 'size' => '10', 'notnull'  => true),
            //'complemento' => array('name' => 'Complemento', 'type' => 'varchar', 'size' => '128'),
            'bairro' => array('name' => 'Bairro','type' => 'varchar','size' => '64','notnull' => true),
            'cidade' => array('name' => 'Cidade','type' => 'varchar','size' => '64','notnull' => true),
            
            'temp2'   => array('fieldset' => ''),
            'valor'  => array('name' => 'Valor do Terreno','type' => 'float','especial' => 'monetary', 'notnull' => true),
            'area'   => array('name' => 'Área do Terreno (m²)' ,'type' => 'decimal', 'notnull' => true),
            'temp3'   => array('fieldset' => ''),
        ),

        'pretendo-construir' => array(
            'temp'   => array('fieldset' => 'Endereço da Obra'),
            //'cep'    => array('name' => 'Cep', 'type' => 'int', 'size' => '8', 'notnull' => true, 'especial' => 'cep'),
            'rua'    => array('name' => 'Logradouro', 'type' => 'varchar', 'size' => '64', 'notnull'  => true),
            'numero' => array('name' => 'Número','type' => 'varchar', 'size' => '10', 'notnull'  => true),
            //'complemento' => array('name' => 'Complemento', 'type' => 'varchar', 'size' => '128'),
            'bairro' => array('name' => 'Bairro','type' => 'varchar','size' => '64','notnull' => true),
            'cidade' => array('name' => 'Cidade','type' => 'varchar','size' => '64','notnull' => true),
            
            'temp2'   => array('fieldset' => 'Dados da Obra'),
            'temprojeto'  => array('name' => 'Tem Projeto','type' => 'enum', 'notnull' => true, 'default' => '',
                'options' => array("Sim" => "Sim", "Não" => "Não")
             ),
            'quais' => array('name' => 'Quais?','type' => 'varchar','size' => '128'),
            'contru_amp_ref'  => array('name' => 'Construção Ampliação ou Reforma','type' => 'enum', 'notnull' => true, 'default' => '',
                'multi' => true,
                'options' => array("Construção" => "Construção", "Ampliação" => "Ampliação", "Reforma" => "Reforma")
             ),
            'rec_proprio'  => array('name' => 'Recursos próprios','type' => 'enum', 'notnull' => true, 'default' => '',
                'options' => array("Sim" => "Sim", "Não" => "Não")
             ),
            'area'   => array('name' => 'Área do Terreno(m²)' ,'type' => 'decimal'),
            
            'temp3'   => array('fieldset' => 'Mensagem')
        ),

        'contratar-projetos' => array(
            'temp2'   => array('fieldset' => 'Sobre o Projeto'),
            'quais'  => array('name' => 'Quais projetos?','type' => 'enum', 'notnull' => true, 'default' => '',
                'multi' => true,
                'options' => array(
                    "Arquitetura" => "Arquitetura", "Estruturas" => "Estruturas",
                    "Elétrico" => "Elétrico", "Hidráulico" => "Hidráulico", "Outros" => "Outros")
             ),
            'topografia'  => array('name' => 'Tem Topografia?','type' => 'enum', 'notnull' => true, 'default' => '',
                'options' => array("Sim" => "Sim", "Não" => "Não")
            ), 
            //'cep'    => array('name' => 'Cep', 'type' => 'int', 'size' => '8', 'notnull' => true, 'especial' => 'cep'),
            'temp'   => array('fieldset' => 'Endereço do Terreno'),
            'rua'    => array('name' => 'Logradouro', 'type' => 'varchar', 'size' => '64', 'notnull'  => true),
            'numero' => array('name' => 'Número Próximo ao terreno','type' => 'varchar', 'size' => '10', 'notnull'  => true),
            //'complemento' => array('name' => 'Complemento', 'type' => 'varchar', 'size' => '128'),
            'bairro' => array('name' => 'Bairro','type' => 'varchar','size' => '64','notnull' => true),
            'cidade' => array('name' => 'Cidade','type' => 'varchar','size' => '64','notnull' => true),
            'temp3'   => array('fieldset' => 'Mensagem'),
            
        ),

        'oferecer-produto-ou-servico-para-engenharia' => array(
           /* 'tipo'  => array('name' => 'Tipo de Produto','type' => 'enum', 'notnull' => true, 'default' => '',
                'options' => array(
                    "Arquitetura" => "Arquitetura", "Estruturas" => "Estruturas",
                    "Para Construção" => "Para Construção", "Para Escritório" => "Para Escritório")
             ),*/
            'arquivo' => array('name' => 'Anexar Arquivo',
                'type' => 'varchar', 'especial' => 'file'
             )
        ),

        'oferecer-produto-ou-servico-para-administracao' => array(
            'arquivo' => array('name' => 'Anexar Arquivo',
                'type' => 'varchar', 'especial' => 'file'
             )
        ),

        'enviar-curriculo' => array(
            'email_remetente' => array('name' => 'Email','type' => 'varchar','especial' => 'email',
                'grid'     => true, 'notnull'  => true
            ),
            'telefone' => array('name' => 'Telefone' ,'type' => 'varchar','especial' => 'telefone',
                'notnull'  => true
            ),
            'curriculo' => array('name' => 'Anexar Currículo',
                'type' => 'varchar', 'notnull' => true, 'especial' => 'file'
            ),
            'mensagem' => array('name' => 'Mensagem', 'type' => 'text', 'notnull' => true),
        ),
        
        'outros-assuntos'  => array('assunto' =>
            array('name' => 'Assunto', 'type' => 'varchar', 'notnull' => true),
            'arquivo' => array('name' => 'Anexar Arquivo',
                'type' => 'varchar', 'especial' => 'file'
             )
         )
        
    );
    
    public function SendMessage($post, $assunto = ""){
        if(empty ($post)) return true;
        //print_r($post);
        //die("debug");
        $email = SITE_EMAIL;
        unset($post['enviar']);
        unset($post['ajax']);
        
        //verifica se já existe um assunto setado
        $assunto = ($assunto == "")? (array_key_exists("assunto", $post)?$post['assunto']:"outros"):$assunto;
        
        //carrega o novo item pelo assunto
        $this->LoadModel("contato/assunto", 'assunto');
        $vars = $this->assunto->getItem($assunto);
        if(!empty ($vars)){
            $setor = $vars['cod_setor'];
            $item = array();
            foreach($setor as $cod_item => $var){
                $item = $this->getItem($cod_item);
                break;
            }
            $email = (empty ($item))?"":$item['email'];
        }
        unset($post['email']);
        $this->LoadModel("contato/mensagens", 'msg');
        
        $msg          = "";
        $temp_assunto = GetPlainName($assunto);
        $tassunto     = $this->assuntos[$temp_assunto];
        $data         = $this->msg->getDados();
        foreach($post as $name => $valor){
            if($valor == "") continue;
            if(array_key_exists($name, $tassunto)){$name = $tassunto[$name]['name'];}
            elseif(array_key_exists($name, $data)){$name = $data[$name]['name'];};
            $valor = is_array($valor)? implode(" ", $valor): $valor;
            $msg .= "<p><span style='font:18px bolder'>".ucfirst($name).": </span>$valor</p>";
        }
        
        if($msg == "") {
            $this->setErrorMessage("A mensagem a ser enviada está vazia");
            return false;
        }
        
        $this->LoadResource("email", 'mail');
        if (!$this->mail->sendMail($assunto, $msg, $email, $post['email_remetente'], "", $_FILES)){
            $this->setErrorMessage($this->mail->getErrorMessage());
            return false;
        }
        
        $this->setSuccessMessage("Mensagem enviada com sucesso!");
        return true;
    }
    
    public function getAssuntos(){
        
        //carrega valores
        $array = $dados = array();
        $this->LoadModel("contato/assunto", 'assunto');
        $arr = $this->assunto->selecionar(array('nome'), "", "", "", "cod_assunto ASC");

        //recupera o link
        $link = "contato/assunto/index";

        //processa valores
        foreach($arr as $a) $array[$a['nome']] = array($a['nome'] => $link . "/" .ucfirst($a['nome']));
        return $array;
    }

    public function getTitle($assunto){
        $this->LoadModel("contato/assunto", 'assunto');
        $item = $this->assunto->getItem($assunto);
        return (empty ($item))?"Outros assuntos":$item['nome'];
    }
    
    
    public function getForm($assunto = ""){
        $selecionado = ($assunto == "")? "" : $assunto;
        $assunto     = ($assunto == "")? "outros":$assunto;
        
        $this->LoadModel("contato/mensagens", 'msg');
        $dados = $this->msg->getDados();
        //echo $this->assuntos[$selecionado];
        $selecionado = GetPlainName($selecionado);
        if(array_key_exists($selecionado, $this->assuntos)) {
            $dados = array_merge($this->assuntos[$selecionado], $dados);
            if(array_key_exists("assunto", $dados)) unset($dados['assunto']);
        }
        return $dados;
    }
    
    private function ajax(){
        $this->LoadResource("html", 'html');
        $link = $this->html->getLink("contato/assunto/index/");
        $this->html->LoadJQueryFunction(
                "$('input[type=radio][name=assunto]').click(function(){
                    document.location.href='$link' + $(this).val();
                })"
        );
        
        $this->html->LoadJQueryFunction(
                "$('select[id=assunto]').click(function(){
                    document.location.href='$link' + $(this).val();
                })"
        );
    }
    
}

?>

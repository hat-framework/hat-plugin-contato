<?php

class contato_assuntoModel extends \classes\Model\Model{
    protected $tabela = "contato_assunto";
    protected $pkey   = "cod_assunto";
    protected $dados = array(

        'cod_assunto' => array(
            'name'    => "Código",
            'type'    => 'int',
            'size'    => '11',
            'grid'    => true,
            'notnull' => true,
            'display' => true,
            'private' => true,
            'pkey'    => true,
            'ai'      => true
         ),
        
        'cod_setor' => array(
            'name'    => "Setor",
            'type'    => 'int',
            'grid'    => true,
            'display' => true,
            'notnull' => true,
            'especial'    => 'session',
            'session'     => 'contato/setor',
            'fkey'      => array(
                'model' 	=> 'contato/setor',
                'cardinalidade' => '1n',//nn 1n 11
                'keys'          => array("cod_setor", "nome_setor")//nn 1n 11
            )
         ),
        
        'anome' => array(
            'name'    => "Assunto",
            'type'    => 'varchar',
            'size'    => '64',
            'grid'    => true,
            'display' => true,
            'notnull' => true,
            'unique'  => array('model' => 'contato/assunto'),
         ),
        
        'ordem' => array(
            'name'    => "Ordem",
            'type'    => 'int',
            'display' => true,
            'size'    => '5',
            'grid'    => true,            
         ),

        'cod_campo' => array(
            'name'    => "Campos",
            'type'    => 'int',
            'size'    => '11',
            'grid'    => true,
            'notnull' => true,
            'fkey'      => array(
                'refmodel'      => 'contato/assunto',
                'model' 	=> 'contato/campo',
                'cardinalidade' => 'n1',//nn 1n 11
                'keys'          => array("cod_campo", "label")//nn 1n 11
            )
         ),

        
    );
        
    public function getTitle($cod_item){
        $arr = $this->selecionar(array('anome'), "`cod_assunto`='$cod_item'", NULL, NULL, " ordem ASC ");
        $arr = array_shift($arr);
        return $arr['anome'];
    }

    public function getAssuntos(){

        if(CONTATO_TIPO == "simples") return array();
        $array = array();
        $arr = $this->selecionar(array('anome', 'cod_assunto'), NULL, NULL, NULL, " ordem ASC ");

        //recupera o link
        $link = "contato/assunto/formulario";
        //processa valores
        foreach($arr as $a) $array[$a['anome']] = array($a['anome'] => $link . "/" .$a['cod_assunto'] . "/". GetPlainName($a['anome']));
        return $array;
    }
    
    private function getSimpleForm(){
        
        $this->LoadModel("contato/mensagem", 'msg');
        $form = $this->msg->getDados();
        unset($form['cod_assunto']);
        return $form;
    }

    public function getForm($assunto = ""){
        if(CONTATO_TIPO == "simples") return $this->getSimpleForm();
        $this->LoadModel("contato/mensagem", 'msg');
        $this->LoadModel("contato/campo", 'camp');
        $form = $this->msg->getDados();
        unset($form['assunto']);
        $base_dir = classes\Classes\Registered::getResourceLocation('formulario', true)."/lib/";
        
        //procura os campos extras de um determinado assunto
        $dados = $this->camp->listSimpleItem($assunto, array(), "cod_assunto");
        
        //se não existirem campos extras
        if(empty ($dados)){
            
            //verifica se o assunto existe
            $assunto = $this->selecionar(array('cod_assunto'), " cod_assunto = '$assunto' ");
            
            //se o assunto não existe
            if(empty ($assunto)) {
                
                //verifica se o assunto outros existe
                $assunto = $this->selecionar(array('cod_assunto'), " anome = 'Outros' ");
                if(!empty ($assunto)){
                    $assunto = $assunto[0]['cod_assunto'];
                    $dados   = $this->camp->listSimpleItem($assunto, array(), "cod_assunto");
                }
                    
            }
            
            //se o assunto existe
            else $assunto = $assunto[0]['cod_assunto'];
        }

        if(!empty($dados))
        foreach($dados as $arr){
            $especial = "";
            $type = $arr['type'];
            $file = $base_dir . "types/".$type ."Type.php";
            if(!file_exists($file)){
                $file = $base_dir . "especial/".$type ."Especial.php";
                if(!file_exists($file)) continue;
                $form[$arr['cod_campo']]['especial'] = $type;
            }else $form[$arr['cod_campo']]['type'] = $type;
            
            if($type == "enum" || $type == "multi_enum"){
                $o = array();
                $out = explode(",", $arr['size']);
                foreach($out as $n) {
                    $total = count($n);
                    $j = 0; 
                    while($n[$j] == " " && $j < $total) {$j++;}
                    $n = substr($n, $j);

                    $i = GetPlainName($n);
                    $o[$i] = ucfirst($n);
                }
                $form[$arr['cod_campo']]['options'] = $o;
            }
            
            $form[$arr['cod_campo']]['name']        = $arr['label'];
            $form[$arr['cod_campo']]['size']        = $arr['size'];
            $form[$arr['cod_campo']]['description'] = $arr['descricao'];
        }
        $form['cod_assunto']['default'] = $assunto;
        $fmsg = $form['mensagem'];
        //$fext = $form['temp'];
        //unset($form['temp']);
        unset($form['mensagem']);
        //$form['temp']     = $fext;
        $form['mensagem'] = $fmsg;
        return $form;
    }
    
}

?>

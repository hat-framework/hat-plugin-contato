<?php

class contatoComponent extends classes\Component\Component{
    public function draw($title = '', $class = ''){
        echo "
            <div class='infotitle inset $class'>$title</div>
            <div class='infotext'>
                SAC (31) 3333 3333 | Televendas (31) 3333 3333 | E-mail: <a href='mailto:contato@powercell.com.br'>contato@powercell.com.br</a>
            </div>
            <div class='clear'></div>";
    }
}

?>

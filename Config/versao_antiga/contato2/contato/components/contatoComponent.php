<?php

class contatoComponent extends classes\Component\Component{
    public function draw($title = '', $class = ''){
        $email    = SITE_EMAIL;
        $telefone = SITE_TELEFONE;
        $sac      = SITE_TELEFONE_SAC;
        echo "
            <div class='infotitle inset $class'>$title</div>
            <div class='infotext'>
                SAC $sac | Televendas $telefone | E-mail: <a href='mailto:$email'>$email</a>
            </div>
            <div class='clear'></div>";
    }
}

?>

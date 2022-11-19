<?php
//$ sudo /opt/lampp/lampp start
/*Controllare che le variabili "A" e "B" non siano nulle e che siano valide,
    ovvero che siano numeri positivi e che sul db ci siano numeri appartenenti a quell'insieme.

*/
    if(isset($_GET["A"]) && isset($_GET["B"]) && isset($_GET["O"])){
        if($_GET["A"] > 0 && $_GET["B"] > 0 && ($_GET["O"] == "u" || $_GET["O"] == "i")){

        }else{
            $msg="Uno dei tre parametri non soddisfa i parametri di dominio: A, B > 0 e O == i o O == u";
            print($msg);
        }
    }else{
        $msg = "Uno dei tre parametri inseriti è NULLO";
        print($msg);
    }
?>
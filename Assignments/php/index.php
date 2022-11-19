<?php
//$ sudo /opt/lampp/lampp start
/*Controllare che le variabili "A" e "B" non siano nulle e che siano valide,
    ovvero che siano numeri positivi e che sul db ci siano numeri appartenenti a quell'insieme.

*/


function checkInsieme($dbh, $insieme, $who){
    $query = "SELECT * FROM insiemi WHERE insieme = ?";
    $stmt = $dbh->prepare($query);
    $stmt->bind_param('i', $insieme);
    $stmt->execute();
    $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    if(count($result) == 0){
        die("Errore insieme: " . "L'insieme ".$who." NON ESISTE ");
    }
}


function getAllValues($dbh, $insieme){
    $query = "SELECT valore FROM insiemi WHERE insiemi.insieme = ?";
    $stmt = $dbh->prepare($query);
    $stmt->bind_param('i', $insieme);
    $stmt->execute();
    return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
}

function unionValues($values_A, $values_B){
    $result = array();
    
}

function intersectValues($values_A, $values_B){
    var_dump(array_intersect($values_A, $values_B));
}

    if(isset($_GET["A"]) && isset($_GET["B"]) && isset($_GET["O"])){
        if($_GET["A"] > 0 && $_GET["B"] > 0 && ($_GET["O"] == "u" || $_GET["O"] == "i")){
            $insieme_a = $_GET["A"];
            $insieme_b = $_GET["B"];
            $operazione = $_GET["O"];
            //che sul db ci siano numeri appartenenti a quell'insieme
            $dbh = new mysqli("localhost", "root", "", "giugno", 3306);
            if ($dbh->connect_error) {
                die("Connection failed: " . $dbh->connect_error);
            }
            checkInsieme($dbh, $insieme_a, "A");
            checkInsieme($dbh, $insieme_b, "B");
            $values_A = getAllValues($dbh, $insieme_a);
            $values_B = getAllValues($dbh, $insieme_b);
            if($operazione == "u"){
                $result = unionValues($values_A, $values_B);
            }else{
                intersectValues($values_A, $values_B);
            }
            var_dump($result);

        }else{
            $msg="Uno dei tre parametri non soddisfa i parametri di dominio: A, B > 0 e O == i o O == u";
            print($msg);
        }
    }else{
        $msg = "Uno dei tre parametri inseriti è NULLO";
        print($msg);
    }
?>
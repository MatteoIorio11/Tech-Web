<?php
//$ sudo /opt/lampp/lampp start
/*Controllare che le variabili "A" e "B" non siano nulle e che siano valide,
    ovvero che siano numeri positivi e che sul db ci siano numeri appartenenti a quell'insieme.

*/

use LDAP\Result;

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

function castToInt($values){
    //So che questo metodo puo non aver senso, ma i confronti tra interi vengono fatti piu rapidamente
    $result = array();
    foreach($values as $val){
        array_push($result, (int) $val["valore"]);
    }
    return $result;
}

function unionValues($values_A, $values_B){
    return array_merge($values_A, $values_B);
}

function getMaxID($dbh){
    $query = "SELECT MAX(insieme) FROM insiemi";
    $stmt = $dbh->prepare($query);
    $stmt->execute();    
    return $stmt->get_result()->fetch_all(MYSQLI_ASSOC)[0]["MAX(insieme)"] + 1;
}

function addToDB($dbh, $result){
    $id_insieme = getMaxID($dbh);
    $query = "INSERT INTO insiemi (valore, insieme) 
              VALUES (?, ?)";
    $stmt = $dbh->prepare($query);
    foreach($result as $value){
        $stmt->bind_param('i', $value, $id_insieme);
        $stmt->execute();
    }
}

function intersectValues($values_A, $values_B){
    return array_intersect($values_A, $values_B);
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
                $result = intersectValues(castToInt($values_A), castToInt($values_B));
            }
            if(count($result) > 0){
                addToDB($dbh, $result);
            }

        }else{
            $msg="Uno dei tre parametri non soddisfa i parametri di dominio: A, B > 0 e O == i o O == u";
            print($msg);
        }
    }else{
        $msg = "Uno dei tre parametri inseriti è NULLO";
        print($msg);
    }
?>
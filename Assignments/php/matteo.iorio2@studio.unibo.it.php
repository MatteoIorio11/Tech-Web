<?php
function checkInsieme($dbh, $insieme, $who){
    $query = "SELECT * FROM insiemi WHERE insiemi.insieme = ?";
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
    print("OPERAZIONE : UNIONE" . "<br/>" );
    print("VALORI INSIEME A : ");
    printValues($values_A);
    print("<br/>" . "VALORI INSIEME B : ");
    printValues($values_B);
    return  array_unique (array_merge ($values_A, $values_B));
}

function getMaxID($dbh){
    $query = "SELECT MAX(insieme) FROM insiemi";
    $stmt = $dbh->prepare($query);
    $stmt->execute();    
    return $stmt->get_result()->fetch_all(MYSQLI_ASSOC)[0]["MAX(insieme)"] + 1;
}

function addToDB($dbh, $result){
    $id_insieme = getMaxID($dbh);
    $query = "INSERT INTO insiemi (valore, insieme) VALUES (?, ?)";
    $stmt = $dbh->prepare($query);
    foreach($result as $value){
        $stmt->bind_param('ii', $value, $id_insieme);
        $stmt->execute();
    }
}

function printValues($values){
    foreach($values as $val){
        echo($val . " ");
    }
}

function intersectValues($values_A, $values_B){
    print("OPERAZIONE : INTERSEZIONE" . "<br/>" );
    print("VALORI INSIEME A : ");
    printValues($values_A);
    print("<br/>" . "VALORI INSIEME B : ");
    printValues($values_B);
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
            //Controllare che le variabili "A" e "B" non siano nulle e che siano valide, ovvero che siano numeri positivi e che sul db ci siano numeri appartenenti a quell'insieme.
            checkInsieme($dbh, $insieme_a, "A");
            checkInsieme($dbh, $insieme_b, "B");
            //Leggere tutti i numeri appartenenti a ciascun insieme (A e B) su database e inserirli in due vettori distinti.
            $values_A = getAllValues($dbh, $insieme_a);
            $values_B = getAllValues($dbh, $insieme_b);
            if($operazione == "u"){
                //Creare un nuovo vettore contenente l'unione dei due insiemi se O vale u
                $result = unionValues(castToInt($values_A), castToInt($values_B));
            }else{
                // altrimenti dovrà contenere l'intersezione dei due insiemi
                $result = intersectValues(castToInt($values_A), castToInt($values_B));
            }
            if(count($result) > 0){
                //Inserire sul db il nuovo insieme, usando come id dell'insieme il successivo all'id massimo.
                addToDB($dbh, $result);
                echo("<br/>". "I seguenti valori sono stati aggiunti : ");
                printValues($result);
            }

        }else{
            $msg="Uno dei tre parametri non soddisfa i parametri di dominio: A, B > 0 e O == i o O == u. <br/>".
            "Valore di A : ".$_GET["A"]." VALORE DI B : ".$_GET["B"]." VALORE DI O : ".$_GET["O"];
            print($msg);
        }
    }else{
        $msg = "Uno o piu parametri inseriti sono NULLI <br/>".
        "Valore di A : ".(isset($_GET["A"]) ? ($_GET["A"]) : "NULL")." VALORE DI B : ".(isset($_GET["B"]) ? ($_GET["B"]) : "NULL")." VALORE DI O : ".(isset($_GET["O"]) ? ($_GET["O"]) : "NULL");
        print($msg);
    }
?>
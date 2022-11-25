<?php

class Database{
    private $dbh;
    
    public function __construct($servername, $username, $password, $dbname, $port)
    {
        $this->dbh = new mysqli("localhost", "root", "", "giugno", 3306);
            if ($this->dbh->connect_error) {
                die("Connection failed: " . $this->dbh->connect_error);
            }
    }

    /// check the existance of $insieme
    function checkInsieme($insieme, $who){
        $query = "SELECT * FROM insiemi WHERE insiemi.insieme = ?";
        $stmt = $this->dbh->prepare($query);
        $stmt->bind_param('i', $insieme);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        if(count($result) == 0){
            die("Errore insieme: " . "L'insieme ".$who." NON ESISTE ");
        }
    }

    /// return all the values from $insieme
    public function getAllValues($insieme){
        $query = "SELECT valore FROM insiemi WHERE insiemi.insieme = ?";
        $stmt = $this->dbh->prepare($query);
        $stmt->bind_param('i', $insieme);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    /// OPERATION : UNION
    public function unionValues($val_A, $val_B){
        $values_A = $this->castToInt($val_A);
        $values_B = $this->castToInt($val_B);
        print("OPERAZIONE : UNIONE" . "<br/>" );
        print("VALORI INSIEME A : ");
        $this->printValues($values_A);
        print("<br/>" . "VALORI INSIEME B : ");
        $this->printValues($values_B);
        return  array_unique (array_merge ($values_A, $values_B));
    }

    /// OPERATION : INTERESECT
    public function intersectValues($val_A, $val_B){
        $values_A = $this->castToInt($val_A);
        $values_B = $this->castToInt($val_B);
        print("OPERAZIONE : INTERSEZIONE" . "<br/>" );
        print("VALORI INSIEME A : ");
        $this->printValues($values_A);
        print("<br/>" . "VALORI INSIEME B : ");
        $this->printValues($values_B);
        return array_intersect($values_A, $values_B);
    }

    /// Add the new values inside the DB
    public function addToDB($result){
        $id_insieme = $this->getMaxID($this->dbh);
        $query = "INSERT INTO insiemi (valore, insieme) VALUES (?, ?)";
        $stmt = $this->dbh->prepare($query);
        foreach($result as $value){
            $stmt->bind_param('ii', $value, $id_insieme);
            $stmt->execute();
        }
    }
    
    /// print all the $values
    public function printValues($values){
        foreach($values as $val){
            echo($val . " ");
        }
    }

    /// cast all the values to int
    private function castToInt($values){
        $result = array();
        foreach($values as $val){
            array_push($result, (int) $val["valore"]);
        }
        return $result;
    }

    /// get the max value of "insieme"
    private function getMaxID(){
        $query = "SELECT MAX(insieme) FROM insiemi";
        $stmt = $this->dbh->prepare($query);
        $stmt->execute();    
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC)[0]["MAX(insieme)"] + 1;
    }
}

    if(isset($_GET["A"]) && isset($_GET["B"]) && isset($_GET["O"])){
        if($_GET["A"] > 0 && $_GET["B"] > 0 && ($_GET["O"] == "u" || $_GET["O"] == "i")){
            $insieme_a = $_GET["A"];
            $insieme_b = $_GET["B"];
            $operazione = $_GET["O"];
            //che sul db ci siano numeri appartenenti a quell'insieme
            $db = new Database("localhost", "root", "", "giugno", 3306);
            //Controllare che le variabili "A" e "B" non siano nulle e che siano valide, ovvero che siano numeri positivi e che sul db ci siano numeri appartenenti a quell'insieme.
            $db->checkInsieme($insieme_a, "A");
            $db->checkInsieme($insieme_b, "B");
            //Leggere tutti i numeri appartenenti a ciascun insieme (A e B) su database e inserirli in due vettori distinti.
            $values_A = $db->getAllValues($insieme_a);
            $values_B = $db->getAllValues($insieme_b);
            $result = array();
            if($operazione == "u"){
                //Creare un nuovo vettore contenente l'unione dei due insiemi se O vale u
                $result = $db->unionValues($values_A, $values_B);
            }else{
                // altrimenti dovrà contenere l'intersezione dei due insiemi
                $result = $db->intersectValues($values_A, $values_B);
            }
            if(count($result) > 0){
                //Inserire sul db il nuovo insieme, usando come id dell'insieme il successivo all'id massimo.
                $db->addToDB($result);
                echo("<br/>". "I seguenti valori sono stati aggiunti : ");
                $db->printValues($result);
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
<?php 
    require("bootstrap.php");
    $response["logineseguito"]  = false;
    if(isset($_GET)){
        if(isUserLoggedIn()){
            $response["logineseguito"]  = true;
        }
        header("Content-Type: application/json");
        echo json_encode($response);
    }else if(isset($_POST)){
        if(isset($_POST["username"]) && isset($_POST["password"])){
            $login_result = $dbh->checkLogin($_POST["username"], $_POST["password"]);
            if(count($login_result)==0){
                //Login fallito
              = "Errore! Controllare username o password!";
            }
            else{
                registerLoggedUser($login_result[0]);
            }
        }
    }

?>
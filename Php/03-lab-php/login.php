<?php
require_once 'bootstrap.php';


//Controllo login utente
if(isset($_POST["username"]) && isset($_POST["password"])){
    //Controllo se l'utente esiste veramente 
    $login_result=$dbh->checkLogin($_POST["username"], $_POST["password"]);
    if(count($login_result) == 0){
        //Il login fa riferimento a un utente che non esiste
        $msg ="ERRORE: l'utente che sta accedendo non è registrato all'interno del DataBase";
        $templateParams["erroreLogin"]=$msg;
    }else{
        //L'utente esiste
        registerLoggedUser($login_result[0]);
    }
}

if(isUserLoggedIn()){
    $templateParams["titolo"] = "Blog TW - Admin";
    $templateParams["nome"] = "login-home.php";
    $templateParams["articoli"] = $dbh->getPostByAuthorId($_SESSION["idautore"]);
}else{
    $templateParams["titolo"] = "Blog TW - Login";
    $templateParams["nome"] = "login-form.php";
    
}


$templateParams["categorie"] = $dbh->getCategories();
$templateParams["articolicasuali"] = $dbh->getRandomPosts(2);

require 'template/base.php';
?>
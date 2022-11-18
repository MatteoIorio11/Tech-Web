<?php
require("bootstrap.php");

if(!isUserLoggedIn() || !isset($_POST["action"])){
    header("location: login.php");
}

if($_POST["action"]==1){
    //Inserisco
    $titoloarticolo = $_POST["titoloarticolo"];
    $testoarticolo = $_POST["testoarticolo"];
    $anteprimaarticolo = $_POST["anteprimaarticolo"];
    $dataarticolo = date("Y-m-d");
    $autore = $_SESSION["idautore"];

    //Categorie in sospeso
    $categories = $dbh->getCategories();
    $categorie_inserite = array();
    foreach($categories as $category){
        if(isset($_POST["categoria_".$category["idcategoria"]])){
            array_push($categorie_inserite,$category["idcategoria"]);
        }
    }

    list($result, $msg) = uploadImage(UPLOAD_DIR, $_FILES["imgarticolo"]);
    if($result==1){
        $imgarticolo = $msg;
        $id = $dbh->insertArticle($titoloarticolo, $testoarticolo, $anteprimaarticolo, $dataarticolo, $imgarticolo, $autore);
        if($id != false){
            foreach($categorie_inserite as $idcateogoria){
                $dbh->insertCategoryOfArticle($id, $idcateogoria);
            }
            $msg = "Inserimento avvenuto con successo!!";
        }else{
            $msg  = "Errore di inserimento, controlla il tuo input. ID == FALSE";
        }
    }
    header("location: login.php?formmsg=".$msg);
}

var_dump($categorie_inserite);

var_dump($_POST);

var_dump($_FILES);

?>
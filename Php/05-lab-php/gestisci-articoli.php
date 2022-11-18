<?php
require_once 'bootstrap.php';

if(!isUserLoggedIn() || !isset($_GET["action"])){
    header("location: login.php");
}


//Base Template
$templateParams["titolo"] = "Blog TW - Gestisci Articoli";
$templateParams["nome"] = "admin-form.php";
$templateParams["categorie"] = $dbh->getCategories();
$templateParams["articolicasuali"] = $dbh->getRandomPosts(2);

require 'template/base.php';
?>
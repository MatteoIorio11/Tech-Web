<?php
<<<<<<< HEAD
require_once 'bootstrap.php';

//Base Template
$templateParams["titolo"] = "Blog TW - Articolo";
$templateParams["nome"] = "singolo-articolo.php";
$templateParams["categorie"] = $dbh->getCategories();
$templateParams["articolicasuali"] = $dbh->getRandomPosts(2);
//Home Template
$idarticolo = -1;
if(isset($_GET["id"])){
    $idarticolo = $_GET["id"];
}
$templateParams["articolo"] = $dbh->getPostById($idarticolo);

require 'template/base.php';
=======
require_once("bootstrap.php");

$templateParams["titolo"] ="Blog TW - Home";
$templateParams["nome"]="articolo-singolo.php";
$templateParams["articolicasuali"] = $dbh->getRandomPosts(2);
$templateParams["categorie"] = $dbh->getCategories();
$templateParams["articolo"] = $dbh->getArticleFromID($_GET['id']);

require_once("template/base.php");
//var_dump($dbh->getRandomPosts(2));
>>>>>>> bc306d50ff3a707d639c0ab78dac1dbc9d7c8351
?>
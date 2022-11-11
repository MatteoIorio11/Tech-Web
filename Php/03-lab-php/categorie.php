<?php
require_once("bootstrap.php");

$templateParams["titolo"] ="Blog TW - Home";
$templateParams["nome"]="articoli-categoria.php";
$templateParams["articolicasuali"] = $dbh->getRandomPosts(2);
$templateParams["categorie"] = $dbh->getCategories();
$templateParams["articoli"] = $dbh->getArticlesFromCategory($_GET['cat']);

require_once("template/base.php");
//var_dump($dbh->getRandomPosts(2));
?>
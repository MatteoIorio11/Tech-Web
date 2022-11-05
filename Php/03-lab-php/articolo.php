<?php
require_once("bootstrap.php");

$templateParams["titolo"] ="Blog TW - Home";
$templateParams["nome"]="articolo-singolo.php";
$templateParams["articolicasuali"] = $dbh->getRandomPosts(2);
$templateParams["categorie"] = $dbh->getCategories();
$templateParams["articolo"] = $dbh->getArticleFromID($_GET['id']);

require_once("template/base.php");
//var_dump($dbh->getRandomPosts(2));
?>
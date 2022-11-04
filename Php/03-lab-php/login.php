<?php
require_once("bootstrap.php");

$templateParams["titolo"] ="Blog TW - Home";
$templateParams["nome"]="login-form.php";
$templateParams["articolicasuali"] = $dbh->getRandomPosts(2);
$templateParams["categorie"] = $dbh->getCategories();
$templateParams["articoli"] = $dbh->getPosts(2);

require_once("template/base.php");
//var_dump($dbh->getRandomPosts(2));
?>
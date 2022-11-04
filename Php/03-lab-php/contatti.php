<?php
require_once("bootstrap.php");

$templateParams["titolo"] ="Blog TW - Home";
$templateParams["nome"]="contatti-style.php";
$templateParams["articolicasuali"] = $dbh->getRandomPosts(2);
$templateParams["categorie"] = $dbh->getCategories();
$templateParams["articoli"] = $dbh->getPosts(2);
$templateParams["autori"] = $dbh->getAuthors();

require_once("template/base.php");
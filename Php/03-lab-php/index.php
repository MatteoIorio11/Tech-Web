<?php
require_once("bootstrap.php");

$templateParams["titolo"] ="Blog TW - Home";
$templateParams["articolicasuali"] = $dbh->getRandomPosts(2);

require_once("template/base.php");
//var_dump($dbh->getRandomPosts(2));
?>
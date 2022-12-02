<?php
require_once 'bootstrap.php';

//Base Template
$templateParams["titolo"] = "Blog TW - Contatti";
$templateParams["categorie"] = $dbh->getCategories();
$templateParams["articolicasuali"] = $dbh->getRandomPosts(2);
$templateParams["js"]=array("https://unpkg.com/axios/dist/axios.min.js", "js/contatti.js");
//Home Template

require 'template/base.php';
?>
<?php 
require_once("db/database.php");
define("UPLOAD_DIR", "./upload/");
$dbh = new DatabaseHelper("localhost", "root", "", "blogtw", 3306);

?>
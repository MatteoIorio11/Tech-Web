<?php 
    require("bootstrap.php");
    $autori = $dbh->getAuthors();
    header("Content-Type: application/json");
    echo json_encode($autori);

?>
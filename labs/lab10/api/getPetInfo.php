<?php
    include "../../../inc/dbConnection.php";
    $dbConn = getDatabaseConnection("c9");
    
    $id = $_GET["id"];
    if (isset($id)) {
        $sql = "SELECT name, YEAR(CURDATE())-yob as age, breed, pictureURL, description
                FROM pets
                WHERE id = $id";
        $stmt = $dbConn->prepare($sql);
        $stmt->execute();
        $record = $stmt->fetch(PDO::FETCH_ASSOC);
        // print_r($record);
        echo json_encode($record);
    }
    
?>
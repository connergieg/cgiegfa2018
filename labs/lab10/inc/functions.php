<?php
    include "../../inc/dbConnection.php";
    $dbConn = getDatabaseConnection("c9");
    
    function getAllPets() {
        global $dbConn;
        $sql = "SELECT id,name,type,pictureURL,description FROM pets
                ORDER BY name ASC";
        $stmt = $dbConn->prepare($sql);
        $stmt->execute();
        $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
        // print_r($records);
        return $records;
    }
?>
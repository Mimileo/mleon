<?php
("../../dbConnection.php");
$conn = getDatabaseConnection();
$searchName = $_GET['value'];

$sql = "SELECT time FROM weatherData WHERE 
        location = '$searchName'";
         $stmt = $conn->query($sql);
        $results = $stmt->fetchAll();
        foreach($results as $records){
            echo $record['time'] . "<br/>";
        }

?>
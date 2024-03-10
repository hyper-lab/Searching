<?php
    include 'connection.php';

    if(isset($_GET['search'])){
        $search = $_GET['search'];
        $searchTerm = "%$search%";
        
        // Prepare the SQL statement to prevent SQL injection
        $stmt = $conn->prepare("SELECT * FROM `user` WHERE `name` LIKE ? OR `lastname` LIKE ?");
        $stmt->bind_param("ss", $searchTerm, $searchTerm);

        $stmt->execute();

        $result = $stmt->get_result();

        if($result->num_rows > 0){
            echo "record found";
        }else{
            echo "No record found";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="index.php" method="get">
        <label for="search">Search</label>
        <input type="text" id="search" name="search">
        <button type="submit" id="btn">Search</button>
    </form>
</body>
</html>
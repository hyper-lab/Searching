<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Search</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f2f2f2;
        }
        .container {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        form {
            display: flex;
            align-items: center;
        }
        label {
            margin-right: 10px;
            font-weight: bold;
        }
        input[type="text"] {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            flex: 1;
        }
        button {
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover {
            background-color: #0056b3;
        }
        .result {
            margin-top: 20px;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>User Search</h2>
        <form action="index.php" method="get">
            <label for="search">Search:</label>
            <input type="text" id="search" name="search">
            <button type="submit" id="btn">Search</button>
        </form>
        <div class="result">
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
                        echo "Record found";
                    }else{
                        echo "No record found";
                    }
                }
            ?>
        </div>
    </div>
</body>
</html>

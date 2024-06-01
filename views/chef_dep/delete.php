<?php
// Include your database connection file
include 'connect.php';
// var_dump($_GET['id']);
// Check if ID parameter exists and is not empty
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id_module = $_GET['id'];

    // Fetch module data from the database based on ID
    $stmt = $pdo->prepare("SELECT * FROM module WHERE IdModule = ?");
    $stmt->execute([$id_module]);
    $module = $stmt->fetch();

    // Check if module exists
    if (!$module) {
        echo "Module not found";
        exit();
    }
    
    // Check if form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        try {
            // Prepare the SQL statement to delete module
            $stmt = $pdo->prepare("DELETE FROM module WHERE IdModule = ?");
            // Bind parameters and execute the statement
            $stmt->execute([$id_module]);

            // Redirect to display page after successful deletion
            header("Location:../../routing/routing.php?action=Gestiondemodule");
            exit();
        } catch (PDOException $e) {
            // Display error message
            echo "Error: " . $e->getMessage();
        }
    }
} else {
    echo "Invalid request";

    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Module</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 50%;
            margin: auto;
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 50px;
            border-radius: 8px;
        }
        h2 {
            text-align: center;
            color: #343a40;
        }
        p {
            text-align: center;
            font-size: 18px;
            color: #495057;
        }
        .btn {
            background-color: #007bff;
            border: none;
            color: white;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 10px auto;
            cursor: pointer;
            border-radius: 5px;
            transition: background-color 0.3s;
            display: block;
            width: fit-content;
        }
        .btn-cancel {
            background-color: #6c757d;
        }
        .btn:hover {
            background-color: #0056b3;
        }
        .btn-cancel:hover {
            background-color: #5a6268;
        }
        form {
            text-align: center;
        }
    </style>
    <script>
        function confirmDeletion() {
            return confirm("Are you sure you want to delete this module?");
        }
    </script>
</head>
<body>
    <!-- <?php var_dump($_GET['id'])?> -->
    <div class="container">
        <h2>Delete Module</h2>
        <p>Are you sure you want to delete the module <?= htmlspecialchars($module['Intitule']) ?>?</p>
        <form action="" method="post" onsubmit="return confirmDeletion();">
            <input type="submit" name="submit" value="Delete" class="btn">
            <a href="display.php" class="btn btn-cancel">Cancel</a>
        </form>
    </div>
</body>
</html>

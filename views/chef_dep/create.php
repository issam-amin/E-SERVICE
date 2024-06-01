<?php
// Include your database connection file
require_once 'connect.php';

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    session_start();
    $nom_module = $_POST['nom_module'];
    $id_specialite = $_POST['specialite'];
    $idDEp=$_SESSION['depart'];

    // Check if all fields are filled
    if (empty($nom_module) || empty($id_specialite)) {
        $errorMessage = "All fields are required";
        echo "<div class='error'>$errorMessage</div>";
    } else {
        try {
            // Prepare the SQL statement
            $stmt = $pdo->prepare("INSERT INTO module (Intitule, idSpecialite,IdDep) VALUES (?,?,?)");
            
            // Bind parameters and execute the statement
            $stmt->execute([$nom_module, $id_specialite,$idDEp]);
            
            // Redirect to the display page after successful insertion
            header("Location:../../routing/routing.php?action=Gestiondemodule");
            exit();
        } catch (PDOException $e) {
            // Display error message
            echo "<div class='error'>Error: " . $e->getMessage() . "</div>";
        }
    }
}

// Fetch specialities from the database
$specialiteStmt = $pdo->query("SELECT id_specialite, nom_specialite FROM specialite");
$specialites = $specialiteStmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un Module</title>
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
        .form-group {
            margin-bottom: 15px;
        }
        label {
            display: block;
            margin-bottom: 5px;
            color: #495057;
        }
        input[type="text"], select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ced4da;
            border-radius: 4px;
            font-size: 16px;
        }
        .error {
            color: red;
            margin-bottom: 15px;
        }
        .buttons {
            display: flex;
            justify-content: space-between;
        }
        .btn-submit, .btn-cancel {
            background-color: #007bff;
            border: none;
            color: white;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            font-size: 16px;
            cursor: pointer;
            border-radius: 5px;
            transition: background-color 0.3s;
        }
        .btn-cancel {
            background-color: #6c757d;
        }
        .btn-submit:hover {
            background-color: #0056b3;
        }
        .btn-cancel:hover {
            background-color: #5a6268;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Ajouter un Module</h2>
        <form action="" method="post">
            <div class="form-group">
                <label for="nom_module">Nom du Module:</label>
                <input type="text" id="nom_module" name="nom_module" required>
            </div>
            <div class="form-group">
                <label for="specialite">Specialite:</label>
                <select id="specialite" name="specialite" required>
                    <option value="">Sélectionner Specialite</option>
                    <?php foreach ($specialites as $specialite) : ?>
                        <option value="<?= $specialite['id_specialite'] ?>">
                            <?= htmlspecialchars($specialite['nom_specialite']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="buttons">
                <input type="submit" name="submit" value="Ajouter Module" class="btn-submit">
                <a href="gestionModule.php" class="btn-cancel">Annuler</a>
            </div>
        </form>
    </div>
</body>
</html>
<?php 
if (isset($_GET['action'])) {
    switch ($_GET['action']) {
        case 'add_success':
            $_SESSION['message'] = "Module ajouté avec succès.";
            $_SESSION['msg_type'] = "success";
            break;
        case 'delete_success':
            $_SESSION['message'] = "Module supprimé avec succès.";
            $_SESSION['msg_type'] = "success";
            break;
        case 'update_success':
            $_SESSION['message'] = "Module mis à jour avec succès.";
            $_SESSION['msg_type'] = "success";
            break;
        case 'assign_success':
            $_SESSION['message'] = "Module affecté avec succès.";
            $_SESSION['msg_type'] = "success";
            break;
        case 'error':
            $_SESSION['message'] = "Une erreur s'est produite. Veuillez réessayer.";
            $_SESSION['msg_type'] = "danger";
            break;
    }
}?>
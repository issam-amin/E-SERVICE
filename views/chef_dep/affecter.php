<?php
include 'connect.php';

if (isset($_GET['id'])) {
    $id_module = $_GET['id'];

    // Fetch the id_specialite from the module_specialite table
    $sql = "SELECT idSpecialite FROM module WHERE IdModule= :IdModule";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['IdModule' => $id_module]);
    $specialite = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($specialite) {
        $id_specialite = $specialite['idSpecialite'];

        // Fetch the professors with the same id_specialite
        $sql = "SELECT  * FROM prof WHERE idSpecialite = :id_specialite";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['id_specialite' => $id_specialite]);
        $profs = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } else {
        echo "Specialité non trouvée pour ce module.";
        exit();
    }
} else {
    echo "ID de module non spécifié.";
    exit();
}
 
$niveauStmt = $pdo->query("SELECT IdNiveau, nivNom FROM niveau");
$niveaux = $niveauStmt->fetchAll(PDO::FETCH_ASSOC);

// Uncomment and adjust the following lines to fetch semestre data from the database
// $semestreStmt = $pdo->query("SELECT id_semestre, nom_semestre FROM semestre");
// $semestres = $semestreStmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Affecter Module</title>
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
        select, input[type="text"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ced4da;
            border-radius: 4px;
            font-size: 16px;
        }
        button {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
        }
        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Affecter Module</h2>
        <form action="affectationprof.php" method="post">
            <input type="hidden" name="id_module" value="<?= $id_module ?>">
            <div class="form-group">
                <label for="professor">Sélectionner un professeur :</label>
                <select id="professor" name="professor">
                    <?php foreach ($profs as $prof) : ?>
                        <option value="<?= $prof['IdProf'] ?>"><?= $prof['Nom'] . " " . $prof['Prenom'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <!-- <div class="form-group">
                <label for="semestre">Semestre:</label>
                <select id="semestre" name="semestre">
                    <option value="">Sélectionner Semestre</option>
                    <?php foreach ($semestres as $semestre) : ?>
                        <option value="<?php echo $semestre['id_semestre']; ?>"><?php echo $semestre['nom_semestre']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div> -->
            <div class="form-group">
                <label for="niveau">Niveau:</label>
                <select id="niveau" name="niveau">
                    <option value="">Sélectionner Niveau</option>
                    <?php foreach ($niveaux as $niveau) : ?>
                        <option value="<?php echo $niveau['IdNiveau']; ?>"><?php echo $niveau['nivNom']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="description">Description:</label>
                <input type="text" id="description" name="description">
            </div>
            <button type="submit">Affecter</button>
        </form>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // JavaScript for additional functionalities can be added here
        });
    </script>
</body>
</html>

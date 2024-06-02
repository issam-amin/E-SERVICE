<?php

include '../../securite.php';

// For debugging: Print session variables
// print_r($_SESSION);

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
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <title>Interface Chef Depo</title>
    <style>
        .container{
            margin-top: 20px;
            display: flex;
            flex-wrap: wrap;
        }
        .header{
            flex: 1;
        }
        .main{
            margin-top: 7rem;
            margin-left: 7rem;
            margin-right: 3rem;
        }
      
       ol, ul{
           padding-left: 0;
        }
        .btn {
            width: 6.5em;
            height: 2.3em;
            margin: 0.5em; 
            color: white;
            border: none;
            border-radius: 0.625em;
            font-size: 20px;
            font-weight: bold;
            cursor: pointer;
            z-index: 1;
            overflow: hidden;
        }

        .btn:hover {
            color: black;
        }

        .btn:after {
            content: "";
            background: white;
            position: absolute;
            z-index: -1;
            left: -20%;
            right: -20%;
            top: 0;
            bottom: 0;
            transform: skewX(-45deg) scale(0, 1);
            transition: all 0.5s;
        }

        .btn-add {
            background-color: rgb(54, 165, 158);
            border: none;
            color: white;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin-bottom: 20px;
            cursor: pointer;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .alert {
            margin-top: 20px;
        }

    </style>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var alertBox = document.querySelector(".alert");
            if (alertBox) {
                setTimeout(function() {
                    alertBox.style.display = 'none';
                }, 5000); // hide after 5 seconds
            }
        });
    </script>
</head>
<body>
    
    <header class="header">
    <?php require_once '../navigations/navigation_chef.php';?>
    </header>
    <main class="main">
    <?php if (isset($_SESSION['message'])): ?>
        <div class="alert alert-<?= $_SESSION['msg_type'] ?>">
            <?= $_SESSION['message'] ?>
            <?php
            unset($_SESSION['message']);
            unset($_SESSION['msg_type']);
            ?>
        </div>
    <?php endif ?>
    
    <h1>Listes des modules</h1>
    <button class="btn-add"><a href="create.php" style="color: white; text-decoration: none;">Ajouter un module</a></button>
    <table class="table table-Warning table-striped table-hover text-center">
        
        <thead>
            <tr>
                <th scope="col"></th>
                <th scope="col">Module</th>
                <th scope="col">Specialite</th>
                <th scope="col">Action</th> <!-- Added new column for the button -->
            </tr>
        </thead>
        <tbody>
            <?php
            if(isset($_SESSION['dispModules'])){
                $counter = 1;
                foreach ($_SESSION['dispModules'] as $mod) {
                    if (isset($mod['Intitule']) && isset($mod['nom_specialite']) ) {
                        echo "<tr>";
                        echo "<th scope=\"row\">" . $counter . "</th>";
                        echo "<td>" . $mod['Intitule']. "</td>";
                        echo "<td>" . $mod['nom_specialite'] . "</td>";
                        echo "<td>";
                        echo "<a href=\"../../routing/routing.php?modsp=" . $mod['IdModule'] . "&action=update_success\" class=\"btn btn-primary\">Modifier</a>";
                        echo "<a href=\"affecter.php?id=" . $mod['IdModule'] . "&action=assign_success\" class=\"btn btn-success\">Affecter</a>";
                        echo "<a href=\"delete.php?id=" . $mod['IdModule'] . "&action=delete_success\" class=\"btn btn-secondary\">Supprimer</a>";
                        echo "</td>";
                        echo "</tr>";
                        $counter++;
                    }
                }
            } else {
                echo "<tr><td colspan='5'>No data available</td></tr>";
            }
            ?>
        </tbody>
    </table>

    </main>
    
</body>
</html>

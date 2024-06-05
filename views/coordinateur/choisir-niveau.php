<?php 
session_start();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <title>choisir niveau</title>
    <style>
        .btr {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f8f9fa;
        }
        .container {
            text-align: center;
        }
        .btn-semester {
            margin: 10px;
            width: 100px;
        }
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
        ol , ul{
            padding-left: 0;
        }
    </style>
</head>
<body>
    <header class="header">
    <?php require_once '../navigations/navigation_coor.php';?>
    </header>
    <div class="main">
    <div class="container-fluid">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h3 class="">Choix de Niveau</h3>
        </div>
    </div>
    <div class="mt-4">
            <?php
 

                if (isset($_SESSION['niveaux']) && !empty($_SESSION['niveaux'])) {
                    foreach ($_SESSION['niveaux'] as $niveau) {
                        echo '<a href="emplois.php?niveau=' . htmlspecialchars($niveau['IdNiveau']) . '" class="btn btn-primary btn-semester">' . htmlspecialchars($niveau['nivNom']) . '</a>';
                    }
                } else {
                    echo 'Pas de données disponibles';
                }
           ?>
        </div>
        <!-- <a href="emploi?choix=htmlspecialchars($niveau['IdNiveau'])" class="btn btn-primary btn-semester">Choisir</a>
        <button type="submit" class="btn btn-primary" style="background: rgba(81, 2, 8, 0.6); border: none;">Choisir</button> -->
    </form>
</div>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>


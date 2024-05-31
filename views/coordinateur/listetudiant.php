<?php
session_start();
include '../../securite.php';

if (isset($_POST['export_csv'])) {
    exportCsv($_SESSION['listesEtudiant']);
}

function exportCsv($data) {
    if (!empty($data)) {
        $filename = "etudiants_" . date('Ymd') . ".csv";
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        
        $output = fopen('php://output', 'w');
        fputcsv($output, ['ID', 'Noms', 'Prenoms', 'Notes']);

        foreach ($data as $Etudiants) {
            if (isset($Etudiants['valeurs'])) {
                fputcsv($output, [$Etudiants['IdEtudiant'], $Etudiants['Nom'], $Etudiants['Prenom'], $Etudiants['valeurs']]);
            }
        }
        
        fclose($output);
        exit();
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
    <title>Interface Coordinateur</title>
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
            width: 140px;
            height: 50px;
            background: linear-gradient(to top, #00154c, #12376e, #23487f);
            color: #fff;
            border-radius: 50px;
            border: none;
            outline: none;
            cursor: pointer;
            position: relative;
            overflow: hidden;
        }
        .btn span {
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: top 0.5s;
        }
        .btn-text-one {
            position: absolute;
            width: 100%;
            top: 50%;
            left: 0;
            transform: translateY(-50%);
        }
        .btn-text-two {
            position: absolute;
            width: 100%;
            top: 150%;
            left: 0;
            transform: translateY(-50%);
        }
        .btn:hover .btn-text-one {
            top: -100%;
        }
        .btn:hover .btn-text-two {
            top: 50%;
        }
        h1 {
            font-family: 'Times New Roman', Times, serif;
            font-weight: 500;
            color: hsla(237deg 74% 33% / 61%);
            text-align: center;
            font-size: 4rem;
            margin-bottom: 5rem;
        }
        .form-select{
            border-radius: 15px;
            padding: 1em;
            width: 75%;
            text-align: center;
        }
    </style>
</head>
<body>
    <header class="header">
        <?php require_once '../navigations/navigation_coor.php';?>
    </header>
    <main class="main">
        <h1>Tables des ETUDIANTS :</h1>
        <form action="" method="post">
            <table class="table table-warning table-striped table-hover text-center">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Noms</th>
                        <th scope="col">Prenoms</th>
                        <th scope="col">Notes</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (isset($_SESSION['listesEtudiant'])) {
                        $counter = 1;
                        foreach ($_SESSION['listesEtudiant'] as $Etudiants) {
                            if (isset($Etudiants['valeurs'])) {
                                $_SESSION['etudiantsids'] = $Etudiants['IdEtudiant'];
                                echo "<tr>";
                                echo "<th scope=\"row\">" . $counter . "</th>";
                                echo "<td>" . htmlspecialchars($Etudiants['Nom']) . "</td>";
                                echo "<td>" . htmlspecialchars($Etudiants['Prenom']) . "</td>";
                                echo "<td>" . htmlspecialchars($Etudiants['valeurs']) . "</td>";
                                echo "</tr>";
                                echo "<input type='hidden' name='etudiants[" . htmlspecialchars($Etudiants['IdEtudiant']) . "][id]' value='" . htmlspecialchars($Etudiants['IdEtudiant']) . "'>";
                                echo "<input type='hidden' name='etudiants[" . htmlspecialchars($Etudiants['IdEtudiant']) . "][pr]' value='" . htmlspecialchars($Etudiants['idprof']) . "'>";
                                echo "<input type='hidden' name='etudiants[" . htmlspecialchars($Etudiants['IdEtudiant']) . "][md]' value='" . htmlspecialchars($Etudiants['idmodule']) . "'>";
                                echo "<input type='hidden' name='etudiants[" . htmlspecialchars($Etudiants['IdEtudiant']) . "][note]' value='" . htmlspecialchars($Etudiants['valeurs']) . "'>";
                                $counter++;
                            } else {
                                echo "<tr><td colspan='5'>No data available</td></tr>";
                                break;
                            }
                        }
                    } else {
                        echo "<tr><td colspan='5'>No data available</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
            <button class="btn btn-primary" type="submit" name="valider" value="valider">Valider</button>
            <button class="btn btn-secondary" type="submit" name="export_csv" value="export_csv">Export CSV</button>
            <?php
            if (isset($_SESSION['message'])) {
                $message_type = isset($_SESSION['message_type']) ? $_SESSION['message_type'] : 'success';
                $alert_class = ($message_type == 'success') ? 'alert-success' : 'alert-danger';
                echo "<div class='alert $alert_class' role='alert' aria-label=close'>{$_SESSION['message']}</div>";
                unset($_SESSION['message']);
                unset($_SESSION['message_type']);
            }
            ?>
        </form>
    </main>
</body>
</html>
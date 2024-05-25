<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <title>Document</title>
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
        position: relative;
        z-index: 1;
        overflow: hidden;
        }

        button:hover {
        color: black;
        }

        button:after {
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

        button:hover:after {
        transform: skewX(-45deg) scale(1, 1);
        -webkit-transition: all 0.5s;
        transition: all 0.5s;
        }
        .inputnote {
            max-width: 7rem;
                border: none;
                outline: none;
                border-radius: 15px;
                padding: 1em;
                background-color: #ccc;
                box-shadow: inset 2px 5px 10px rgba(0,0,0,0.3);
                transition: 300ms ease-in-out;
                text-align: center;
                }

                .inputnote:focus {
                background-color: white;
                transform: scale(1.05);
                box-shadow: 13px 13px 100px #969696,
                            -13px -13px 100px #ffffff;
                }
                h1{
                    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
                    font-weight: 400;
                    margin-bottom: 2.5rem;
                }
    </style>
</head>
<body>
<header class="header">
    <?php require_once '../navigations/navigation_prof.php'; ?>
</header>
<main class="main">

<?php

    if (isset($_SESSION['message'])) {
        $message_type = isset($_SESSION['message_type']) ? $_SESSION['message_type'] : 'success';
        $alert_class = ($message_type == 'success') ? 'alert-success' : 'alert-danger';
        echo "<div class='alert $alert_class' role='alert' aria-label=close'>{$_SESSION['message']}</div>";
        unset($_SESSION['message']);
        unset($_SESSION['message_type']);
    }

?>


<h1>Tables des ETUDIANTS :</h1>
<form action="../../routing/routing.php" method="post"> <!-- Start the form here -->
   <table class="table table-Warning table-striped table-hover text-center">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Noms</th>
                <th scope="col">Prenoms</th>
                <th scope="col">Input</th> 
            </tr>
        </thead>
        <tbody>
            <?php
                if(isset($_SESSION['listesEtudiant'])){              

                    $counter = 1;
                    $hasValues = false;

                    foreach ($_SESSION['listesEtudiant'] as $Etudiants) {
                        if (isset($Etudiants['valeurs'])) {
                            $hasValues = true;
                            break;
                        }
                    }
                    
                    foreach ($_SESSION['listesEtudiant'] as $Etudiants) {

                            ;
                       
                        if (isset($Etudiants['valeurs'])) {
                            // var_dump($Etudiants['valeurs']);
                            // $_SESSION['checkvalues'] = $Etudiants['valeurs'];
                            $_SESSION['etudiantsids'] = $Etudiants['IdEtudiant'];
                           
                            echo "<tr>";
                            echo "<th scope=\"row\">" . $counter . "</th>";
                            echo "<td>" . htmlspecialchars($Etudiants['Nom']) . "</td>";
                            echo "<td>" . htmlspecialchars($Etudiants['Prenom']) . "</td>";
                            echo "<td>";
                            echo "<input type=\"hidden\" name=\"etudiants[" . htmlspecialchars($Etudiants['IdEtudiant']) . "][id]\" value=\"" . htmlspecialchars($Etudiants['IdEtudiant']) . "\">";
                            echo "<input min=\"0\" max=\"20\" type=\"number\" name=\"etudiants[" . htmlspecialchars($Etudiants['IdEtudiant']) . "][note]\" id=\"typeNumber\" class=\"inputnote\" value=\"" . htmlspecialchars($Etudiants['valeurs']) . "\">";
                            echo "</td>";
                            echo "</tr>";  
                           
                            $counter++;
                        }
                        else{
                            $_SESSION['etudiantsids'] = $Etudiants['IdEtudiant'];
                            echo "<tr>";
                            echo "<th scope=\"row\">" . $counter . "</th>";
                            echo "<td>" . htmlspecialchars($Etudiants['Nom']) . "</td>";
                            echo "<td>" . htmlspecialchars($Etudiants['Prenom']) . "</td>";
                            echo "<td>";
                            echo "<input type=\"hidden\" name=\"etudiants[" . htmlspecialchars($Etudiants['IdEtudiant']) . "][id]\" value=\"" . htmlspecialchars($Etudiants['IdEtudiant']) . "\">";
                            echo "<input min=\"0\" max=\"20\" type=\"number\" name=\"etudiants[" . htmlspecialchars($Etudiants['IdEtudiant']) . "][note]\" id=\"typeNumber\" class=\"inputnote\" placeholder=\"Note\">";
                            echo "</td>";
                            echo "</tr>"; 
                            $counter++;
                        }     
                      
                        echo "<input type=\"hidden\" name=\"etudiants[" . htmlspecialchars($Etudiants['IdEtudiant']) . "][id]\" value=\"" . htmlspecialchars($Etudiants['IdEtudiant']) . "\">";
                        
                    }
                    echo "</tbody>";
                    echo "</table>";
                    if ($hasValues) {
                        echo '<button type="submit" class="btn btn-success" name="Updatenote">Update</button>';
                    } else {
                        echo '<button type="submit" class="btn btn-primary" name="submitnote">Enregistrer</button>';
                    }
                
                } else {
                    echo "<tr><td colspan='5'>No data available</td></tr>";
                }
            ?>
     
    <!-- <?php
   echo '<button type="submit" class="btn btn-success" name="Updatenote">Update</button>';
   echo '<button type="submit" class="btn btn-primary" name="submitnote">Enregistrer</button>'; 



?>-->
</form>

</main>


</main>
</body>
</html>

<script>
    document.querySelector('form').addEventListener('submit', function(event) {
        var inputs = document.querySelectorAll('.inputnote');
        var allEmpty = true;
        
        inputs.forEach(function(input) {
            if (input.value.trim() !== '') {
                allEmpty = false;
            }
        });
        
        var clickedButton = document.activeElement;
        
        if (clickedButton.name === 'submitnote' && allEmpty) {
            event.preventDefault();
            alert('VEUILLEZ INSERER AU MOIS UNE NOTE');
        }
    });
</script>

  


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
        background: green;
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
        .input {
                border: none;
                outline: none;
                border-radius: 15px;
                padding: 1em;
                background-color: #ccc;
                box-shadow: inset 2px 5px 10px rgba(0,0,0,0.3);
                transition: 300ms ease-in-out;
                }

                .input:focus {
                background-color: white;
                transform: scale(1.05);
                box-shadow: 13px 13px 100px #969696,
                            -13px -13px 100px #ffffff;
                }
    </style>
</head>
<body>
<header class="header">
    <?php require_once '../navigations/navigation_prof.php';?>
</header>
<main class="main">
<h1>Tables des ETUDIANTS</h1>
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
            
        // var_dump($_SESSION);
                if(isset($_SESSION['listesEtudiant'])){
                    $counter = 1;
                    echo "<form action=\"your_form_handler.php\" method=\"post\">"; // Start the form
                    foreach ($_SESSION['listesEtudiant'] as $Etudiants) {
                        echo "<tr>";
                        echo "<th scope=\"row\">" . $counter . "</th>";
                        echo "<td>" . htmlspecialchars($Etudiants['Nom']) . "</td>";
                        echo "<td>" . htmlspecialchars($Etudiants['Prenom'])."</td>";
                        echo "<td>";
                        echo "<input type=\"text\" autocomplete=\"off\" name=\"note" . $counter . "\" class=\"input\" placeholder=\"NOTE\" />";
                        // echo "<input type=\"text\" name=\"idEtu" . $Etudiants['IdEtudiant'] . "\" class=\"form-control\" />";
                        echo "</td>";
                        echo "</tr>"; 
                        $counter++;
                    }
                    echo "</form>"; // End the form
                }
          
                 else {
                    echo "<tr><td colspan='5'>No data available</td></tr>";
                }

            ?>
        </tbody>
    </table>
    <button type="submit" class="btn">Submit</button></td></tr>

</main>
</body>
</html>



  


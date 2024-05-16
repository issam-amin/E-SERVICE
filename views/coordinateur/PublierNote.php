<?php
session_start();
include '../../securite.php';
// var_dump($_SESSION['niveaux']);
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
    </style>

</head>
<body>
    
    <header class="header">
    <?php require_once '../navigations/navigation_coor.php';?>
    </header>
    <main class="main">
        <h1>Liste des Professeurs :</h1>
       <!-- chois du prof  -->
    <!-- <form action="../../routing/routing.php?act" method="POST"> -->
            <!-- <?php
        
        
                    if(isset($_SESSION['notes'])){
                        echo "<select class=\"form-select\" id=\"niveauSelect\" onchange=\"showId()\">";
                        foreach ($_SESSION['notes'] as $note) {
                            if (isset($note['Nom']) && isset($note['PRENOM'])) {  // Ensure the necessary keys exist
                                echo "<option value='" . $note['Nom'] . "'>" . $note['Nom'] . " " . $note['PRENOM'] . "</option>";
                            }
                        }
                        echo "</select>";
                        echo "<br><br>";
                    }
                    else{
                        echo "no data";
                    }
            ?> -->
    <table class="table table-Warning table-striped table-hover text-center">
                <thead>
            <tr>
                <th scope="col"></th>
                <th scope="col">Nom</th>
                <th scope="col">Prenom</th>
                <!-- <th scope="col">Modules</th> -->
                <th scope="col">Action</th> <!-- Added new column for the button -->
            </tr>
        </thead>
        <tbody>
            <?php
        
                if(isset($_SESSION['profs'])){
                    $counter = 1;
                    //var_dump($_SESSION['profs']);
                    foreach ($_SESSION['profs'] as $note) {
                        $professor_id=$note['IdProf'];
                        //  var_dump( $_SESSION['modules_profs']);

                        if (isset($note['Nom']) && isset($note['PRENOM']) && isset($note['IdProf']) ) {
                                echo "<tr>";
                                echo "<th scope=\"row\">" . $counter . "</th>";
                                echo "<td>" . $note['Nom'] . "</td>";
                                echo "<td>" . $note['PRENOM'] . "</td>";
                                echo "<td>";
                                echo "<a href=\"../../routing/routing.php?id=" . $note['IdProf'] . "\" class=\"btn btn-primary\">Modules</a>";
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
        
        <!-- <button type="button" class="btn btn-danger" value="reclamer" >Reclamer</button>
        <button type="button" class="btn btn-success" value="valider">Valider</button> -->
   
    <!-- </form> -->
            

    </main>
    

    
</body>
</html>
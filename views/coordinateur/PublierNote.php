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
 background: gray;
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
        <h1>Liste des Notes</h1>
       <!-- chois du prof  -->
    <label >Choix du prof:</label>
    <form action="../../routing/routing.php" method="POST">

            <?php
        
        
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
            ?>
    <button type="submit" class="btn" >Valider</button>        
    </form>
            

    </main>
    

    
</body>
</html>
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
            display: flex;
            flex-direction: column;
            justify-content: center;
            border-radius: 2.5rem;
            border-radius: 35px;
  box-shadow: rgba(50, 50, 93, 0.25) 0px 50px 100px -20px, rgba(0, 0, 0, 0.3) 0px 30px 60px -30px, rgba(10, 37, 64, 0.35) 0px -2px 6px 0px inset;
  padding: 2.5rem;          
  /* margin-top: 20px;
            display: flex;
            flex-wrap: wrap; */
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
        
        h1 
        {
            font-family: 'Times New Roman', Times, serif;
            font-weight: 500;
            color: hsla(237deg 74% 33% / 61%);
            text-align: center;
            font-size: 4rem;
            margin-bottom: 2rem;
        }
        .input-group-text{
            width: 20rem;
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
    <?php require_once '../navigations/navigation_chef.php';?>
    </header>
    <main class="main">
    


        <h1>Modifier :</h1>
        
        <form class="shadow-sm" action="../../routing/routing.php" method="POST">
            <div class="container">
  <div class="mb-4">
    <label  class="form-label" style="font-weight: 500; font-size:50px ;font-family : poppins">Module</label>
    <?php

if (isset($_SESSION['nomMod']) && is_array($_SESSION['nomMod'])) {
    foreach ($_SESSION['nomMod'] as $index => $var) {
        echo "<input class=\"input-group-text\" type='text' name='nomMod[$index]' value='" . htmlspecialchars($var, ENT_QUOTES, 'UTF-8') . "' />";
    }
} else {
    echo "No modules available";
}


?>


  </div>
  <div class="mb-3">
  <?php
            if (isset($_SESSION['specilities'])) {
                // var_dump($_SESSION['specilities']);
                echo "<select class=\"form-select\" name=\"selectsp\" id=\"selectsp\" aria-label=\"Sélectionnez La specialite\">";
                foreach ($_SESSION['specilities'] as $sp) {
                    echo "<option value='" . $sp['id_specialite'] . "'>" . $sp['nom_specialite'] . "</option>";
                    
                }
                echo "</select>";
            } 
            else {
                echo "Pas de données disponibles";
            }
        ?>
  </div>
  
  <button type="submit" name="modifSp" class="btn btn-primary">Modifier</button>

</form>  
</div>
    </main>
    
</body>
</html>
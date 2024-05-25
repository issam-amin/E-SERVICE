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
       
h1
{
    font-family: 'Times New Roman', Times, serif;
    font-weight: 500;
    color: rgba(41, 28, 5,0.6);
    text-align: center;
    font-size: 4rem;
    margin-bottom: 5rem;
}
.form-select{
    flex:1 ;
    border-radius: 15px;
    padding: 1em;
    width: 50%;
    text-align: center;
} 
  
  </style>

</head>
<body>
    
    <header class="header">
    <?php require_once '../navigations/navigation_coor.php';?>
    </header>
    <main class="main">
    

        <h1>Selectionner Niveau :</h1>

    <form class="mt-3 p-3 border rounded shadow-sm" action="../../routing/routing.php" method="POST">
    <div class="mb-3">
        <label for="ModulduNiv" class="form-label">Sélectionnez un niveau :</label>
        <?php
            if (isset($_SESSION['niveaux'])) {
                echo "<select class=\"form-select\" name=\"ModulduNiv\" id=\"ModulduNiv\" aria-label=\"Sélectionnez un niveau\">";
                foreach ($_SESSION['niveaux'] as $niveau) {
                    echo "<option value='" . $niveau['IdNiveau'] . "'>" . $niveau['nivNom'] . "</option>";
                }
                echo "</select>";
            } else {
                echo "Pas de données disponibles";
            }
        ?>
    </div>
    <button type="submit" class="btn btn-primary" style="background: rgba(41, 28, 5,0.6); border:none">Sélectionner</button>       
   </form>
    
    </main>
    <!-- <script>
function redirectToNiv() {
    var select = document.getElementById('niveauSelect');
    var selectedValue = select.value;
    window.location.href = "../../routing/routing.php?selectniv=" + selectedValue;
}
</script> -->
    <!-- <script>
function showId() {
     var select = document.getElementById('niveauSelect');
     var selectedId = select.options[select.selectedIndex].value;
     document.getElementById('selectedId').innerText = 'Selected ID: ' + selectedId;
}


</script> -->


    
</body>
</html>
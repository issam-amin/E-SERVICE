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

h1
{
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
        <h1>Selectionner Niveau :</h1>
        <form action="../../routing/routing.php" method="POST">
            
                <?php
                        if(isset($_SESSION['niveaux'])){
                            echo "<select class=\"form-select\" id=\"niveauSelect\" onchange=\"showId()\">";
                            foreach($_SESSION['niveaux'] as $niveau) {
                                echo "<option value='" . $niveau['IdNiveau'] . "'>" . $niveau['nivNom'] . "</option>";
                            }
                            echo "</select>";
                            echo "<br><br>";
                            echo "<div id='selectedId'></div>";
                        }
                        else{
                            echo "no data";
                        }
                ?>
      <!-- <button type="submit" class="btn btn-success" name="selcetniv">Select</button> -->
            <button class="btn" name="selcetniv">
                <span class="btn-text-one">Select</span>
                <span class="btn-text-two">Great!</span>
            </button>
    </form>       
    </main>

    <!-- <script>
function showId() {
     var select = document.getElementById('niveauSelect');
     var selectedId = select.options[select.selectedIndex].value;
     document.getElementById('selectedId').innerText = 'Selected ID: ' + selectedId;
}


</script> -->


    
</body>
</html>
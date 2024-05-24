<?php
session_start();
include '../../securite.php';
// var_dump($_SESSION['filieres']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
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
        ol , ul{
            padding-left: 0;
        }
        table{
           text-align: center;
        }
       

    </style>
</head>
<body>
    
<header class="header">
    <?php require_once '../navigations/navigation_coor.php';?>
    </header>
    <main class="main">

      
        <h1 style="margin-bottom: 2rem;">Liste Des Modules :</h1>
         <table class="table table-Secondary table-striped table-hover table-bordered">
                <thead>
                <tr class="table-dark">
                    <th>Modules</th>
                    <th>Note</th>
                </tr>
                </thead>
            <tbody>
            <?php
                if (isset($_SESSION['mod1Etu'])) {
                    foreach ($_SESSION['mod1Etu'] as $module) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($module['Intitule']) . "</td>";
                        echo "<td>" . htmlspecialchars($module['valeurs']) . "</td>";
                    }
                }else{
                    echo "no data";
                }
                    ?>
            </tbody>
            </tbody>
        </table>
        </form>

    </main>
  
        
  


    
</body>
</html>
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
    </style>
</head>
<body>
<header class="header">
    <?php require_once '../navigations/navigation_coor.php';?>
</header>
<main class="main">
<h1>Tables des Modules</h1>
        <table class="table table-Warning table-striped table-hover text-center">
                <thead>
            <tr>
                <th scope="col"></th>
                <th scope="col">Modules</th>
                <th scope="col">Prof</th>
                <th scope="col">Action</th> 
            </tr>
        </thead>
        <tbody>
            <?php
            
       
                if(isset($_SESSION['list_modul_niv'])){
                    $counter = 1;                  
                            // var_dump( $_SESSION['list_modul_niv']);
                            foreach ($_SESSION['list_modul_niv'] as $module) {
                                $_SESSION['id_Module']=$module['IdModule'];
                                $_SESSION['id_Prof']=$module['IdProf'];
                                echo "<tr>";
                                echo "<th scope=\"row\">" . $counter . "</th>";
                                echo "<td>" . $module['Intitule'] . "</td>";
                                echo "<td>" . $module['Nom'] ."  ". $module['Prenom']."</td>";
                                echo "<td>";
                                echo "<a href=\"../../routing/routing.php?niveau=" . $module['IdNiveau']."&module=" . $module['IdModule'] ."&prof=" . $module['IdProf'] . "\" class=\"btn btn-secondary\">Notes</a>";
                            
                                echo "</td>";
                                echo "</tr>"; 
                                $counter++;
                        }
                       
                        
                    
                    }
                
        
                    
                    
                //  else {
                //     echo "<tr><td colspan='5'>No data available</td></tr>";
                // }
            ?>
            
        </tbody>
    </table>
   
</main>
</body>
</html>



  


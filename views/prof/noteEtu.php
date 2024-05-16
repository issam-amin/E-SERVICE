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
        .main{
            margin-top: 7rem;
            margin-left: 7rem;
            margin-right: 7rem;
        }
        .input1{
            margin-left: 7rem;
        }
        ol,ul{
            padding: 0;
        }
    </style>
</head>
<body>
<header class="header">
    <?php require_once '../navigations/navigation_prof.php';?>
</header>
<main class="main">
<h1>Tables des Modules</h1>
        <table class="table table-Warning table-striped table-hover text-center">
                <thead>
            <tr>
                <th scope="col"></th>
                <th scope="col">Modules</th>
                <th scope="col">Action</th> 
            </tr>
        </thead>
        <tbody>
            <?php
            
        // var_dump($_SESSION);
                if(isset($_SESSION['modules_Specifique_Prof'])){
                    $counter = 1;                  
                            // var_dump( $_SESSION['modules_Specifique_Prof']);
                        

                           
                            foreach ($_SESSION['modules_Specifique_Prof'] as $module) {
                                $_SESSION['IdModule']=$module['IdModule'];
                                var_dump($_SESSION['IdModule']);
                                echo "<tr>";
                                echo "<th scope=\"row\">" . $counter . "</th>";
                                echo "<td>" . $module['Intitule'] . "</td>";
                                echo "<td>";
                                echo "<a href=\"../../routing/routing.php?listetu=" . $module['IdModule'] . "\" class=\"btn btn-secondary\">Notes</a>";
                            
                                echo "</td>";
                                echo "</tr>";
                                $counter++;
                        }
                       
                        
                    
                    }
                
        
                    
                    
                 else {
                    echo "<tr><td colspan='5'>No data available</td></tr>";
                }
            ?>
        </tbody>
    </table>
   
</main>
</body>
</html>



  


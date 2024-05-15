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
            margin-right: 10rem;
        }
        .input1{
            margin-left: 7rem;
        }
    </style>
</head>
<body>
<header class="header">
    <?php require_once '../navigations/navigation_prof.php';?>
    <?php session_start();?>
</header>
<main class="main">
            <div class="input1">
            <strong>list</strong>
            <select name="choices" >
                <option value="GI1">GI1</option>
                <option value="GI2">GI2</option>
                <option value="TDIA1">TDIA1</option>
            </select>
            </div>
<div class="container mt-5">
        <table class="table col-md-offset-3 ">
                <thead>
                <tr>
                    <th>Prenom</th>
                    <th>Nom</th>
                    <th>Email</th>
                    <th>IdFiliere</th>
                </tr>
                </thead>
            <tbody>
                <?php 

                 
                    foreach ($_SESSION['results'] as $etudiant) { 
                        echo "<tr>";
                        echo "<td>".$etudiant['Prenom']."</td>";
                        echo "<td>".$etudiant['Nom']."</td>";
                        echo "<td>".$etudiant['Email']."</td>";
                        echo "<td>".$etudiant['IdFiliere']."</td>";
                        echo "</tr>";
                    }
                    ?>
            </tbody>
            </tbody>
        </table>


</main>
</body>
</html>



  


<?php
include '../../securite.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Interface Etudiant</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f2f5;
            color: #333;
            margin: 0;
            padding: 0;
        }
        .container {
            margin-top: 20px;
            display: flex;
            flex-wrap: wrap;
        }
        .header {
            flex: 1;
            background-color: #4CAF50;
            color: white;
            padding: 10px 0;
            text-align: center;
        }
        .main {
            margin: 2rem auto;
            padding: 1rem;
            max-width: 80%;
            background-color: white;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            font-size: 1em;
            min-width: 400px;
        }
        table thead tr {
            background-color: #009879;
            color: #ffffff;
            text-align: left;
        }
        table th, table td {
            padding: 12px 15px;
        }
        table tbody tr {
            border-bottom: 1px solid #dddddd;
        }
        table tbody tr:nth-of-type(even) {
            background-color: #f3f3f3;
        }
        table tbody tr:last-of-type {
            border-bottom: 2px solid #009879;
        }
        table tbody tr.active-row {
            font-weight: bold;
            color: #009879;
        }
    </style>
</head>
<body>
    <header class="header">
        <?php include '../navigations/navigation_etu.php'; ?>
    </header>
    <main class="main">
        <?php 
 
        $modnote = $_SESSION['modSPEtu'];
        $grades=array();
       $count=0;
        ?>
        <table id="gradesTable">
        <thead>
                <tr>
                    <th>Module</th>
                    <th>Note</th>
                </tr>
            </thead>
            <tbody>
                <?php  foreach ($modnote as $modSPEtu): ?>
                <tr>
                    <td><?php echo htmlspecialchars($modSPEtu['Intitule']); ?></td>
                    <td><?php echo htmlspecialchars($modSPEtu['valeurs']);$grades[$count++]=$modSPEtu['valeurs'] ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <?php 
         
        //  var_dump($grades) ;
         $average = count($grades) ? array_sum($grades) / count($grades) : 0;
        ?>
        <p>Moyenne Note : <span id="averageGrade"><?php echo number_format($average, 2); ?></span></p>
    </main>
</body>
</html>


</html>

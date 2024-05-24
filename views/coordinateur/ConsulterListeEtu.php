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
        a {
  border: none;
  background: none;
  cursor: pointer;
}

a span {
  padding-bottom: 7px;
  letter-spacing: 4px;
  font-size: 14px;
  padding-right: 15px;
  text-transform: uppercase;
}

a svg {
  transform: translateX(-8px);
  transition: all 0.3s ease;
}

.cta:hover svg {
  transform: translateX(0);
}

.cta:active svg {
  transform: scale(0.9);
}

.hover-underline-animation {
  position: relative;
  color: black;
  padding-bottom: 20px;
}

.hover-underline-animation:after {
  content: "";
  position: absolute;
  width: 100%;
  transform: scaleX(0);
  height: 2px;
  bottom: 0;
  left: 0;
  background-color: #000000;
  transform-origin: bottom right;
  transition: transform 0.25s ease-out;
}

.cta:hover .hover-underline-animation:after {
  transform: scaleX(1);
  transform-origin: bottom left;
}

    </style>
</head>
<body>
    
<header class="header">
    <?php require_once '../navigations/navigation_coor.php';?>
    </header>
    <main class="main">
    <div >
      
        <h1 style="margin-bottom: 2rem;">Liste Etudiants :</h1>
         <table class="table table-Secondary table-striped table-hover table-bordered">
                <thead>
                <tr class="table-dark">
                    <th>Prenom</th>
                    <th>Nom</th>
                    <th>Action</th>
                    
                </tr>
                </thead>
            <tbody>
            <?php
                if (isset($_SESSION['list_etu_co'])) {
                    foreach ($_SESSION['list_etu_co'] as $etudiant) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($etudiant['Prenom']) . "</td>";
                        echo "<td>" . htmlspecialchars($etudiant['Nom']) . "</td>";
                        ?>
                        <!-- BUTTON -->
                        <td>
                            <form action="../../routing/routing.php" method="GET">
                                
                            <!-- <input type="hidden" name="id" value="<?php echo htmlspecialchars($etudiant['IdEtudiant']); ?>"> -->
                            <a href="../../routing/routing.php?detail=<?php echo htmlspecialchars($etudiant['IdEtudiant']); ?>" >
                            <!-- <button class="cta" type="submit" name="detail"> -->
                                    <span class="hover-underline-animation">Plus de details</span>
                                    <svg id="arrow-horizontal" xmlns="http://www.w3.org/2000/svg" width="30" height="10" viewBox="0 0 46 16">
                                        <path id="Path_10" data-name="Path 10" d="M8,0,6.545,1.455l5.506,5.506H-30V9.039H12.052L6.545,14.545,8,16l8-8Z" transform="translate(30)"></path>
                                    </svg>
                                <!-- </button> -->
                            </a>
                            </form>
                        </td>
                        <?php
                        echo "</tr>";
                    }
                }else{
                    echo "no data";
                }
                    ?>
            </tbody>
            </tbody>
        </table>
        </form>
</div>   
    </main>
  
        
  


    
</body>
</html>
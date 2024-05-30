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
        .cta {
            padding:3 rem;
            width: 10.5em;
        height: 2.3em;
        margin: 0.5em; 
  position: relative;
  margin: 0;
  padding: 0.8em 1em;
  outline: none;
  text-decoration: none;
  display: flex;
  justify-content: center;
  align-items: center;
  cursor: pointer;
  border: none;
  text-transform: uppercase;
  background-color: #333;
  border-radius: 10px;
  color: #fff;
  font-weight: 300;
  font-size: 18px;
  font-family: inherit;
  z-index: 0;
  overflow: hidden;
  transition: all 0.3s cubic-bezier(0.02, 0.01, 0.47, 1);
}

.cta:hover {
  animation: sh0 0.5s ease-in-out both;
}

@keyframes sh0 {
  0% {
    transform: rotate(0deg) translate3d(0, 0, 0);
  }

  25% {
    transform: rotate(7deg) translate3d(0, 0, 0);
  }

  50% {
    transform: rotate(-7deg) translate3d(0, 0, 0);
  }

  75% {
    transform: rotate(1deg) translate3d(0, 0, 0);
  }

  100% {
    transform: rotate(0deg) translate3d(0, 0, 0);
  }
}

.cta:hover span {
  animation: storm 0.7s ease-in-out both;
  animation-delay: 0.06s;
}

.cta::before,
.cta::after {
  content: '';
  position: absolute;
  right: 0;
  bottom: 0;
  width: 100px;
  height: 100px;
  border-radius: 50%;
  background: #fff;
  opacity: 0;
  transition: transform 0.15s cubic-bezier(0.02, 0.01, 0.47, 1), opacity 0.15s cubic-bezier(0.02, 0.01, 0.47, 1);
  z-index: -1;
  transform: translate(100%, -25%) translate3d(0, 0, 0);
}
.cta:hover::before,
.cta:hover::after {
  opacity: 0.15;
  transition: transform 0.2s cubic-bezier(0.02, 0.01, 0.47, 1), opacity 0.2s cubic-bezier(0.02, 0.01, 0.47, 1);
}

.cta:hover::before {
  transform: translate3d(50%, 0, 0) scale(0.9);
}

.cta:hover::after {
  transform: translate(50%, 0) scale(1.1);
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
        <div class="table-responsive">
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
                            <a href="../../routing/routing.php?detail=<?php echo htmlspecialchars($etudiant['IdEtudiant']); ?>" class="cta btn">
                                    <span class="hover-underline-animation">Plus de details</span>    
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
        </div>
        </form>
</div>   
    </main>
  
        
  


    
</body>
</html>
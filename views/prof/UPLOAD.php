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
    <title>upload page</title>
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
 width: 7.5em;
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
    <?php require_once '../navigations/navigation_prof.php';?>
</header>
<main class="main">
<h2>Upload Cours-Td-Tp </h2>
<?php
    if (isset($_SESSION['message'])) {
        echo "<div class='alert alert-info alert-dismissible' role='alert'>
                {$_SESSION['message']}
                <input type='button' class='btn-close close' data-bs-dismiss='alert' aria-label='Close'>

              </div>";
        unset($_SESSION['message']); // Clear the message after displaying it
    }
    ?>
            
            <form action="../../routing/routing.php" method="POST" enctype="multipart/form-data">
                <div class="mb-3">
                        <input type="file" class="form-control" name="file" id="file">                        
                <button type="submit" class="btn btn-primary" name="Upload">Upload file</button>
                </div>
            </form>
    
</main>
</body>
</html>



  



 
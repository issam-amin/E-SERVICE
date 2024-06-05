
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!----======== CSS ======== -->
    <style>
       <?php include '../navigations/sidebar.css';?>
    </style>
    <!----===== Boxicons CSS ===== -->
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
    
    <!--<title>Dashboard Sidebar Menu</title>--> 
</head>
<body>


    <header class="topBar">
        <div class="group">
            <svg class="icon1" aria-hidden="true" viewBox="0 0 24 24"><g><path d="M21.53 20.47l-3.66-3.66C19.195 15.24 20 13.214 20 11c0-4.97-4.03-9-9-9s-9 4.03-9 9 4.03 9 9 9c2.215 0 4.24-.804 5.808-2.13l3.66 3.66c.147.146.34.22.53.22s.385-.073.53-.22c.295-.293.295-.767.002-1.06zM3.5 11c0-4.135 3.365-7.5 7.5-7.5s7.5 3.365 7.5 7.5-3.365 7.5-7.5 7.5-7.5-3.365-7.5-7.5z"></path></g></svg>
            <input placeholder="Search" type="search" class="input">
          </div>

          <?php echo "<span class='name'>Bienvenue ".$_SESSION['Nom']." ".$_SESSION['Prenom']."</span>";?>    <div class="topBar_right ">
        <!--LOG OUT BUTTUN-->
        <a href="../../logout.php">
            <i class='bx bx-log-out icon' ></i>
        </a>
        <a href="#" >
            <svg class="svg_profil" xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 24 24" ><path d="M12 2a5 5 0 1 0 5 5 5 5 0 0 0-5-5zm0 8a3 3 0 1 1 3-3 3 3 0 0 1-3 3zm9 11v-1a7 7 0 0 0-7-7h-4a7 7 0 0 0-7 7v1h2v-1a5 5 0 0 1 5-5h4a5 5 0 0 1 5 5v1z"></path></svg>
        </a>
    </div>
    </header>
    <nav class="sidebar close">
        <header>
            <div class="image-text">
                <span class="image">
                    <!--<img src="logo.png" alt="">-->
                </span>

                <div class="text logo-text">
                    <span class="name">Espace  <br> Coordinateur</span>
                    <span class="profession">Menu</span>
                </div>
            </div>

            <i class='bx bx-chevron-right toggle'></i>

        </header>

        <div class="menu-bar">
            <div class="menu">
                <ul class="menu-links">
                    <li class="nav-link">
                        <!-- <a href="../../routing/routing.php?action=home"> -->
                        <a href="../coordinateur/interface_coor.php">
                            <i class='bx bx-home-alt icon' ></i>
                            <span class="text nav-text">Home</span>
                        </a>
                    </li>

                   
                    <li class="nav-link">
                        <a href="../../routing/routing.php?action=noteCoor">
                            <i class='bx bxs-graduation icon'></i>
                            <span class="text nav-text">Publier Notes</span>
                        </a>
                    </li>
                    <li class="nav-link">
                        <a href="../../routing/routing.php?action=module">
                            <i class='bx bx-git-pull-request icon'></i>
                            <span class="text nav-text">Consulter Notes <br> Modules</span>
                        </a>
                    </li>
                

                    <li class="nav-link">
                        <a href="../../routing/routing.php?action=emploi">
                        <i class='bx bx-calendar icon'></i>
                         <span class="text nav-text">Gestion Emploi</span>
                        </a>
                    </li>

                    <li class="nav-link">
                        <a href="#">
                            <i class='bx bx-bell icon'></i>
                            <span class="text nav-text">Notifications</span>
                        </a>
                    </li>

                </ul>
            </div>

            <div class="bottom-content">
                <li class="">
                    <a href="../../logout.php">
                        <i class='bx bx-log-out icon' ></i>
                        <span class="text nav-text">Logout</span>
                    </a>
                </li>

                <li class="mode">
                    <div class="sun-moon">
                        <i class='bx bx-moon icon moon'></i>
                        <i class='bx bx-sun icon sun'></i>
                    </div>
                    <span class="mode-text text">Dark mode</span>

                    <div class="toggle-switch">
                        <span class="switch"></span>
                    </div>
                </li>
                
            </div>
        </div>

    </nav>

    <!-- <section class="home">
        <div class="text">Professeur</div>
    </section> -->

    <script>
        const body = document.querySelector('body'),
      sidebar = body.querySelector('nav'),
      toggle = body.querySelector(".toggle"),
      modeSwitch = body.querySelector(".toggle-switch"),
      modeText = body.querySelector(".mode-text");
      topBar = body.querySelector(".topBar");
      omar = body.querySelector(".svg_profil");
      logOut = body.querySelector(".bx-log-out");
      topBarname = body.querySelector(".name");


toggle.addEventListener("click" , () =>{
    sidebar.classList.toggle("close");
})



modeSwitch.addEventListener("click" , () =>{
    body.classList.toggle("dark");
    
    if(body.classList.contains("dark")){
        modeText.innerText = "Light mode";
        topBar.classList.toggle("topBarDark");
        omar.classList.toggle("svg_profil_dark");
        logOut.classList.toggle("bx-log-out_dark");
        topBarname.classList.toggle("name_dark");
    }else{
        modeText.innerText = "Dark mode";
        topBar.classList.toggle("topBarDark");
        omar.classList.toggle("svg_profil_dark");
        logOut.classList.toggle("bx-log-out_dark");
        topBarname.classList.toggle("name_dark");
    }
});
    </script>

</body>
</html>

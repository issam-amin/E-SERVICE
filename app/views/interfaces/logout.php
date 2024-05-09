<?php
session_start();
session_destroy();

header('Location: ../interfaces/login.php');
session_unset();
/*echo "SALAM";*/
?>
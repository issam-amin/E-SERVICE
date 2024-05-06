<?php
session_start();
session_destroy();
session_unset();
header('Location: ../interfaces/login.php');
/*echo "SALAM";*/
?>
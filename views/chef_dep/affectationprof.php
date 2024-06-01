<?php
include 'connect.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_module = intval($_POST['id_module']);
    $id_prof = $_POST['professor'];
    $id_niveau = $_POST['niveau'];
    var_dump($id_module);
    // $id_semestre = $_POST['semestre'];
    // $description = $_POST['description'];

    try {
        $sql = "UPDATE module 
        SET IdProf = :professor, 
            IdNiveau = :idniveau 
        WHERE IdModule = :id_module";

$stmt = $pdo->prepare($sql);
$stmt->bindParam(':professor', $id_prof, PDO::PARAM_INT);
$stmt->bindParam(':idniveau', $id_niveau, PDO::PARAM_INT);
$stmt->bindParam(':id_module', $id_module, PDO::PARAM_INT);

$stmt->execute();

    


    
        // $sql = "SELECT email, nom, prenom FROM professor WHERE id = :id_prof";
        // $stmt = $pdo->prepare($sql);
        // $stmt->execute(['id_prof' => $id_prof]);
        // $prof = $stmt->fetch(PDO::FETCH_ASSOC);

        
        // $sql = "SELECT nom_module FROM module WHERE IdModule= :id_module";
        // $stmt = $pdo->prepare($sql);
        // $stmt->execute(['id_module' => $id_module]);
        // $module = $stmt->fetch(PDO::FETCH_ASSOC);

        // // function getIdUser  then search the id_chef_dep, then select his email 
        // $sql = "SELECT Email FROM chefdep WHERE Iduser= :id_user";
        // $stmt = $pdo->prepare($sql);
        // $stmt->execute(['id_user' => $_SESSION['id_user']]);
        // $chefDepartement = $stmt->fetch(PDO::FETCH_ASSOC);

        // if ($prof && $module && $chefDepartement) {
        //     $nom_module = $module['nom_module'];
        //     $to = $prof['email'];
        //     $subject = "Nouveau module affecté";
        //     $message = "Mr. " . $prof['Nom'] . " " . $prof['Prenom'] . ",\n\nVous avez été affecté au module: $nom_module avec la description: $description";
        //     $headers = "From: " . $chefDepartement['Email'];

        //     // Send the email
        //     mail($to, $subject, $message, $headers);
        // }

        // Redirect to a display page
        header("Location:../../routing/routing.php?action=Gestiondemodule");
        exit();
    } catch (PDOException $e) {
        echo "Erreur: " . $e->getMessage();
    }
} else {
    echo "Méthode de requête non valide.";
    exit();
}

?>

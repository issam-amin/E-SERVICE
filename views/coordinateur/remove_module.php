<?php
require_once 'include/db-connection.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);

    if (isset($data['moduleId'], $data['day'], $data['timeSlot'], $data['semestre'])) {
        $moduleId = $data['moduleId'];
        $day = array_search($data['day'], ['Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi']) + 1;
        $timeSlot = $data['timeSlot'];
        $filiereId = $_SESSION['filiere_id'];
        $semestre = $data['semestre'];

        // Remove the module from the timetable
        $stmt = $conn->prepare("
            DELETE FROM emplois_de_temps
            WHERE filiere_id = ? AND semestre = ? AND day = ? AND time_slot = ? AND module_id = ?
        ");
        $stmt->execute([$filiereId, $semestre, $day, $timeSlot, $moduleId]);

        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Invalid data']);
    }
}
?>

<?php
require_once 'include/db-connection.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);

    if (isset($data['changes'])) {
        foreach ($data['changes'] as $change) {
            $moduleId = $change['moduleId'];
            $day = array_search($change['day'], ['Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi']) + 1;
            $timeSlot = $change['timeSlot'];
            $startTime = $change['startTime'];
            $endTime = $change['endTime'];
            $filiereId = $_SESSION['filiere_id'];
            $semestre = $_SESSION['semestre'];

            if ($moduleId) {
                // Insert or update the module in the timetable
                $stmt = $conn->prepare("
                    INSERT INTO emplois_de_temps (filiere_id, semestre, day, time_slot, start_time, end_time, module_id)
                    VALUES (?, ?, ?, ?, ?, ?, ?)
                    ON DUPLICATE KEY UPDATE module_id = VALUES(module_id), start_time = VALUES(start_time), end_time = VALUES(end_time)
                ");
                $stmt->execute([$filiereId, $semestre, $day, $timeSlot, $startTime, $endTime, $moduleId]);
            } else {
                // Remove the module from the timetable
                $stmt = $conn->prepare("
                    DELETE FROM emplois_de_temps
                    WHERE filiere_id = ? AND semestre = ? AND day = ? AND time_slot = ?
                ");
                $stmt->execute([$filiereId, $semestre, $day, $timeSlot]);
            }
        }

        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Invalid data']);
    }
}
?>

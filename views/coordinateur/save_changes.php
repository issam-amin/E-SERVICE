<?php
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . '\WEB_PROJECT\config\Database.php');
session_start();
require_once '../../controllers/ControllerCoordinateur.php';

$tst = new ControllerCoord;
$filie_id = $tst->getidCoo($_SESSION['IdUser']);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);

    if (isset($data['changes']) && is_array($data['changes'])) {
        try {
            foreach ($data['changes'] as $change) {
                $moduleId = $change['moduleId'];
                $day = array_search($change['day'], ['Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi']) + 1;
                $timeSlot = $change['timeSlot'];
                $startTime = $change['startTime'] ?? null;
                $endTime = $change['endTime'] ?? null;
                $idniv = $_SESSION['nivemp'];
                $filiereId = $filie_id;

                if ($moduleId) {
                    // Insert or update the module in the timetable
                    $stmt = $db->prepare("
                        INSERT INTO emplois_de_temps (filiereid, idniveau, day, time_slot, moduleid, startTime, endTime)
                        VALUES (?, ?, ?, ?, ?, ?, ?)
                        ON DUPLICATE KEY UPDATE moduleid = VALUES(moduleid), startTime = VALUES(startTime), endTime = VALUES(endTime)
                    ");
                    $stmt->execute([$filiereId, $idniv, $day, $timeSlot, $moduleId, $startTime, $endTime]);
                } else {
                    // Remove the module from the timetable
                    $stmt = $db->prepare("
                        DELETE FROM emplois_de_temps
                        WHERE filiereid = ? AND idniveau = ? AND day = ? AND time_slot = ?
                    ");
                    $stmt->execute([$filiereId, $idniv, $day, $timeSlot]);
                }
            }

            // Return success response as JSON
            echo json_encode(['success' => true]);
        } catch (Exception $e) {
            // Return error response as JSON
            echo json_encode(['success' => false, 'message' => 'Database error']);
        }
    } else {
        // Return invalid data response as JSON
        echo json_encode(['success' => false, 'message' => 'Invalid data']);
    }
}
?>

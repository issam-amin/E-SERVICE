<?php
session_start();
if (isset($_SESSION['Idrole']) && $_SESSION['Idrole'] == '3') {
    require_once(realpath($_SERVER["DOCUMENT_ROOT"]) .'\WEB_PROJECT\config\Database.php');
    // require_once '../../controllers/ControllerFiliere.php'
    require_once(realpath($_SERVER["DOCUMENT_ROOT"]) .'\WEB_PROJECT\controllers\ControllerFiliere.php');
    require_once(realpath($_SERVER["DOCUMENT_ROOT"]) .'\WEB_PROJECT\controllers\ControllerCoordinateur.php');
    require_once(realpath($_SERVER["DOCUMENT_ROOT"]) .'\WEB_PROJECT\controllers\ControllerModules.php');
    $tst=new ControllerCoord;
    $_SESSION['IdCoord']=$tst->getidCoo($_SESSION['IdUser']);

   
    $coord_id = $_SESSION['IdCoord'];
    // var_dump(intval($coord_id));
    $obj=new ControllerFiliere;
    $filiereId = $obj->getfilierCor(intval($coord_id));
    // $_SESSION['filiere_id'] = $filiereId;
    // $semestre = isset($_GET['semestre']) ? $_GET['semestre'] : null;
    $nivEMP=isset($_GET['niveau']) ? $_GET['niveau'] : null;
    $_SESSION['nivemp']=$_GET['niveau'];
    if ($nivEMP) {
        $_SESSION['nivemp'] = $nivEMP;
    } else {
        die('niveau not specified');
    }
    // var_dump($nivEMP);
    $obj1=new ControllerModules;
    $modules =$obj1->getModulesByNiveau($nivEMP);

    // Fetch existing timetable data
    global $db;
    $stmt = $db->prepare("
        SELECT et.day, et.time_slot, et.moduleid, m.idniveau
        FROM emplois_de_temps et
        JOIN module m ON et.moduleid = m.IdModule
        WHERE et.idniveau = ?
    ");
    // var_dump($filiereId);
    // var_dump($nivEMP);

    $stmt->execute([$nivEMP]);
    $timetableData = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Create an empty timetable structure
    $timetable = [];
    foreach (['Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi'] as $day) {
        for ($i = 0; $i < 4; $i++) {
            $timetable[$day][$i] = null;
        }
    }

    // Populate the timetable with existing data
    foreach ($timetableData as $entry) {
        $day = $entry['day'];
        $dayName = ['Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi'][$day - 1];
        $timetable[$dayName][$entry['time_slot']] = $entry['moduleid'];
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Emplois du Temps</title>
    <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        /* Your existing CSS styles */
        ol, ul{
            padding-left: 0;
        }
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #eef2f7;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        .navbar {
            background-color: #34495e;
            padding: 10px 20px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        .navbar a {
            color: #ecf0f1;
            font-size: 1.2rem;
            text-decoration: none;
        }
        .main {
            background: #f7f9fc;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            margin: 20px auto;
            max-width: 1200px;
        }
        .title {
            font-size: 2.5rem;
            margin-bottom: 20px;
            color: #2c3e50;
            text-shadow: 1px 1px 1px rgba(0, 0, 0, 0.1);
        }
        .timetable {
            width: 100%;
            border-collapse: separate;
            border-spacing: 5px;
            margin-bottom: 20px;
        }
        .timetable th,
        .timetable td {
            padding: 15px;
            text-align: center;
            border-radius: 4px;
            background: white;
            transition: background-color 0.3s;
        }
        .timetable th {
            background-color: #2980b9;
            color: white;
            font-weight: bold;
        }
        .timetable td {
            border: 2px solid #ddd;
        }
        .draggable {
            cursor: grab;
            border: 2px dashed #ccc;
            padding: 10px;
            margin: 5px;
            border-radius: 4px;
            background-color: #f0f0f0;
            transition: transform 0.3s, box-shadow 0.3s;
            position: relative;
        }
        .draggable:hover {
            transform: translateY(-3px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
        .droppable {
            border: 2px dashed #ddd;
            min-height: 80px;
            border-radius: 4px;
        }
        .droppable.over {
            background: #d0e8f2;
        }
        .card {
            margin-bottom: 10px;
            padding: 15px 20px;
            border-radius: 4px;
            cursor: grab;
            transition: all 0.2s ease-in-out;
            color: #fff;
            font-weight: bold;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            position: relative;
        }
        .card.bg-light-blue {
            background-color: #74b9ff;
        }
        .card.bg-light-green {
            background-color: #55efc4;
        }
        .card.bg-light-yellow {
            background-color: #ffeaa7;
        }
        .card.bg-light-red {
            background-color: #ff7675;
        }
        .card.bg-light-purple {
            background-color: #a29bfe;
        }
        .card:hover {
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
            transform: scale(1.05);
        }
        .btn-custom {
            font-size: 1.1rem;
            padding: 10px 20px;
            border-radius: 8px;
            margin: 5px;
            transition: background-color 0.3s, box-shadow 0.3s;
        }
        #save-changes {
            background-color: #28a745;
            border-color: #28a745;
        }
        #save-changes:hover {
            background-color: #218838;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
        #remove-module {
            background-color: #dc3545;
            border-color: #dc3545;
        }
        #remove-module:hover {
            background-color: #c82333;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
        #undo-changes {
            background-color: #ffc107;
            border-color: #ffc107;
        }
        #undo-changes:hover {
            background-color: #e0a800;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
        .main {
            margin-top: 2rem;
            margin-left: 10rem;
            margin-right: 6rem;
        }
        .close-btn {
            position: absolute;
            top: 5px;
            right: 10px;
            cursor: pointer;
            font-size: 1rem;
            color: #e74c3c;
        }
        .log {
            margin-top: 20px;
            padding: 15px;
            background: #f7f7f7;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
    </style>
</head>
<body>
    <header class="header">
        <?php require_once '../navigations/navigation_coor.php'; ?>
    </header>
    <main>
        <div class="main p-2 pl-2">
            <div class="container-fluid">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h3 class="">Emplois de temps</h3>
                </div>
                <div class="container">
                    <h1 class="my-4">Emploi de - <?php echo htmlspecialchars($nivEMP); ?></h1>
                    <table class="table table-bordered timetable">
                        <thead>
                        <tr>
                            <th></th>
                            <th>08:30-10:30</th>
                            <th>10:30-12:30</th>
                            <th>14:30-16:30</th>
                            <th>16:30-18:30</th>
                        </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($timetable as $day => $slots) {
                                echo "<tr>";
                                echo "<th>$day</th>";
                                for ($i = 0; $i < 4; $i++) {
                                    $moduleId = $slots[$i];
                                    if ($moduleId) {
                                        $module = array_filter($modules, function ($m) use ($moduleId) {
                                            return $m['IdModule'] == $moduleId;
                                        });
                                        $module = array_shift($module);
                                        $moduleName = htmlspecialchars($module['Intitule']);
                                        echo "<td class='droppable' data-day='$day' data-time-slot='$i'><div class='card draggable' data-id='$moduleId'>$moduleName</div></td>";
                                    } else {
                                        echo "<td class='droppable' data-day='$day' data-time-slot='$i'></td>";
                                    }
                                }
                                echo "</tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                    <div class="row">
                        <?php
                        $colors = ['bg-light-blue', 'bg-light-green', 'bg-light-yellow', 'bg-light-red', 'bg-light-purple'];
                        $colorIndex = 0;
                        foreach ($modules as $module) {
                            $colorClass = $colors[$colorIndex % count($colors)];
                            echo "<div class='col-md-3'>";
                            echo "<div class='card draggable $colorClass hover-shadow' draggable='true' data-id='{$module['IdModule']}'>{$module['Intitule']}";
                            echo "</div>";
                            echo "</div>";
                            $colorIndex++;
                        }
                        
                        ?>
                    </div>
                    <button id="save-changes" class="btn btn-success btn-custom">Save Changes</button>
                    <button id="undo-changes" class="btn btn-warning btn-custom">Undo Changes</button>
                    <div class="log" id="log"></div>
                </div>
            </div>
        </div>
    </main>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const draggables = document.querySelectorAll('.draggable');
        const droppables = document.querySelectorAll('.droppable');
        const logElement = document.getElementById('log');
        let changes = [];

        let initialState = Array.from(droppables).map(droppable => {
            const moduleId = droppable.querySelector('.draggable')?.dataset['moduleId'] || null;
            return {
                day: droppable.dataset.day,
                timeSlot: droppable.dataset.timeSlot,
                moduleId: moduleId
            };
        });

        draggables.forEach(draggable => {
            draggable.addEventListener('dragstart', () => {
                draggable.classList.add('dragging');
                dragging = draggable;
            });

            draggable.addEventListener('dragend', () => {
                draggable.classList.remove('dragging');
                dragging = null;
            });
        });

        droppables.forEach(droppable => {
            droppable.addEventListener('dragover', (e) => {
                e.preventDefault();
                droppable.classList.add('over');
            });

            droppable.addEventListener('dragleave', () => {
                droppable.classList.remove('over');
            });

            droppable.addEventListener('drop', (e) => {
                e.preventDefault();
                droppable.classList.remove('over');

                const dragging = document.querySelector('.dragging');
                if (dragging) {
                    if (droppable.querySelector('.draggable')) {
                        alert('Only one module per time slot is allowed.');
                        return;
                    }

                    const clone = dragging.cloneNode(true);
                    clone.classList.remove('dragging');

                    const closeButton = document.createElement('span');
                    closeButton.classList.add('close-btn');
                    closeButton.innerHTML = '&times;';
                    closeButton.addEventListener('click', () => {
                        clone.remove();
                        updateLog();
                    });
                    clone.appendChild(closeButton);

                    droppable.innerHTML = '';
                    droppable.appendChild(clone);
                    initializeDraggable(clone);

                    const day = droppable.dataset.day;
                    const timeSlot = droppable.dataset.timeSlot;
                    const moduleId = dragging.dataset.moduleId;

                    changes.push({
                        day: day,
                        timeSlot: timeSlot,
                        moduleId: moduleId
                    });

                    updateLog();
                }
            });
        });

        document.getElementById('save-changes').addEventListener('click', () => {
    if (changes.length > 0) { // Check if there are changes to be saved
        fetch('save_changes.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({ changes }),
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            if (data.success) {
                alert('Changes saved successfully');
            } else {
                alert('Failed to save changes. Please try again.');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred while saving changes');
        });
    } else {
        alert('No changes to save');
    }
});


        document.getElementById('undo-changes').addEventListener('click', function() {
            droppables.forEach(droppable => {
                const initialStateItem = initialState.find(state => state.day === droppable.dataset.day && state.timeSlot === droppable.dataset.timeSlot);
                if (initialStateItem.moduleId) {
                    const moduleCard = document.querySelector(`[data-module-id='${initialStateItem.moduleId}']`).cloneNode(true);
                    initializeDraggable(moduleCard);
                    moduleCard.classList.remove('dragging');

                    // Add the close button dynamically
                    const closeButton = document.createElement('span');
                    closeButton.classList.add('close-btn');
                    closeButton.innerHTML = '&times;';
                    closeButton.addEventListener('click', () => {
                        moduleCard.remove();
                        updateLog();
                    });
                    moduleCard.appendChild(closeButton);

                    droppable.innerHTML = '';
                    droppable.appendChild(moduleCard);
                } else {
                    droppable.innerHTML = '';
                }
            });
            updateLog();
        });

        function initializeDraggable(element) {
            element.addEventListener('dragstart', () => {
                element.classList.add('dragging');
            });

            element.addEventListener('dragend', () => {
                element.classList.remove('dragging');
            });

            const closeButton = element.querySelector('.close-btn');
            if (closeButton) {
                closeButton.addEventListener('click', () => {
                    element.remove();
                    updateLog();
                });
            }
        }

        draggables.forEach(draggable => initializeDraggable(draggable));

        function updateLog() {
            const currentState = Array.from(droppables).map(droppable => {
                const moduleId = droppable.querySelector('.draggable')?.dataset.id || 'None';
                return {
                    day: droppable.dataset.day,
                    timeSlot: droppable.dataset.timeSlot,
                    moduleId: moduleId
                };
            });

            logElement.innerHTML = '<h4>Current Timetable State:</h4><pre>' + JSON.stringify(currentState, null, 2) + '</pre>';
        }

        updateLog();
    });
    </script>
</body>
</html>


<?php
session_start();
if (isset($_SESSION['Idrole']) && $_SESSION['Idrole'] == '3') {
    require_once(realpath($_SERVER["DOCUMENT_ROOT"]) .'\WEB_PROJECT\config\Database.php');
    // require_once '../../controllers/ControllerFiliere.php';
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

    if ($nivEMP) {
        $_SESSION['NIVemp'] = $nivEMP;
    } else {
        die('niveau not specified');
    }
    // var_dump($nivEMP);
    $obj1=new ControllerModules;
    $modules =$obj1->getModulesByNiveau($nivEMP);

    // Fetch existing timetable data
    $stmt = $db->prepare("
        SELECT et.day, et.time_slot, et.moduleid, m.idniveau
        FROM emplois_de_temps et
        JOIN module m ON et.moduleid = m.IdModule
        WHERE et.idniveau = ?
    ");
    // var_dump($filiereId);
    var_dump($nivEMP);

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
        $timetable[$dayName][$entry['time_slot']] = $entry['module_id'];
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Emplois du Temps</title>
    <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        .main{
            margin-top: 7rem;
            margin-left: 15rem;
            margin-right: 10rem;
        }
        ol , ul{
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
    </style>
</head>
<body>
    <header class="header">
    <?php require_once '../navigations/navigation_coor.php';?>
    </header>
    <main>
    <div class="main p-2 pl-2">
        <div class="container-fluid">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h3 class="">Emplois de temps</h3>
            </div>
            <div class="container">
                <h1 class="my-4">Emploi de GI - <?php echo htmlspecialchars($nivEMP); ?></h1>
                <table class="table table-bordered timetable">
                    <thead>
                        <tr>
                            <th></th>
                            <th>8:30 - 10:30</th>
                            <th>10:30 - 12:30</th>
                            <th>14:30 - 16:30</th>
                            <th>16:30 - 18:30</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $days = ['Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi'];
                        foreach ($days as $day) {
                            echo "<tr>";
                            echo "<td>$day</td>";
                            for ($i = 0; $i < 4; $i++) {
                                $moduleId = $timetable[$day][$i];
                                $moduleName = $moduleId ? $modules[array_search($moduleId, array_column($modules, 'id'))]['nom'] : '';
                                echo "<td class='droppable' data-day='$day' data-time-slot='$i'>";
                                if ($moduleName) {
                                    $colorClass = 'bg-light-blue'; // Or any logic to assign colors
                                    echo "<div class='card draggable $colorClass hover-shadow' draggable='true' data-id='$moduleId'>$moduleName";
                                    echo "<span class='close-btn'>&times;</span>";
                                    echo "</div>";
                                }
                                echo "</td>";
                            }
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>

                <h3 class="my-4">Modules</h3>
                <div class="row">
                    <?php
                    $colors = ['bg-light-blue', 'bg-light-green', 'bg-light-yellow', 'bg-light-red', 'bg-light-purple'];
                    $colorIndex = 0;
                    foreach ($modules as $module) {
                        $colorClass = $colors[$colorIndex % count($colors)];
                        echo "<div class='col-md-3'>";
                        echo "<div class='card draggable $colorClass hover-shadow' draggable='true' data-id='{$module['IdModule']}'>{$module['Intitule']}</div>";
                        echo "</div>";
                        $colorIndex++;
                    }
                    ?>
                </div>

                <button id="save-changes" class="btn btn-success my-4">Save Changes</button>
                <button id="undo-changes" class="btn btn-warning my-4">Undo Changes</button>
            </div>
        </div>
    </div>
    </main>
</body>
<script>
        console.log("zzzzzzzzz");
document.onload = function() {

    const draggables = document.querySelectorAll('.draggable');
    const droppables = document.querySelectorAll('.droppable');
    let changes = [];
    let selectedModule = null;
    const originalState = Array.from(droppables).map(droppable => {
        const module = droppable.querySelector('.draggable');
        return module ? { moduleId: module.dataset.id, day: droppable.dataset.day, timeSlot: droppable.dataset.timeSlot } : {};
    });

    const initializeDraggable = (draggable) => {
        draggable.addEventListener('dragstart', (e) => {
            draggable.classList.add('dragging');
            e.dataTransfer.setData('text/plain', draggable.dataset.id);
        });

        draggable.addEventListener('click', (e) => {
            if (selectedModule) {
                selectedModule.classList.remove('selected');
            }
            selectedModule = draggable;
            selectedModule.classList.add('selected');
        });

        // Add close button functionality
        const closeButton = draggable.querySelector('.close-btn');
        if (closeButton) {
            closeButton.addEventListener('click', (e) => {
                e.stopPropagation();
                const moduleId = draggable.dataset.id;
                const droppable = draggable.parentElement;
                const day = droppable.dataset.day;
                const timeSlot = droppable.dataset.timeSlot;

                droppable.removeChild(draggable);
                changes.push({ moduleId: null, day, timeSlot });

                // AJAX call to remove module from database
                fetch('remove_module.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({ moduleId, day, timeSlot, semestre: <?php echo json_encode($semestre); ?> })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert('Module removed successfully');
                    } else {
                        alert('Failed to remove module. Please try again.');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('An error occurred while removing the module');
                });
            });
        }
    };

    draggables.forEach(draggable => initializeDraggable(draggable));

    droppables.forEach(droppable => {
        droppable.addEventListener('dragover', (e) => {
            e.preventDefault();
            droppable.classList.add('over');
        });

        droppable.addEventListener('dragleave', (e) => {
            droppable.classList.remove('over');
        });

        droppable.addEventListener('drop', (e) => {
            e.preventDefault();
            droppable.classList.remove('over');

            const moduleId = e.dataTransfer.getData('text/plain');
            const day = droppable.dataset.day;
            const timeSlot = droppable.dataset.timeSlot;

            // Ensure only one module per cell
            if (droppable.querySelector('.draggable')) {
                alert('Only one module per time slot is allowed.');
                return;
            }

            let startTime, endTime;
            switch (timeSlot) {
                case '0':
                    startTime = '08:30:00';
                    endTime = '10:30:00';
                    break;
                case '1':
                    startTime = '10:30:00';
                    endTime = '12:30:00';
                    break;
                case '2':
                    startTime = '14:30:00';
                    endTime = '16:30:00';
                    break;
                case '3':
                    startTime = '16:30:00';
                    endTime = '18:30:00';
                    break;
            }

            const moduleCard = document.querySelector(`[data-id='${moduleId}']`).cloneNode(true);
            initializeDraggable(moduleCard);
            moduleCard.addEventListener('click', (e) => {
                if (selectedModule) {
                    selectedModule.classList.remove('selected');
                }
                selectedModule = moduleCard;
                selectedModule.classList.add('selected');
            });

            const closeButton = document.createElement('span');
            closeButton.classList.add('close-btn');
            closeButton.innerHTML = '&times;';
            closeButton.addEventListener('click', () => {
                droppable.removeChild(moduleCard);
                changes.push({ moduleId: null, day, timeSlot });

                // AJAX call to remove module from database
                fetch('remove_module.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({ moduleId, day, timeSlot, semestre: <?php echo json_encode($semestre); ?> })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert('Module removed successfully');
                    } else {
                        alert('Failed to remove module. Please try again.');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('An error occurred while removing the module');
                });
            });

            moduleCard.appendChild(closeButton);
            droppable.appendChild(moduleCard);

            changes.push({ moduleId, day, timeSlot, startTime, endTime });
        });
    });

    document.getElementById('save-changes').addEventListener('click', () => {
        fetch('save_changes.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ changes })
        })
        .then(response => response.json())
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
    });

    document.getElementById('undo-changes').addEventListener('click', () => {
        changes = [];
        selectedModule = null;

        droppables.forEach((droppable, index) => {
            droppable.innerHTML = '';
            if (originalState[index].moduleId) {
                const moduleCard = document.querySelector(`[data-id='${originalState[index].moduleId}']`).cloneNode(true);
                initializeDraggable(moduleCard);
                moduleCard.addEventListener('click', (e) => {
                    if (selectedModule) {
                        selectedModule.classList.remove('selected');
                    }
                    selectedModule = moduleCard;
                    selectedModule.classList.add('selected');
                });

                const closeButton = document.createElement('span');
                closeButton.classList.add('close-btn');
                closeButton.innerHTML = '&times;';
                closeButton.addEventListener('click', () => {
                    droppable.removeChild(moduleCard);
                    changes.push({ moduleId: null, day: droppable.dataset.day, timeSlot: droppable.dataset.timeSlot });

                    // AJAX call to remove module from database
                    fetch('remove_module.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({ moduleId: originalState[index].moduleId, day: droppable.dataset.day, timeSlot: droppable.dataset.timeSlot, semestre: <?php echo json_encode($semestre); ?> })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            alert('Module removed successfully');
                        } else {
                            alert('Failed to remove module. Please try again.');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('An error occurred while removing the module');
                    });
                });

                moduleCard.appendChild(closeButton);
                droppable.appendChild(moduleCard);
            }
        });
    });
};
</script>
<style>
.close-btn {
    position: absolute;
    top: 5px;
    right: 5px;
    background: white;
    border-radius: 50%;
    width: 20px;
    height: 20px;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
}
</style>
</html>


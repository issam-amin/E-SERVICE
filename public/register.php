<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }

        .container {
            max-width: 500px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        label {
            font-weight: bold;
            margin-bottom: 5px;
            display: block;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"],
        select {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #4caf50;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        .additional-fields {
            display: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Registration Form</h2>
        <form id="registrationForm" action="../routing/routing.php?action=register" method="post">
            <label for="nom">Nom:</label>
            <input type="text" id="nom" name="nom" required>

            <label for="prenom">Prénom:</label>
            <input type="text" id="prenom" name="prenom" required>

            <label for="datedenaissance">Date de Naissance:</label>
            <input type="date" id="datedenaissance" name="datedenaissance" required>
            <label for="cin">CIN:</label>
            <input type="text" id="cin" name="cin" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="password">Mot de passe:</label>
            <input type="password" id="password" name="password" required>

            <label for="etat">État:</label>
            <select id="etat" name="etat">
                <option value="">Sélectionner État</option>
                <option value="etudiant">Étudiant</option>
                <option value="prof">Professeur</option>
                <option value="coordinateur">Coordinateur</option>
                <option value="chef_departement">Chef de Département</option>
            </select>

            <!-- Additional fields for Etudiant -->
            <div id="etudiantFields" class="additional-fields">
                <label for="cne">CNE:</label>
                <input type="text" id="cne" name="cne">

                <label for="cycle">Cycle:</label>
                <select id="cycle" name="cycle">
                    <option value="">Sélectionner Cycle</option>
                    <option value="AP">Cycle Praparatoire</option>
                    <option value="cycle">Cycle Ingenieur</option>
                </select>

                <div id="specializationOptions" class="additional-fields">
                    <label for="specialization">Filière:</label>
                    <select id="specialization" name="specialization">
                        <option value="">Sélectionner Filière</option>
                        <option value="mecanical">Mecanical</option>
                        <option value="informatique">Informatique</option>
                        <option value="data">Data</option>
                        <option value="ai">AI</option>
                        <option value="civi">Civil</option>
                        <option value="environnement">Eau et Environnement</option>
                        <option value="geer">Geer</option>
                    </select>
                </div>

                <label for="year">Année:</label>
                <select id="year" name="year">
                    <option value="">Sélectionner Année</option>
                    <option value="1ere">1ère Année</option>
                    <option value="2eme">2ème Année</option>
                    <option value="2eme">3ème Année</option>
                </select>
            </div>

            <!-- Additional fields for Prof -->
            <div id="profFields" class="additional-fields">
                <label for="cnp">Departement:</label>
                <select id="department" name="department">
                    <option value="">Sélectionner Département</option>
                    <option value="informatique">math-Informatique</option>
                    <option value="dep">civil-geer-mechanic-g2e</option>
                </select>
            </div>

            <!-- Additional fields for Coordinateur -->
            <div id="coordinateurFields" class="additional-fields">
                <label for="filiere">Filière:</label>
                <select id="filiere" name="filiere">
                        <option value="">Sélectionner Spécialisation</option>
                        <option value="mecanical">Mecanical</option>
                        <option value="informatique">Informatique</option>
                        <option value="data">Data</option>
                        <option value="ai">AI</option>
                        <option value="civi">Civil</option>
                        <option value="environnement">Environnement</option>
                        <option value="geer">Geer</option>
                    </select>
            </div>

            <!-- Additional fields for Chef de Département -->
            <div id="chefDepartementFields" class="additional-fields">
                <label for="department">Département:</label>
                <select id="department" name="department">
                    <option value="">Sélectionner Département</option>
                    <option value="informatique">math-Informatique</option>
                    <option value="dep">civil-geer-mechanic-g2e</option>
                </select>
            </div>

            <input type="submit" name="submit" value="submit">
        </form>
    </div>
    <script>
        // Existing JavaScript code for showing fields based on role
        const roleSelect = document.getElementById('etat');
        const etudiantFields = document.getElementById('etudiantFields');
        const EnseignantFields = document.getElementById('profFields');
        const chefDepartementFields = document.getElementById('chefDepartementFields');
        const coordinateurFields = document.getElementById('coordinateurFields');

        roleSelect.addEventListener('change', function(){
            etudiantFields.style.display ='none';
            EnseignantFields.style.display='none';
            chefDepartementFields.style.display ='none';
            coordinateurFields.style.display = 'none';

            const selectedRole = roleSelect.value;

            if(selectedRole === 'etudiant'){
                etudiantFields.style.display ='block';
            }else if(selectedRole === 'prof'){
                EnseignantFields.style.display ='block';
            }else if(selectedRole === 'coordinateur'){
                coordinateurFields.style.display ='block';
            }else if(selectedRole === 'chef_departement'){
                chefDepartementFields.style.display ='block';
            }
        });

        // New JavaScript code for showing specialization options based on cycle
        const cycleSelect = document.getElementById('cycle');
        const specializationOptions = document.getElementById('specializationOptions');

        cycleSelect.addEventListener('change', function() {
            const selectedCycle = cycleSelect.value;
            if (selectedCycle === 'cycle') {
                specializationOptions.style.display = 'block';
            } else {
                specializationOptions.style.display = 'none';
            }
        });
    </script>
    
</body>
</html>




?>
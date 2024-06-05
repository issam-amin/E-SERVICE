<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Information</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }

        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
        }

        .btn-container {
            display: flex;
            justify-content: space-between;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Account Information</h1>
        <form class="row g-3">
            <div class="col-md-6">
                <label for="inputUsername" class="form-label">Username</label>
                <input type="text" class="form-control" id="inputUsername" value="JohnDoe" disabled>
            </div>
            <div class="col-md-6">
                <label for="inputEmail" class="form-label">Email</label>
                <input type="email" class="form-control" id="inputEmail" value="john.doe@example.com" disabled>
            </div>
            <div class="col-md-6">
                <label for="inputPhone" class="form-label">Phone</label>
                <input type="text" class="form-control" id="inputPhone" value="123-456-7890" disabled>
            </div>
            <div class="col-md-6">
                <label for="inputPassword" class="form-label">Password</label>
                <input type="password" class="form-control" id="inputPassword" value="password" disabled>
            </div>
            <div class="col-12">
                <label for="inputAddress" class="form-label">Address</label>
                <input type="text" class="form-control" id="inputAddress" value="123 Main St, Anytown, USA" disabled>
            </div>
            <div class="col-md-6">
                <label for="inputCity" class="form-label">City</label>
                <input type="text" class="form-control" id="inputCity" value="Anytown" disabled>
            </div>
            <div class="col-md-4">
                <label for="inputState" class="form-label">State</label>
                <select id="inputState" class="form-select" disabled>
                    <option selected>Choose...</option>
                    <option>State 1</option>
                    <option>State 2</option>
                    <option>State 3</option>
                </select>
            </div>
            <div class="col-md-2">
                <label for="inputZip" class="form-label">Zip</label>
                <input type="text" class="form-control" id="inputZip" value="12345" disabled>
            </div>
            <div class="col-12 btn-container">
                <button type="button" class="btn btn-primary" id="editBtn" onclick="enableEditing()">Edit</button>
                <button type="button" class="btn btn-success" id="saveBtn" onclick="saveChanges()" style="display:none;">Save</button>
            </div>
        </form>
    </div>

    <script>
        function enableEditing() {
            document.getElementById('inputUsername').disabled = false;
            document.getElementById('inputEmail').disabled = false;
            document.getElementById('inputPhone').disabled = false;
            document.getElementById('inputPassword').disabled = false;
            document.getElementById('inputAddress').disabled = false;
            document.getElementById('inputCity').disabled = false;
            document.getElementById('inputState').disabled = false;
            document.getElementById('inputZip').disabled = false;
            document.getElementById('editBtn').style.display = 'none';
            document.getElementById('saveBtn').style.display = 'block';
        }

        function saveChanges() {
            document.getElementById('inputUsername').disabled = true;
            document.getElementById('inputEmail').disabled = true;
            document.getElementById('inputPhone').disabled = true;
            document.getElementById('inputPassword').disabled = true;
            document.getElementById('inputAddress').disabled = true;
            document.getElementById('inputCity').disabled = true;
            document.getElementById('inputState').disabled = true;
            document.getElementById('inputZip').disabled = true;
            document.getElementById('editBtn').style.display = 'block';
            document.getElementById('saveBtn').style.display = 'none';

            alert('Changes saved successfully!');
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>
</html>

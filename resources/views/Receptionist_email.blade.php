<!DOCTYPE html>
<html>
<head>
    <title>Hoteru</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            padding: 20px;
        }

        h1 {
            color: #333;
        }

       

        .Receptionist_details {
            background-color:rgb(217, 186, 133);
            padding: 20px;
            border-radius: 5px;
            
        }
    </style>
</head>
<body>
    <div class="Receptionist_details">
        <center><h1>Your Account</h1>
        <p>Uername: <b>{{ $data['username'] }}</b></p>
        <p>Email: <b>{{ $data['email'] }}</b></p>
        <p>Password:<b>{{ $data['password'] }}</b></p>
        </center>
    </div>
</body>
</html>

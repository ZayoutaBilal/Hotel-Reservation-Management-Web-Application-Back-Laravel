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

        h2 {
            color: #333;
        }

       

        .resetPassword_email {
            background-color:rgb(217, 186, 133);
            padding: 20px;
            border-radius: 5px;
            
        }
    </style>
</head>
<body>
    <div class="resetPassword_email">
        <center><h2>Login</h2>
        <p>Username:<b>{{ $data['username'] }}</b></p>
        <p>Password:<b>{{ $data['password'] }}</b></p>
        </center>
    </div>
</body>
</html>

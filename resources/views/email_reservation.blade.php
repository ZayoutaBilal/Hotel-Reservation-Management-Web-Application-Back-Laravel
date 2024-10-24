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

       

        .reservation-details {
            background-color:rgb(217, 186, 133);
            padding: 20px;
            border-radius: 5px;
            
        }
    </style>
</head>
<body>
    <div class="reservation-details">
        <center><h1>Your Reservation</h1></center>
        <p>Fullname: <b>{{ $data['fullname'] }}</b></p>
        <p>Phone: <b>{{ $data['phone'] }}</b></p>
        <p>Chambre: <b>{{ $data['type_chambre'] }}</b></p>
        <p>Start Date: <b>{{ $data['date_debut'] }}</b></p>
        <p>End Date: <b>{{ $data['date_fin'] }}</b></p>
        <p>Total: <b>{{ $data['total'] }} $</b></p>
    </div>
</body>
</html>

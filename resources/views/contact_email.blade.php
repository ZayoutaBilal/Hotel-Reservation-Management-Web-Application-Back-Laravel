<!DOCTYPE html>
<html>
<head>
    <title>Hoteru</title>
    
</head>
<body>
    
        <center><h2>Message Fom:</h2></center>
        <h4>{{ $data['email'] }} <b>({{ $data['fullname'] }})</b></h4>
        <h5>Subject: <b>{{ $data['about'] }}</b></h5>
        <h5><b>Body:</b></h5>
        <p>{{ $data['message'] }}</p>
    
</body>
</html>

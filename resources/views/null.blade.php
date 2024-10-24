<!DOCTYPE html>
<html>
<head>
    <title>New Contact Form Submission</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
<h2>--Contact Form Data--</h2>
<p>Name: </p>{{ session('name') }}
<p>Email: {{ session('email') }}</p>
<p>Subject: {{ session('subject') }}</p>
<p>Message: {{ session('message') }}</p>
<div class="alert alert-success">
          {{ session('success') }}!
        </div>
</body>
</html>

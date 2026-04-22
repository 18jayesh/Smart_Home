<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>SmartHome Manager</title>

    <!-- Bootstrap CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body{
            background: linear-gradient(135deg, #4facfe, #00f2fe);
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            color: white;
            font-family: Arial;
        }
        .card{
            padding: 40px;
            border-radius: 15px;
            text-align: center;
            background: rgba(255,255,255,0.1);
            backdrop-filter: blur(10px);
        }
        .btn-custom{
            width: 200px;
            margin: 10px;
            font-size: 18px;
        }
    </style>
</head>
<body>

<div class="card">
    <h1>🏠 SmartHome Manager</h1>
    <p>Control your virtual home easily</p>

    <!-- Add Home (Register) -->
    <a href="register.php" class="btn btn-light btn-custom">
        Register Now
    </a>

    <br>

    <!-- Login -->
    <a href="login.php" class="btn btn-dark btn-custom">
         Login
    </a>
</div>

</body>
</html>
<?php

    session_start();

    require_once '../config/db.php';

    if(isset($_POST['login'])){
        $email = $_POST['email'];
        $password = $_POST['password'];

        $que = "SELECT * FROM users WHERE email = '$email'";
        $data = mysqli_query($con , $que);
        $res = mysqli_fetch_assoc($data);

        if($res && password_verify($password, $res['password'])){
            $_SESSION['user_id'] = $res['user_id'];
            $_SESSION['name'] = $res['name'];

            header("Location: ../dashboard/home.php");
            exit();
        }else {
            echo "<script>alert('Invalid Email or Password!');</script>";
        }

    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

<style>
    *{
        margin:0;
        padding:0;
        box-sizing:border-box;
        font-family: 'Poppins', sans-serif;
    }

    body{
        height:100vh;
        display:flex;
        justify-content:center;
        align-items:center;
        background: linear-gradient(135deg, #43cea2, #185a9d);
    }

    .container{
        background:white;
        padding:40px;
        border-radius:15px;
        width:350px;
        box-shadow:0 10px 25px rgba(0,0,0,0.2);
        text-align:center;
    }

    h2{
        margin-bottom:20px;
    }

    .input-box{
        margin-bottom:15px;
        text-align:left;
    }

    .input-box label{
        font-size:14px;
    }

    .input-box input{
        width:100%;
        padding:10px;
        margin-top:5px;
        border:1px solid #ccc;
        border-radius:8px;
    }

    .btn{
        width:100%;
        padding:10px;
        background:#185a9d;
        color:white;
        border:none;
        border-radius:8px;
        font-size:16px;
        cursor:pointer;
    }

    .btn:hover{
        background:#144a85;
    }

    .error{
        color:red;
        margin-bottom:10px;
    }

    .register-link{
        margin-top:15px;
        font-size:14px;
    }

    .register-link a{
        color:#185a9d;
        text-decoration:none;
    }
</style>

</head>
<body>

<div class="container">
    <h2>🔐 Login</h2>
<!--  -->

    <form method="post">
        <div class="input-box">
            <label>Email</label>
            <input type="email" name="email" required>
        </div>

        <div class="input-box">
            <label>Password</label>
            <input type="password" name="password" required>
        </div>

        <button type="submit" name="login" class="btn">Login</button>
    </form>

    <div class="register-link">
        Don’t have account? <a href="register.php">Register</a>
    </div>
</div>

</body>
</html>
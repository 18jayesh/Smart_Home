<?php 
// require_once '../config/session.php';
session_start();

require_once '../config/db.php';
if(isset($_POST['submit'])){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $que = "INSERT INTO users(`name`,`email`,`password`) VALUES ('$name','$email','$password')";

    $data = mysqli_query($con , $que);

    if($data){
        $_SESSION['user_id'] = mysqli_insert_id($con);
        $_SESSION['name'] = $name;
        $_SESSION['email'] = $email;
        $_SESSION['password'] = $password;

        header("Location: ../dashboard/home.php");
        exit();
    } else {
        echo "<script>alert('Error');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Add Home</title>

<!-- Google Font -->
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
        background: linear-gradient(135deg, #667eea, #764ba2);
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
        color:#333;
    }

    .input-box{
        margin-bottom:15px;
        text-align:left;
    }

    .input-box label{
        font-size:14px;
        color:#555;
    }

    .input-box input{
        width:100%;
        padding:10px;
        margin-top:5px;
        border:1px solid #ccc;
        border-radius:8px;
        outline:none;
        transition:0.3s;
    }

    .input-box input:focus{
        border-color:#667eea;
        box-shadow:0 0 5px rgba(102,126,234,0.5);
    }

    .btn{
        width:100%;
        padding:10px;
        background:#667eea;
        color:white;
        border:none;
        border-radius:8px;
        font-size:16px;
        cursor:pointer;
        transition:0.3s;
    }

    .btn:hover{
        background:#5a67d8;
    }

    .login-link{
        margin-top:15px;
        font-size:14px;
    }

    .login-link a{
        color:#667eea;
        text-decoration:none;
        font-weight:500;
    }

</style>

</head>
<body>

<div class="container">
    <h2>Register Now</h2>

    <form method="post">
        <div class="input-box">
            <label>Name</label>
            <input type="text" name="name" required>
        </div>

        <div class="input-box">
            <label>Email</label>
            <input type="email" name="email" required>
        </div>

        <div class="input-box">
            <label>Password</label>
            <input type="password" name="password" required>
        </div>

        <button type="submit" name="submit" class="btn">Register</button>
    </form>

    <div class="login-link">
        Already have account? <a href="login.php">Login</a>
    </div>
</div>

</body>
</html>
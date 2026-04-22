<?php 
require_once '../config/session.php';
require_once '../config/db.php';

$user_id = $_SESSION['user_id'];
$room_id = $_GET['room_id'];

if(isset($_POST['add_device'])){
    $name = $_POST['device_name'];
    $type = $_POST['device_type'];

    // 🎯 Default values based on type
    if($type == "Fan"){
        $speed = 0;
        $temperature = "NULL";
        $brightness = "NULL";
    }
    elseif($type == "AC"){
        $speed = "NULL";
        $temperature = 24;
        $brightness = "NULL";
    }
    elseif($type == "Light"){
        $speed = "NULL";
        $temperature = "NULL";
        $brightness = 50;
    }
    else{
        $speed = "NULL";
        $temperature = "NULL";
        $brightness = "NULL";
    }

    $query = "INSERT INTO devices 
    (user_id, room_id, device_name, device_type, speed, temperature, brightness)
    VALUES 
    ('$user_id', '$room_id', '$name', '$type', $speed, $temperature, $brightness)";

    mysqli_query($con, $query);

    header("Location: add_device.php?room_id=$room_id");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Add Device</title>

<style>

/* BACKGROUND */
body{
    font-family: 'Poppins', sans-serif;
    background: linear-gradient(135deg, #020617, #0f172a);
    margin:0;
    height:100vh;
    display:flex;
    align-items:center;
    justify-content:center;
    color:white;
}

/* CARD */
.container{
    width:100%;
    max-width:400px;
}

.form-card{
    background: rgba(255,255,255,0.05);
    border:1px solid rgba(255,255,255,0.1);
    backdrop-filter: blur(15px);
    padding:30px;
    border-radius:15px;
    box-shadow: 0 10px 40px rgba(0,0,0,0.5);
    transition:0.3s;
}

.form-card:hover{
    transform: translateY(-5px);
}

.form-card h2{
    text-align:center;
    margin-bottom:20px;
}

/* INPUT */
.input-box{
    display:flex;
    flex-direction:column;
    gap:5px;
    margin-bottom:10px;
}

.input-box label{
    font-size:14px;
    color:#94a3b8;
}

.input-box input,
.input-box select{
    padding:12px;
    border-radius:8px;
    border:none;
    outline:none;
    background:#0f172a;
    color:white;
}

/* BUTTON */
.btn{
    margin-top:15px;
    padding:12px;
    background: linear-gradient(45deg, #38bdf8, #0ea5e9);
    border:none;
    border-radius:8px;
    color:white;
    cursor:pointer;
    transition:0.3s;
}

.btn:hover{
    transform: scale(1.05);
    box-shadow: 0 0 15px #38bdf8;
}

/* BACK */
.back-link{
    display:block;
    text-align:center;
    margin-top:15px;
    text-decoration:none;
    color:#94a3b8;
}

.back-link:hover{
    color:#38bdf8;
}

</style>

</head>

<body>

<div class="container">

<form method="post" class="form-card">

    <h2>➕ Add Device</h2>

    <!-- NAME -->
    <div class="input-box">
        <label>Device Name</label>
        <input type="text" name="device_name" placeholder="Enter device name..." required>
    </div>

    <!-- TYPE -->
    <div class="input-box">
        <label>Device Type</label>
        <select name="device_type" required>
            <option value="">Select Type</option>
            <option value="Fan">Fan 🌀</option>
            <option value="Light">Light 💡</option>
            <option value="AC">AC ❄️</option>
            <option value="TV">TV 📺</option>
            <option value="Other">Other ⚙️</option>
        </select>
    </div>

    <button name="add_device" class="btn">Add Device</button>

    <a href="../dashboard/control_device.php" class="back-link">
        ← Back to Dashboard
    </a>

</form>

</div>

</body>
</html>

<?php require_once '../components/background.php'; ?>
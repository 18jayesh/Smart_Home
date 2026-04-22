<?php require_once '../config/session.php'; ?>
<?php require_once '../config/db.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Select Room</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

<style>
*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:Poppins;
}

body{
    background: radial-gradient(circle at top, #0f172a, #020617);
    color:white;
    overflow:hidden;
}

/* CONTAINER */
.container{
    height:100vh;
    display:flex;
    flex-direction:column;
    justify-content:center;
    align-items:center;
    text-align:center;
}

/* TITLE */
h1{
    font-size:38px;
    margin-bottom:10px;
}

.subtitle{
    opacity:0.7;
    margin-bottom:40px;
}

/* SLIDER */
.slider{
    position:relative;
    width:80%;
    overflow:hidden;
}

/* SLIDES */
.slides{
    display:flex;
    gap:25px;
    transition:0.5s ease;
}

/* CARD */
.card{
    min-width:260px;
    padding:30px;
    border-radius:20px;

    background:rgba(255,255,255,0.05);
    border:1px solid rgba(255,255,255,0.1);
    backdrop-filter:blur(15px);

    cursor:pointer;
    transition:0.4s;
}

/* HOVER */
.card:hover{
    transform:translateY(-5px) scale(1.05);
    box-shadow:0 0 25px rgba(56,189,248,0.6);
}

/* TEXT */
.card h3{
    font-size:20px;
    margin-bottom:10px;
}

.card p{
    font-size:14px;
    opacity:0.7;
}

/* 🔥 PREMIUM ARROWS */
.arrow{
    position:absolute;
    top:50%;
    transform:translateY(-50%);
    
    width:55px;
    height:55px;

    display:flex;
    align-items:center;
    justify-content:center;

    font-size:22px;
    color:white;

    cursor:pointer;
    z-index:10;

    border-radius:50%;

    background:rgba(255,255,255,0.08);
    backdrop-filter:blur(12px);
    border:1px solid rgba(255,255,255,0.2);

    box-shadow:0 0 15px rgba(56,189,248,0.4);

    transition:0.3s;
}

.left{ left:-20px; }
.right{ right:-20px; }

/* HOVER */
.arrow:hover{
    transform:translateY(-50%) scale(1.15);
    background:#38bdf8;
    color:black;
    box-shadow:0 0 25px #38bdf8;
}

/* CLICK */
.arrow:active{
    transform:translateY(-50%) scale(0.95);
}
.back-btn{
    position: absolute;
    top: 20px;
    left: 20px;
    
    padding: 10px 18px;
    font-size: 14px;

    border: none;
    border-radius: 8px;

    background: rgba(255,255,255,0.08);
    color: white;

    cursor: pointer;

    backdrop-filter: blur(10px);
    border: 1px solid rgba(255,255,255,0.2);

    transition: 0.3s;
}

/* hover effect */
.back-btn:hover{
    background: #38bdf8;
    color: black;
    box-shadow: 0 0 15px #38bdf8;
    transform: scale(1.05);
}
</style>

</head>

<body>
    <button class="back-btn" onclick="goBack()">← Dashboard</button>
<div class="container">

<h1>🏠 Select Your Room</h1>
<p class="subtitle">Choose a room to enter 3D Smart Home</p>

<div class="slider">

<div class="arrow left" onclick="move(-1)"><</div>

<div class="slides" id="slides">

<?php
$res = mysqli_query($con, "SELECT * FROM rooms WHERE user_id='".$_SESSION['user_id']."'");

while($row = mysqli_fetch_assoc($res)){
?>

<div class="card" onclick="openRoom(<?php echo $row['id']; ?>)">
    <h3><?php echo $row['room_name']; ?></h3>
    <p>Click to explore</p>
</div>

<?php } ?>

</div>

<div class="arrow right" onclick="move(1)">></div>

</div>

</div>

<script>

let index = 0;

function move(step){
    const slides = document.getElementById("slides");
    const total = slides.children.length;

    index += step;

    if(index < 0) index = 0;
    if(index > total - 3) index = total - 3;

    slides.style.transform = "translateX(-" + (index * 300) + "px)";
}

// 🔥 OPEN ROOM (same page)
function openRoom(id){
    window.location.href = "3d_home.php?room_id=" + id , "_blank" ;
}

function goBack(){
    window.location.href = "home.php";
}

</script>

</body>
</html>
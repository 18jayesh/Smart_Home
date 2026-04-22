<?php 
require_once '../config/session.php';
require_once '../config/db.php';

// INSERT ROOM
if(isset($_POST['add_room'])){
    $room = mysqli_real_escape_string($con, $_POST['room_name']);
    $user_id = $_SESSION['user_id'];

    mysqli_query($con, "INSERT INTO rooms (user_id, room_name) VALUES ('$user_id', '$room')");

    header("Location: ../dashboard/addhome.php");
    exit();
}

// DELETE ROOM
if(isset($_GET['delete_id'])){
    $id = mysqli_real_escape_string($con, $_GET['delete_id']);

    mysqli_query($con, "DELETE FROM rooms WHERE id='$id'");

    header("Location: ../dashboard/addhome.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Rooms</title>

<style>

body{
    font-family: Poppins;
    background:#020617;
    color:white;
    padding:30px;
}

/* CONTAINER */
.rooms-container{
    display:flex;
    flex-wrap:wrap;
    gap:20px;
    margin-left:260px;
    padding:30px;
}

/* ROOM CARD */
.room-card{
    width:220px;
    background:rgba(255,255,255,0.05);
    border:1px solid rgba(255,255,255,0.1);
    padding:15px;
    border-radius:15px;
    backdrop-filter:blur(12px);
    transition:0.3s;
}

.room-card:hover{
    transform:translateY(-6px);
    box-shadow:0 0 20px rgba(56,189,248,0.5);
}

/* TITLE */
.room-card h3{
    margin:0 0 10px;
}

/* BUTTONS */
.card-actions{
    display:flex;
    justify-content:space-between;
    flex-wrap:wrap;
    gap:5px;
}

.add-btn, .delete-btn{
    padding:6px 10px;
    border-radius:6px;
    font-size:13px;
    text-decoration:none;
    transition:0.3s;
}

.add-btn{
    background:rgba(56,189,248,0.2);
    color:#38bdf8;
}

.add-btn:hover{
    background:#38bdf8;
    color:#000;
}

.delete-btn{
    background:rgba(255,0,0,0.2);
    color:#ff4d4d;
}

.delete-btn:hover{
    background:#ef4444;
    color:white;
}

/* MODAL */
.modal{
    display:none;
    position:fixed;
    top:0;
    left:0;
    width:100%;
    height:100%;
    background:rgba(0,0,0,0.7);
}

.modal-content{
    background:#020617;
    width:420px;
    margin:80px auto;
    padding:20px;
    border-radius:12px;
    position:relative;
    box-shadow:0 0 25px rgba(0,0,0,0.6);
}

/* DEVICE BOX */
.device-box{
    border-radius:10px;
    padding:12px;
    margin-bottom:10px;
    backdrop-filter: blur(10px);
    background: rgba(30, 41, 59, 0.7);
}

/* CLOSE BUTTON */
.close-btn{
    position:absolute;
    top:10px;
    right:10px;
    background:rgba(255,255,255,0.1);
    border:none;
    color:white;
    width:35px;
    height:35px;
    border-radius:50%;
    cursor:pointer;
    transition:0.3s;
}

.close-btn:hover{
    background:#ef4444;
    transform:rotate(90deg);
}

/* SCROLL (important if devices vadha hoy) */
#deviceData{
    max-height:300px;
    overflow-y:auto;
    margin-top:10px;
}

</style>

<script>

    function deleteDevice(e, form){
        e.preventDefault();

        if(confirm("Delete this device?")){
            let formData = new FormData(form);

            fetch('update_device.php', {
                method: 'POST',
                body: formData
            })
            .then(res => res.text())
            .then(data => {
                console.log(data);

                fetch("get_devices.php?room_id=" + window.currentRoom)
                .then(res => res.text())
                .then(data => {
                    document.getElementById("deviceData").innerHTML = data;
                });
            });
        }
    }

function openDevices(room_id){
    document.getElementById("modal").style.display = "block";
    window.currentRoom = room_id;

    fetch("get_devices.php?room_id=" + room_id)
    .then(res => res.text())
    .then(data => {
        document.getElementById("deviceData").innerHTML = data;
    });
}

function closeModal(){
    document.getElementById("modal").style.display = "none";
}

// UPDATE DEVICE
function updateDevice(e, form){
    e.preventDefault();

    let formData = new FormData(form);

    fetch('update_device.php', {
        method: 'POST',
        body: formData
    })
    .then(() => reloadDevices());
}

// RELOAD DEVICES
function reloadDevices(){
    fetch("get_devices.php?room_id=" + window.currentRoom)
    .then(res => res.text())
    .then(data => {
        document.getElementById("deviceData").innerHTML = data;
    });
}


</script>

</head>

<body>

<div class="rooms-container">

<?php
$user_id = $_SESSION['user_id'];
$res = mysqli_query($con, "SELECT * FROM rooms WHERE user_id='$user_id'");

while($row = mysqli_fetch_assoc($res)){
?>

<div class="room-card">
    <h3><?php echo $row['room_name']; ?></h3>

    <div class="card-actions">

        <a href="add_device.php?room_id=<?php echo $row['id']; ?>" class="add-btn">
            +Add appliances
        </a>

        <a href="#" onclick="openDevices(<?php echo $row['id']; ?>)" class="add-btn">
            Control
        </a>

        <a href="?delete_id=<?php echo $row['id']; ?>" class="delete-btn">
            🗑
        </a>

    </div>
</div>

<?php } ?>

</div>

<!-- MODAL -->
<div id="modal" class="modal">
    <div class="modal-content">

        <h3>Devices</h3>

        <div id="deviceData">Loading...</div>

        <button class="close-btn" onclick="closeModal()">✕</button>

    </div>
</div>

</body>
</html>

<?php require_once '../components/background.php'; ?>
<?php require_once '../components/slider.php'; ?>
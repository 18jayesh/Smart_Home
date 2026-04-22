<?php 
require_once '../config/session.php';
require_once '../config/db.php';

// INSERT ROOM
if(isset($_POST['add_room'])){
    $room = $_POST['room_name'];
    $user_id = $_SESSION['user_id'];

    $query = "INSERT INTO rooms (user_id, room_name) VALUES ('$user_id', '$room')";
    
    mysqli_query($con, $query);

    header("Location: ../dashboard/addhome.php");
}

// DELETE ROOM
if(isset($_GET['delete_id'])){
    $id = $_GET['delete_id'];

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

.container{
    max-width:800px;
    margin:auto;
}

h2{
    margin-bottom:20px;
}
.delete-btn{
    background:red;
    color:white;
    padding:6px 10px;
    border-radius:6px;
    text-decoration:none;
    font-size:12px;
}

.room{
    display:flex;
    justify-content:space-between;
    align-items:center;
}
/* FORM */
.form{
    display:flex;
    gap:10px;
    margin-bottom:20px;
}

.form input{
    flex:1;
    padding:10px;
    border:none;
    border-radius:6px;
}

.form button{
    padding:10px 20px;
    background:#38bdf8;
    border:none;
    border-radius:6px;
    cursor:pointer;
}
/* GRID LAYOUT */
.rooms-container{
    display:flex;
    flex-wrap:wrap;
    gap:20px;
}

/* SMALL CARD */
.room-card{
    width:200px;   /* 🔥 fixed width */
    background:rgba(255,255,255,0.05);
    border:1px solid rgba(255,255,255,0.1);
    padding:15px;
    border-radius:12px;
    backdrop-filter:blur(10px);
    transition:0.3s;
}

.room-card:hover{
    transform:translateY(-5px) scale(1.03);
    box-shadow:0 0 15px rgba(56,189,248,0.4);
}

/* ACTIONS */
.card-actions{
    display:flex;
    justify-content:flex-end;
}

/* DELETE BUTTON */
.delete-btn{
    background:rgba(255,0,0,0.2);
    color:#ff4d4d;
    padding:6px 10px;
    border-radius:6px;
    text-decoration:none;
    font-size:13px;
    transition:0.3s;
}

.delete-btn:hover{
    background:red;
    color:white;
}

</style>
</head>

<body>
    <div class="page-content">
    


        <!-- ADD ROOM -->
        <form method="post" class="form">
            <select name="room_name" required>
                <option value="">-- Select Room --</option>
                <option value="Living Room">Living Room</option>
                <option value="Bedroom">Bedroom</option>
                <option value="Kitchen">Kitchen</option>
                <option value="Hall">Hall</option>
                <option value="Bathroom">Bathroom</option>
                <option value="Dining Room">Dining Room</option>
                <option value="Balcony">Balcony</option>
                <option value="Office Room">Office Room</option>
            </select>

            <button type="submit" name="add_room">Add</button>
        </form>

        <!-- SHOW ROOMS -->
        <div class="rooms-container">
            <?php
                $user_id = $_SESSION['user_id'];
                $res = mysqli_query($con, "SELECT * FROM rooms WHERE user_id='$user_id'");

                while($row = mysqli_fetch_assoc($res)){
                ?>
                    <div class="room-card">
                        <h3><?php echo $row['room_name']; ?></h3>

                        <div class="card-actions">
                            <a href="?delete_id=<?php echo $row['id']; ?>" class="delete-btn">🗑 Delete</a>
                        </div>
                    </div>
            <?php } ?>
        </div>

    </div>

</body>
</html>


<?php require_once '../components/background.php'; ?>
<?php require_once '../components/slider.php'; ?>
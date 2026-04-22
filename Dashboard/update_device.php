<?php 
require_once '../config/db.php';

// CHECK POST
if(!isset($_POST['id']) || !isset($_POST['action'])){
    echo "invalid";
    exit();
}

$id = intval($_POST['id']);
$action = $_POST['action'];

// 🔥 FETCH CURRENT DATA (IMPORTANT FIX)
$res = mysqli_query($con, "SELECT * FROM devices WHERE id='$id'");
$row = mysqli_fetch_assoc($res);

$status = $row['status'];
$start_time = $row['start_time'];

// 🔘 TOGGLE
if($action == "toggle"){

    if($status == 'OFF'){
        // TURN ON
        $start = date("Y-m-d H:i:s");

        mysqli_query($con, "
            UPDATE devices 
            SET status='ON', start_time='$start'
            WHERE id='$id'
        ");

    } else {
        // TURN OFF
        $end = date("Y-m-d H:i:s");

        if($start_time){
            $seconds = strtotime($end) - strtotime($start_time);

            mysqli_query($con, "
                UPDATE devices 
                SET status='OFF',
                    total_seconds = total_seconds + $seconds,
                    start_time = NULL
                WHERE id='$id'
            ");
        } else {
            // fallback
            mysqli_query($con, "UPDATE devices SET status='OFF' WHERE id='$id'");
        }
    }
}

// 🗑 DELETE
if($action == "delete"){
    mysqli_query($con, "DELETE FROM devices WHERE id='$id'");
    echo "deleted";
    exit();
}

// SPEED
if($action == "speed_up"){
    mysqli_query($con, "UPDATE devices SET speed = IF(speed < 5, speed + 1, 5) WHERE id='$id'");
}

if($action == "speed_down"){
    mysqli_query($con, "UPDATE devices SET speed = IF(speed > 0, speed - 1, 0) WHERE id='$id'");
}

// TEMP
if($action == "temp_up"){
    mysqli_query($con, "UPDATE devices SET temperature = IF(temperature < 30, temperature + 1, 30) WHERE id='$id'");
}

if($action == "temp_down"){
    mysqli_query($con, "UPDATE devices SET temperature = IF(temperature > 16, temperature - 1, 16) WHERE id='$id'");
}

// BRIGHTNESS
if($action == "bright_up"){
    mysqli_query($con, "UPDATE devices SET brightness = IF(brightness < 100, brightness + 10, 100) WHERE id='$id'");
}

if($action == "bright_down"){
    mysqli_query($con, "UPDATE devices SET brightness = IF(brightness > 0, brightness - 10, 0) WHERE id='$id'");
}

echo "success";
?>
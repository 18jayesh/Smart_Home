<?php 
require_once '../config/db.php';

$room_id = $_GET['room_id'];
$res = mysqli_query($con, "SELECT * FROM devices WHERE room_id='$room_id'");
?>

<style>
body {
    font-family: 'Segoe UI', sans-serif;
    background: #0f172a;
}

.device-box {
    background: #1e293b;
    border-radius: 15px;
    padding: 20px;
    margin-bottom: 20px;
    color: #fff;
    box-shadow: 0 10px 25px rgba(0,0,0,0.3);
}

.device-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

/* 🔥 FIX MAIN PART */
.device-actions{
    display: flex;
    align-items: center;
    gap: 12px;
}

/* IMPORTANT FIX */
.device-actions form{
    display: flex;
    align-items: center;
    margin: 0;
}

/* SWITCH */
.switch {
    position: relative;
    width: 50px;
    height: 26px;
    display: inline-block;
}

.switch input {
    opacity: 0;
    width: 0;
    height: 0;
}

.slider {
    position: absolute;
    inset: 0;
    background: #ef4444;
    border-radius: 34px;
    cursor:pointer;
    transition: .4s;
}

.slider:before {
    content: "";
    position: absolute;
    height: 20px;
    width: 20px;
    left: 3px;
    bottom: 3px;
    background: white;
    border-radius: 50%;
    transition: .4s;
}

input:checked + .slider {
    background: #22c55e;
}

input:checked + .slider:before {
    transform: translateX(24px);
}

/* DELETE */
.delete-btn{
    background: rgba(255,0,0,0.2);
    color:#ff4d4d;
    border:none;
    padding:6px 10px;
    border-radius:6px;
    cursor:pointer;
}

.delete-btn:hover{
    background:#ef4444;
    color:white;
}

/* CONTROLS */
.control-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    background: #0f172a;
    padding: 12px 15px;
    border-radius: 10px;
    margin-top: 10px;
}

.control {
    display: flex;
    align-items: center;
    gap: 10px;
}

.pm-btn {
    background: #3b82f6;
    border: none;
    color: white;
    padding: 5px 12px;
    border-radius: 8px;
    cursor: pointer;
}

.pm-btn:disabled {
    background: #555;
    cursor: not-allowed;
}
</style>

<?php while($row = mysqli_fetch_assoc($res)){ ?>

<div class="device-box">

<div class="device-header">

    <div><?php echo $row['device_name']; ?></div>

    <div class="device-actions">

        <!-- SWITCH -->
        <form onsubmit="updateDevice(event, this)">
            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
            <input type="hidden" name="action" value="toggle">

            <label class="switch">
                <input type="checkbox"
                    onchange="this.form.dispatchEvent(new Event('submit'))"
                    <?php echo ($row['status']=='ON') ? 'checked' : ''; ?>>
                <span class="slider"></span>
            </label>
        </form>

        <!-- DELETE -->
        <form onsubmit="deleteDevice(event, this)">
            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
            <input type="hidden" name="action" value="delete">

            <button class="delete-btn">🗑</button>
        </form>

    </div>

</div>

<!-- TYPE BASE CONTROLS -->

<?php if($row['device_type'] == 'Fan'){ ?>
<div class="control-row">
    <div>Speed</div>
    <div class="control">
        <span><?php echo $row['speed'] ?? 0; ?></span>

        <form onsubmit="updateDevice(event, this)">
            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
            <input type="hidden" name="action" value="speed_up">
            <button class="pm-btn" <?php if($row['speed'] >= 5) echo 'disabled'; ?>>+</button>
        </form>

        <form onsubmit="updateDevice(event, this)">
            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
            <input type="hidden" name="action" value="speed_down">
            <button class="pm-btn" <?php if($row['speed'] <= 0) echo 'disabled'; ?>>-</button>
        </form>
    </div>
</div>
<?php } ?>

<?php if($row['device_type'] == 'AC'){ ?>
<div class="control-row">
    <div>Temp</div>
    <div class="control">
        <span><?php echo $row['temperature'] ?? 24; ?>°C</span>

        <form onsubmit="updateDevice(event, this)">
            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
            <input type="hidden" name="action" value="temp_up">
            <button class="pm-btn" <?php if($row['temperature'] >= 30) echo 'disabled'; ?>>+</button>
        </form>

        <form onsubmit="updateDevice(event, this)">
            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
            <input type="hidden" name="action" value="temp_down">
            <button class="pm-btn" <?php if($row['temperature'] <= 16) echo 'disabled'; ?>>-</button>
        </form>
    </div>
</div>
<?php } ?>

<?php if($row['device_type'] == 'Light'){ ?>
<div class="control-row">
    <div>Brightness</div>
    <div class="control">
        <span><?php echo $row['brightness'] ?? 50; ?>%</span>

        <form onsubmit="updateDevice(event, this)">
            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
            <input type="hidden" name="action" value="bright_up">
            <button class="pm-btn" <?php if($row['brightness'] >= 100) echo 'disabled'; ?>>+</button>
        </form>

        <form onsubmit="updateDevice(event, this)">
            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
            <input type="hidden" name="action" value="bright_down">
            <button class="pm-btn" <?php if($row['brightness'] <= 0) echo 'disabled'; ?>>-</button>
        </form>
    </div>
</div>
<?php } ?>

<?php if($row['device_type'] == 'Other'){ ?>
<div class="control-row">
    <div>No Controls Available ⚙️</div>
</div>
<?php } ?>

</div>

<?php } ?>
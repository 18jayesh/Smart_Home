<?php
require_once '../config/session.php';
require_once '../config/db.php';

$user_id = $_SESSION['user_id'];

$res = mysqli_query($con, "SELECT * FROM devices WHERE user_id='$user_id'");

$total_units = 0;
?>

<!DOCTYPE html>
<html>
<head>
<title>Electricity Report</title>

<style>

/* BACKGROUND */
body{
    font-family: 'Poppins', sans-serif;
    background: linear-gradient(135deg, #020617, #0f172a);
    margin:0;
    color:white;
}

/* CONTAINER */
.container{
    width:90%;
    max-width:1000px;
    margin-top:80px;
    margin-left:300px;
}

/* HEADER */
.title{
    text-align:center;
    font-size:28px;
    margin-bottom:30px;
}

/* CARD */
.card{
    background: rgba(255,255,255,0.05);
    border:1px solid rgba(255,255,255,0.1);
    backdrop-filter: blur(15px);
    border-radius:15px;
    padding:20px;
    box-shadow:0 10px 40px rgba(0,0,0,0.5);
}

/* TABLE */
table{
    width:100%;
    border-collapse:collapse;
    margin-top:15px;
}

th, td{
    padding:12px;
    text-align:center;
}

th{
    background:#0f172a;
    color:#38bdf8;
}

tr{
    border-bottom:1px solid rgba(255,255,255,0.1);
}

tr:hover{
    background:rgba(255,255,255,0.05);
}

/* SUMMARY */
.summary{
    margin-top:20px;
    display:flex;
    justify-content:space-between;
    flex-wrap:wrap;
    gap:15px;
}

.box{
    flex:1;
    min-width:200px;
    background: rgba(255,255,255,0.05);
    padding:15px;
    border-radius:10px;
    text-align:center;
}

.units{
    color:#38bdf8;
    font-size:18px;
}

.bill{
    color:#22c55e;
    font-size:22px;
    font-weight:bold;
}

/* BACK BUTTON */
.back-btn{
    display:inline-block;
    margin-top:20px;
    text-decoration:none;
    color:#94a3b8;
}

.back-btn:hover{
    color:#38bdf8;
}

</style>

</head>

<body>

<div class="container">

    <div class="title">⚡ Electricity Usage Report</div>

    <div class="card">

        <table>
            <tr>
                <th>Device</th>
                <th>Hours</th>
                <th>Units</th>
            </tr>

            <?php while($row = mysqli_fetch_assoc($res)){

                $hours = $row['total_seconds'] / 3600;
                $units = ($row['power_watt'] * $hours) / 1000;

                $total_units += $units;
            ?>

            <tr>
                <td><?php echo $row['device_name']; ?></td>
                <td><?php echo round($hours,2); ?></td>
                <td><?php echo round($units,2); ?></td>
            </tr>

            <?php } ?>

        </table>

        <?php
        $rate = 8;
        $bill = $total_units * $rate;
        ?>

        <div class="summary">

            <div class="box">
                <div>Total Units</div>
                <div class="units"><?php echo round($total_units,2); ?></div>
            </div>

            <div class="box">
                <div>Total Bill</div>
                <div class="bill">₹<?php echo round($bill,2); ?></div>
            </div>

        </div>

    </div>

</div>

</body>
</html>

<?php require_once '../components/background.php'; ?>
<?php require_once '../components/slider.php'; ?>
<!-- SIDEBAR -->
<div class="sidebar" id="sidebar">

    <h2>⚡ SmartHome</h2>

    <ul>
        <li><a href="../dashboard/home.php">🏠 Dashboard</a></li>
        <li><a href="../dashboard/addhome.php">🛏️ Rooms</a></li>
        <li><a href="../dashboard/control_device.php">💡 Devices</a></li>
        <li><a href="../reports/elc_report.php">📊 Reports</a></li>
        <li><a href="../components/logout.php">🚪 Logout</a></li>
    </ul>
</div>

<!-- RIGHT SIDE TOGGLE BUTTON -->
<div class="toggle-btn" onclick="toggleSidebar()">❯</div>

<style>
/* SIDEBAR */
.sidebar{
    position:fixed;
    top:60px; /* header niche */
    left:0;
    width:230px;
    height:calc(100% - 60px);
    background:linear-gradient(180deg,#020617,#0f172a);
    padding:25px 20px;
    transition:0.4s ease;
    z-index:100;
    border-right:1px solid rgba(255,255,255,0.1);
}


/* CLOSED */
.sidebar.closed{
    left:-230px;
}

/* TITLE */
.sidebar h2{
    color:#38bdf8;
    margin-bottom:30px;
    font-size:22px;
}

/* MENU */
.sidebar ul{
    list-style:none;
}

.sidebar ul li{
    margin:18px 0;
    transition:0.3s;
}

.sidebar ul li:hover{
    transform:translateX(6px);
}

/* LINKS */
.sidebar ul li a{
    color:#cbd5e1;
    text-decoration:none;
    font-size:15px;
    display:block;
    padding:8px 10px;
    border-radius:8px;
    transition:0.3s;
}

.sidebar ul li a:hover{
    background:rgba(56,189,248,0.1);
    color:#38bdf8;
}

/* TOGGLE BUTTON (RIGHT SIDE 🔥) */
.toggle-btn{
    position:fixed;
    top:80px;
    left:230px;
    background:#38bdf8;
    color:black;
    padding:10px 12px;
    border-radius:50%;
    cursor:pointer;
    font-size:18px;
    z-index:200;
    box-shadow:0 0 15px #38bdf8;
    transition:0.4s;
}

/* when closed */
.sidebar.closed ~ .toggle-btn{
    left:10px;
    transform:rotate(180deg);
}

/* HOVER EFFECT */
.toggle-btn:hover{
    transform:scale(1.1);
}

/* CONTENT SHIFT */
.page-content{
    margin-left:230px;
    margin-top:60px;
    padding:20px;
    transition:0.4s;
}

.sidebar.closed ~ .page-content{
    margin-left:20px;
}

/* MOBILE */
@media(max-width:768px){
    .sidebar{
        left:-230px;
    }

    .sidebar.active{
        left:0;
    }

    .toggle-btn{
        left:10px;
    }

    .page-content{
        margin-left:20px;
    }
}
</style>

<script>
function toggleSidebar(){
    document.getElementById("sidebar").classList.toggle("closed");
}
</script>
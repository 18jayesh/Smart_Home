<?php
require_once '../config/session.php';
require_once '../config/db.php';

if(isset($_GET['room_id'])){
    $room_id = $_GET['room_id'];
} else {
    echo "Room ID missing!";
    exit();
}

// FETCH DEVICES
$res = mysqli_query($con, "SELECT * FROM devices WHERE room_id='$room_id'");
$devices = [];

while($row = mysqli_fetch_assoc($res)){
    $devices[] = $row;
}
?>

<!DOCTYPE html>
<html>
<head>
<title>3D Room</title>

<script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.js"></script>

<!-- ✅ IMPORTANT FIX -->
<script src="https://cdn.jsdelivr.net/npm/three@0.128/examples/js/controls/OrbitControls.js"></script>

</head>

<body style="margin:0; overflow:hidden;">

<script>

// DEBUG
console.log("Devices:", <?php echo json_encode($devices); ?>);

// DATA
const devices = <?php echo json_encode($devices); ?>;

// SCENE
const scene = new THREE.Scene();
scene.background = new THREE.Color(0x222222);

// CAMERA (FIXED)
const camera = new THREE.PerspectiveCamera(75, window.innerWidth/window.innerHeight, 0.1, 1000);
camera.position.set(0, 5, 15);
camera.lookAt(0,0,0);

// RENDERER
const renderer = new THREE.WebGLRenderer({antialias:true});
renderer.setSize(window.innerWidth, window.innerHeight);
document.body.appendChild(renderer.domElement);

// CONTROLS
const controls = new THREE.OrbitControls(camera, renderer.domElement);

// LIGHT (STRONG FIX)
const ambient = new THREE.AmbientLight(0xffffff, 1);
scene.add(ambient);

// FLOOR
const floor = new THREE.Mesh(
    new THREE.PlaneGeometry(20,20),
    new THREE.MeshBasicMaterial({color:0x555555})
);
floor.rotation.x = -Math.PI/2;
scene.add(floor);

// BACK WALL
const backWall = new THREE.Mesh(
    new THREE.BoxGeometry(20,10,1),
    new THREE.MeshBasicMaterial({color:0x888888})
);
backWall.position.set(0,5,-10);
scene.add(backWall);

// LEFT WALL
const leftWall = new THREE.Mesh(
    new THREE.BoxGeometry(1,10,20),
    new THREE.MeshBasicMaterial({color:0x888888})
);
leftWall.position.set(-10,5,0);
scene.add(leftWall);

// RIGHT WALL
const rightWall = new THREE.Mesh(
    new THREE.BoxGeometry(1,10,20),
    new THREE.MeshBasicMaterial({color:0x888888})
);
rightWall.position.set(10,5,0);
scene.add(rightWall);

// ================= DEVICES =================

// LIGHT
function createLight(){
    const bulb = new THREE.Mesh(
        new THREE.SphereGeometry(0.6,16,16),
        new THREE.MeshBasicMaterial({color:0xffff00})
    );
    bulb.position.set(0,7,0);
    scene.add(bulb);
}

// FAN
let fan;
function createFan(){
    fan = new THREE.Mesh(
        new THREE.BoxGeometry(4,0.2,0.5),
        new THREE.MeshBasicMaterial({color:0x00ffff})
    );
    fan.position.set(0,6,0);
    scene.add(fan);
}

// AC
function createAC(){
    const ac = new THREE.Mesh(
        new THREE.BoxGeometry(3,1.5,1),
        new THREE.MeshBasicMaterial({color:0xffffff})
    );
    ac.position.set(0,6,-9);
    scene.add(ac);
}

// LOAD DEVICES
devices.forEach(device => {
    if(device.device_type === "Light") createLight();
    if(device.device_type === "Fan") createFan();
    if(device.device_type === "AC") createAC();
});

// ANIMATION
function animate(){
    requestAnimationFrame(animate);

    if(fan){
        fan.rotation.y += 0.1;
    }

    renderer.render(scene, camera);
}
animate();

// RESIZE
window.addEventListener('resize', () => {
    renderer.setSize(window.innerWidth, window.innerHeight);
    camera.aspect = window.innerWidth / window.innerHeight;
    camera.updateProjectionMatrix();
});

</script>

</body>
</html>
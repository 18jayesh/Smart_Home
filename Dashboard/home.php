<?php require_once '../config/session.php'; ?>
<?php require_once '../config/db.php'; ?>
<?php require_once '../components/slider.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.js"></script>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            overflow: hidden;
            background: #020617;
            color: white;
        }

        #canvas {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
        }

        .dashboard {
            position: relative;
            z-index: 2;
            margin-top: 120px;
            text-align: center;
        }

        .title {
            font-size: 32px;
            margin-bottom: 10px;
        }

        .desc {
            max-width: 600px;
            margin: 0 auto 30px;
            line-height: 1.6;
            font-size: 16px;
        }

        .btn {
            margin-top: 20px;
            padding: 12px 30px;
            border: none;
            border-radius: 8px;
            background: #38bdf8;
            color: black;
            cursor: pointer;
            transition: 0.3s;
        }

        .btn:hover {
            transform: scale(1.1);
            box-shadow: 0 0 15px #38bdf8;
        }
    </style>
</head>

<body>

<canvas id="canvas"></canvas>

<div class="dashboard">

    <h1 class="title">🏠 Smart Home Dashboard</h1>

    <p class="desc">
        Control your home devices like Lights, Fans, AC with smart automation.
        Experience a modern and interactive smart home system.
    </p>

    <!-- ✅ SINGLE BUTTON -->
    <button class="btn" onclick="goToRooms()">Go to Rooms</button>

</div>

<script>
// 3JS BACKGROUND
const scene = new THREE.Scene();
const camera = new THREE.PerspectiveCamera(75, window.innerWidth / window.innerHeight, 0.1, 1000);

const renderer = new THREE.WebGLRenderer({
    canvas: document.getElementById('canvas'),
    alpha: true
});
renderer.setSize(window.innerWidth, window.innerHeight);

// Geometry
const geometry = new THREE.TorusKnotGeometry(100, 30, 100, 16);
const material = new THREE.MeshBasicMaterial({
    color: 0x38bdf8,
    wireframe: true
});

const knot = new THREE.Mesh(geometry, material);
scene.add(knot);

camera.position.z = 400;

// Mouse
let mouseX = 0;
let mouseY = 0;

window.addEventListener('mousemove', (e) => {
    mouseX = (e.clientX / window.innerWidth - 0.5);
    mouseY = (e.clientY / window.innerHeight - 0.5);
});

// Click animation
window.addEventListener('click', () => {
    knot.scale.set(1.3, 1.3, 1.3);
    setTimeout(() => {
        knot.scale.set(1, 1, 1);
    }, 200);
});

// Key color change
window.addEventListener('keydown', () => {
    material.color.setHex(Math.random() * 0xffffff);
});

// Animation
function animate() {
    requestAnimationFrame(animate);
    knot.rotation.x += 0.01 + mouseY * 0.05;
    knot.rotation.y += 0.01 + mouseX * 0.05;
    renderer.render(scene, camera);
}
animate();

// Voice
window.addEventListener('load', () => {
    const text = `Welcome sir. Nice to meet you boss`;
    const message = new SpeechSynthesisUtterance(text);
    message.lang = "en-US";
    message.rate = 0.9;
    message.pitch = 1.2;
    speechSynthesis.speak(message);
});

// 🔥 NAVIGATION FUNCTION
function goToRooms(){
    window.location.href = "rooms_3d.php";
}
</script>

</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>SmartHome Manager</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.js"></script>

<style>
*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:'Poppins',sans-serif;
}

body{
    overflow:hidden;
    background:#020617;
    color:white;
}

/* CANVAS */
#canvas{
    position:fixed;
    top:0;
    left:0;
    width:100%;
    height:100%;
    z-index:-1;
}

/* MAIN CARD */
.container{
    height:100vh;
    display:flex;
    justify-content:center;
    align-items:center;
}

.card{
    background:rgba(255,255,255,0.05);
    backdrop-filter:blur(15px);
    border:1px solid rgba(255,255,255,0.1);
    padding:50px;
    border-radius:20px;
    text-align:center;
    transition:0.4s;
}

.card:hover{
    transform:scale(1.05);
    box-shadow:0 0 40px #38bdf8;
}

h1{
    font-size:32px;
    margin-bottom:10px;
}

p{
    opacity:0.7;
    margin-bottom:25px;
}

/* BUTTONS */
.btn{
    display:block;
    width:220px;
    margin:10px auto;
    padding:12px;
    border:none;
    border-radius:10px;
    font-size:16px;
    cursor:pointer;
    transition:0.3s;
    text-decoration:none;
}

.register{
    background:#38bdf8;
    color:black;
}

.login{
    background:transparent;
    border:1px solid #38bdf8;
    color:#38bdf8;
}

.btn:hover{
    transform:translateY(-3px);
    box-shadow:0 0 15px #38bdf8;
}

/* CURSOR */
.cursor{
    width:20px;
    height:20px;
    border:2px solid #38bdf8;
    border-radius:50%;
    position:fixed;
    pointer-events:none;
    transform:translate(-50%,-50%);
    transition:0.1s;
}

/* SCROLL TEXT */
.scroll-text{
    position:absolute;
    bottom:20px;
    width:100%;
    text-align:center;
    font-size:14px;
    opacity:0.6;
}
</style>
</head>

<body>

<canvas id="canvas"></canvas>
<div class="cursor" id="cursor"></div>

<div class="container">
    <div class="card">
        <h1> SmartHome Manager</h1>
        <p>Control your virtual home with style </p>

        <a href="register.php" class="btn register">Register Now</a>
        <a href="login.php" class="btn login">Login</a>
    </div>
</div>

<div class="scroll-text">Move mouse / Click / Scroll </div>

<script>

// ================= 3JS BACKGROUND =================
const scene = new THREE.Scene();
const camera = new THREE.PerspectiveCamera(75, window.innerWidth/window.innerHeight, 0.1, 1000);

const renderer = new THREE.WebGLRenderer({
    canvas:document.getElementById('canvas'),
    alpha:true
});
renderer.setSize(window.innerWidth, window.innerHeight);

// Geometry
const geometry = new THREE.TorusKnotGeometry(120, 30, 100, 16);
const material = new THREE.MeshBasicMaterial({
    color:0x38bdf8,
    wireframe:true
});

const knot = new THREE.Mesh(geometry, material);
scene.add(knot);

camera.position.z = 400;

// ================= INTERACTION =================
let mouseX = 0;
let mouseY = 0;

window.addEventListener('mousemove',(e)=>{
    mouseX = (e.clientX / window.innerWidth - 0.5);
    mouseY = (e.clientY / window.innerHeight - 0.5);
});

// CLICK EFFECT 💥
window.addEventListener('click', ()=>{
    knot.scale.set(1.5,1.5,1.5);

    setTimeout(()=>{
        knot.scale.set(1,1,1);
    },200);
});

// SCROLL EFFECT 🔄
window.addEventListener('wheel', ()=>{
    knot.rotation.z += 0.3;
});

// KEY PRESS COLOR 🌈
window.addEventListener('keydown', ()=>{
    material.color.setHex(Math.random()*0xffffff);
});

// ANIMATION LOOP
function animate(){
    requestAnimationFrame(animate);

    knot.rotation.x += 0.01 + mouseY * 0.05;
    knot.rotation.y += 0.01 + mouseX * 0.05;

    renderer.render(scene,camera);
}
animate();

// ================= CURSOR =================
const cursor = document.getElementById('cursor');

window.addEventListener('mousemove',(e)=>{
    cursor.style.top = e.clientY + 'px';
    cursor.style.left = e.clientX + 'px';
});

// RESIZE FIX
window.addEventListener('resize', ()=>{
    renderer.setSize(window.innerWidth, window.innerHeight);
    camera.aspect = window.innerWidth / window.innerHeight;
    camera.updateProjectionMatrix();
});

</script>

</body>
</html>
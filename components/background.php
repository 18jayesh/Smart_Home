<!-- CANVAS -->
<canvas id="canvas"></canvas>

<script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.js"></script>

<script>
// 3JS BACKGROUND
const scene = new THREE.Scene();
const camera = new THREE.PerspectiveCamera(75, window.innerWidth/window.innerHeight, 0.1, 1000);

const renderer = new THREE.WebGLRenderer({
    canvas: document.getElementById('canvas'),
    alpha: true
});
renderer.setSize(window.innerWidth, window.innerHeight);

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

window.addEventListener('mousemove', (e)=>{
    mouseX = (e.clientX / window.innerWidth - 0.5);
    mouseY = (e.clientY / window.innerHeight - 0.5);
});

// Click
window.addEventListener('click', ()=>{
    knot.scale.set(1.3,1.3,1.3);
    setTimeout(()=>knot.scale.set(1,1,1),200);
});

// Animate
function animate(){
    requestAnimationFrame(animate);
    knot.rotation.x += 0.01 + mouseY * 0.05;
    knot.rotation.y += 0.01 + mouseX * 0.05;
    renderer.render(scene, camera);
}
animate();

// Resize
window.addEventListener('resize', ()=>{
    renderer.setSize(window.innerWidth, window.innerHeight);
    camera.aspect = window.innerWidth / window.innerHeight;
    camera.updateProjectionMatrix();
});
</script>

<style>
#canvas{
    position:fixed;
    top:0;
    left:0;
    width:100%;
    height:100%;
    z-index:-1;
}
</style>
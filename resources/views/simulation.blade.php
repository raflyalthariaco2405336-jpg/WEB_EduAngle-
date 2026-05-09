@extends('layouts.app')

@section('content')
<section class="page-header" style="padding-top: 120px; padding-bottom: 30px;">
    <div class="container">
        <h1>Simulasi 3D Angle Kamera</h1>
        <p style="color: var(--text-muted);">Pilih tombol angle untuk melihat perubahan sudut pandang kamera secara interaktif!</p>
    </div>
</section>

<section class="container" style="padding-bottom: 6rem;">
    <div class="glass-panel" style="padding: 2rem; display: flex; flex-direction: column; gap: 2rem;">
        
        <!-- Controls -->
        <div style="display: flex; gap: 1rem; flex-wrap: wrap; justify-content: center;">
            <button class="btn btn-primary" onclick="setAngle('eyeLevel')">Eye Level</button>
            <button class="btn" style="background: rgba(14, 165, 233, 0.8); color: white;" onclick="setAngle('highAngle')">High Angle</button>
            <button class="btn" style="background: rgba(244, 63, 94, 0.8); color: white;" onclick="setAngle('lowAngle')">Low Angle</button>
            <button class="btn" style="background: rgba(16, 185, 129, 0.8); color: white;" onclick="setAngle('birdEye')">Bird's Eye</button>
            <button class="btn" style="background: rgba(245, 158, 11, 0.8); color: white;" onclick="setAngle('frogEye')">Frog's Eye</button>
        </div>

        <!-- 3D Canvas Container -->
        <div id="canvas-container" style="width: 100%; height: 500px; border-radius: 8px; overflow: hidden; background: #0f172a; border: 1px solid var(--glass-border); position: relative;">
            <div id="angleInfo" style="position: absolute; top: 20px; left: 20px; background: rgba(0,0,0,0.6); padding: 10px 15px; border-radius: 5px; color: white; border: 1px solid rgba(255,255,255,0.2); font-family: monospace; pointer-events: none;">
                Geser dengan mouse untuk rotasi bebas.
            </div>
        </div>

    </div>
</section>

<!-- Include Three.js via CDN -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.js"></script>
<!-- Include OrbitControls -->
<script src="https://cdn.jsdelivr.net/npm/three@0.128.0/examples/js/controls/OrbitControls.js"></script>

<script>
    const container = document.getElementById('canvas-container');
    const angleInfo = document.getElementById('angleInfo');
    
    // Scene setup
    const scene = new THREE.Scene();
    scene.background = new THREE.Color(0x0f172a);
    scene.fog = new THREE.Fog(0x0f172a, 10, 50);

    // Camera setup
    const camera = new THREE.PerspectiveCamera(45, container.clientWidth / container.clientHeight, 0.1, 100);
    camera.position.set(0, 1.5, 6);

    // Renderer setup
    const renderer = new THREE.WebGLRenderer({ antialias: true });
    renderer.setSize(container.clientWidth, container.clientHeight);
    renderer.shadowMap.enabled = true;
    container.appendChild(renderer.domElement);

    // Controls
    const controls = new THREE.OrbitControls(camera, renderer.domElement);
    controls.enableDamping = true;
    controls.dampingFactor = 0.05;
    controls.target.set(0, 1, 0); // Look at center of object
    controls.maxPolarAngle = Math.PI; // allow full rotation

    // Lighting
    const ambientLight = new THREE.AmbientLight(0xffffff, 0.6);
    scene.add(ambientLight);

    const dirLight = new THREE.DirectionalLight(0xffffff, 0.8);
    dirLight.position.set(5, 10, 5);
    dirLight.castShadow = true;
    scene.add(dirLight);

    // Grid and Floor
    const gridHelper = new THREE.GridHelper(20, 20, 0x475569, 0x334155);
    scene.add(gridHelper);

    const floorGeometry = new THREE.PlaneGeometry(20, 20);
    const floorMaterial = new THREE.MeshStandardMaterial({ color: 0x1e293b });
    const floor = new THREE.Mesh(floorGeometry, floorMaterial);
    floor.rotation.x = -Math.PI / 2;
    floor.receiveShadow = true;
    scene.add(floor);

    // Create a simple "human" proxy (e.g. snowman-like spheres + box for body)
    const subjectGroup = new THREE.Group();

    // Body
    const bodyGeo = new THREE.BoxGeometry(1, 1.5, 0.5);
    const bodyMat = new THREE.MeshStandardMaterial({ color: 0x3b82f6 });
    const body = new THREE.Mesh(bodyGeo, bodyMat);
    body.position.y = 0.75;
    body.castShadow = true;
    subjectGroup.add(body);

    // Head
    const headGeo = new THREE.SphereGeometry(0.4, 32, 32);
    const headMat = new THREE.MeshStandardMaterial({ color: 0xfca5a5 });
    const head = new THREE.Mesh(headGeo, headMat);
    head.position.y = 1.9;
    head.castShadow = true;

    // Face direction indicator (nose)
    const noseGeo = new THREE.ConeGeometry(0.05, 0.2, 8);
    const noseMat = new THREE.MeshStandardMaterial({ color: 0xfca5a5 });
    const nose = new THREE.Mesh(noseGeo, noseMat);
    nose.position.z = 0.4;
    nose.rotation.x = Math.PI / 2;
    head.add(nose);

    subjectGroup.add(head);
    scene.add(subjectGroup);

    // Animation Loop
    function animate() {
        requestAnimationFrame(animate);
        controls.update();
        renderer.render(scene, camera);
        
        // Update Info
        const yPos = camera.position.y.toFixed(2);
        const zPos = camera.position.z.toFixed(2);
        let dist = camera.position.distanceTo(controls.target).toFixed(2);
        angleInfo.innerHTML = `Mode Bebas | Jarak: ${dist}m<br>Kamera Y: ${yPos} | Z: ${zPos}`;
    }
    animate();

    // Predefined Angles
    function setAngle(mode) {
        // We use gsap-like manual tweening for smoothness, or just instant snap.
        // For simplicity, we snap it then update.
        switch(mode) {
            case 'eyeLevel':
                camera.position.set(0, 1.7, 5); // sejajar mata (1.9)
                controls.target.set(0, 1.7, 0);
                angleInfo.innerHTML = "Eye Level: Kamera sejajar dengan mata subjek.";
                break;
            case 'highAngle':
                camera.position.set(0, 4, 4);
                controls.target.set(0, 1, 0);
                angleInfo.innerHTML = "High Angle: Meremehkan/melemahkan subjek.";
                break;
            case 'lowAngle':
                camera.position.set(0, 0.2, 3);
                controls.target.set(0, 1.5, 0);
                angleInfo.innerHTML = "Low Angle: Kesan agung/herois/kuat.";
                break;
            case 'birdEye':
                camera.position.set(0, 8, 0.1); // Z sedikit offset agar tidak gimbal lock
                controls.target.set(0, 1, 0);
                angleInfo.innerHTML = "Bird's Eye: Pengintaian absolut dari atas.";
                break;
            case 'frogEye':
                camera.position.set(0, 0.05, 3); // sangat rendah, menempel tanah
                controls.target.set(0, 2, 0);
                angleInfo.innerHTML = "Frog's Eye: Sangat fantastis / dramatis.";
                break;
        }
        controls.update();
    }

    // Handle Resize
    window.addEventListener('resize', onWindowResize, false);
    function onWindowResize() {
        camera.aspect = container.clientWidth / container.clientHeight;
        camera.updateProjectionMatrix();
        renderer.setSize(container.clientWidth, container.clientHeight);
    }
</script>
@endsection

<!DOCTYPE html>
<html>
	<head>
		<meta charset=utf-8>
		<title>iridium</title>
		<style>
			body { margin: 0; }
			canvas { width: 100%; height: 100% }
		</style>
	</head>
	<body>
		<script src="js/three.js"></script>
		<script src="js/OrbitControlls.js"></script>
		<script src="js/core.js"></script>
		<script src="js/satellite.js"></script>
		<script>
		    var scene = new THREE.Scene();
		    
		    function scale(x){
			return x * 0.0235 ;
		    }
		    
		    var tle = {
		    "first_line":  "1 24792U 97020A   17117.72417435  .00000125  00000-0  37405-4 0  9993",
		    "second_line": "2 24792  86.3959 339.7993 0002069  86.3575 273.7858 14.34222785 45737"
		    }

		    var date = new Date();
		    var time = new Orb.Time(date);
		    var timestamp = Math.round(date.getTime()/1000);	
		    
//		    //Date 2017-04-30T11:21:43.049Z
		    
		    function vrati(TStartDate, TEndDate){
			var TStartDate = date.TStartTimestamp*1000;
			var TEndDate = date.TEndTimestamp*1000;
			return {
			    'startTime': TStartDate,
			    'endTime': TEndDate
			};
		    }
		    
		    var satellite = new Orb.Satellite(tle);
		    
		    var period = satellite.orbital_period * 60;
		    
		    var T1 = timestamp - (period / 2);
		    var T2 = timestamp + (period / 2);
		    var deltaT = 30;
		    
		    var material = new THREE.LineBasicMaterial({color: new THREE.Color(255, 255, 255)});
		    var geometry = new THREE.Geometry();
		    
		    while(T1 < T2) {
			var time = new Orb.Time(new Date(parseInt(T1)));
			var rect = satellite.position.rectangular(time);
			
			
			geometry.vertices.push(new THREE.Vector3(scale(rect.x), scale(rect.y), scale(rect.z)));
			
			
			console.log(scale(6371));
			console.log(scale(rect.x));
			
			T1 += deltaT;
		    }
		    
		    var orbit = new THREE.Line(geometry, material);
		    
		    
		    //var rect = satellite.position.rectangular(time);
		    
		    var date = new Date();
		    var time = new Orb.Time(date);
		    var TSum = Math.round(date.getTime()+6000);
		    
		    for(i=1;i<=10;i++){
			console.log(i);
		    var material = new THREE.LineBasicMaterial({color: new THREE.Color(255, 255, 255)});
		    var geometry = new THREE.Geometry();
		    geometry.vertices.push(new THREE.Vector3(0, 0, 0));
		    geometry.vertices.push(new THREE.Vector3(i,i+1,i+2));
		    var radius = new THREE.Line(geometry, material);
		    scene.add(radius);
		    }
		    
//		    console.log(date);
//		    console.log(rect);
//		    console.log(satellite);
//		    console.log(time);
//		    console.log(TSum);
//		    console.log(rect.x);
		    //1493552611
		    //1493552551
		    
//		    var material = new THREE.LineBasicMaterial({color: new THREE.Color(255, 255, 255)});
//		    var geometry = new THREE.Geometry();
//		    geometry.vertices.push(new THREE.Vector3(0, 0, 0));
//		    geometry.vertices.push(new THREE.Vector3(rect.x,rect.y,rect.z));
//		    var radius = new THREE.Line(geometry, material);
//		    scene.add(radius);
		    
		    
		    //utc_string:"2017-04-30 10:25:28"
		    
		    var camera = new THREE.PerspectiveCamera(90, window.innerWidth / window.innerHeight, 1, 1000);
		    camera.position.set(0,50, 0);
		    camera.lookAt(new THREE.Vector3(0, 0, 0));
		    
		    var fov = 75;
		
		    /* putanja po kojoj se krece satelit */
		    
//		    var curve = new THREE.EllipseCurve(
//			    0,0,            // ax, aY
//			    4,4,           // xRadius, yRadius
//			    1772.4613613036884, -1.771,  // aStartAngle, aEndAngle
//			    true,            // aClockwise
//			    6                 // aRotation
//		    );
	    
		    //vektor
		    //var material = new THREE.LineBasicMaterial({color: new THREE.Color(255, 255, 255)});
		    //var geometry = new THREE.Geometry();
		    //geometry.vertices.push(new THREE.Vector3(0, 0, 0));
		    //geometry.vertices.push(new THREE.Vector3(3,3,3));
		    //var radius = new THREE.Line(geometry, material);
		    //scene.add(radius);
		    //this.render();
		    // kraj vektor
		    
		    //satelit
		    
		    
		    
//		    var geometry = new THREE.Geometry();
//		    geometry.vertices.push(new THREE.Vector3(0, 0, 0));
//		    geometry.vertices.push(new THREE.Vector3(1772.4613613036884,
//		    -222.44929424692108,6920.391516675158));
//		    var satelit = new THREE.Line(geometry, material,{color: new THREE.Color(255, 255, 255)} );
		    //scene.add(satelit);
		    
		    //kraj satelit
		    
//		    var path = new THREE.Path( curve.getPoints( 50 ) );
//		    var geometry = path.createPointsGeometry( 50 );
//		    var material = new THREE.LineBasicMaterial( { color : 0xff0000 } );

		    // Create the final object to add to the scene
		    var ellipse = new THREE.Line( geometry, material );
		    scene.add(ellipse);
		    // aspect ratio - use full width of container / height
		    var aspect = window.innerWidth / window.innerHeight;
		    // setup the clipping plane
		    var near = 0.1; // front clipping plane
		    var far  = 10; // back clipping plane
		    // create new camera with defined vars from above
		    var camera = new THREE.PerspectiveCamera( fov, aspect, near, far );
		    // create a new WebGLRenderer object
		    var renderer = new THREE.WebGLRenderer();
		    // set the size of the rending window -- smaller than full	
		    // and window.innerHeight / 2 would result in HALF the resolution)
		    renderer.setSize( window.innerWidth, window.innerHeight );
		    // add the renderer to our page. This is the canvas element that the renderer uses
		    // to display our scene
		    document.body.appendChild( renderer.domElement );

		    // setup dimensions of the sphere
		    var radius = scale(3);
		    // moar segments == moar roundedness!
		    var widthSegments = 80;
		    var heightSegments = 80;

		    var geometry = new THREE.SphereGeometry( radius, widthSegments, heightSegments );
		    // setup material to wrap geometry with
		    // wireframe line width won't change no matter what value is set
		    // reason: Due to limitations in the ANGLE (https://code.google.com/p/angleproject/) layer
		    // on Windows platforms linewidth will always be 1 regardless of the set value.
		    var material = new THREE.MeshBasicMaterial( { color: 0x00FF7F, wireframe: true } ); //0x2980b9
		    // the Mesh object takes a geometry and applies a material to it that can be
		    // inserted into the scene and be moved around
		    var sphere = new THREE.Mesh( geometry, material );
		    // add to our scene
		    //scene.add( sphere );

		    // move the camera from default ( 0, 0, 0 )
		    // so the camera & sphere don't fall into the same location
		    camera.position.z = 0.2;

		    // create render function. We use requestAnimationFrame instead of setInterval
		    // because it pauses when the user navigates to another browser tab
		    function render(){
		    requestAnimationFrame( render );
		    // rotation logic goes here
		    var axisHelper = new THREE.AxisHelper( 8 );
		    scene.add( axisHelper );
		    scene.add(orbit);
		    renderer.render( scene, camera );

		    }

			this.controls = new THREE.OrbitControls(this.camera);
			this.controls.damping = 2;
			this.controls.addEventListener('change', () => {
			this.renderer.render(this.scene, this.camera);
		    });
		// call our render function to display the sphere
			render();
	</script>
	
	koordinate satelita x: 1772.4613613036884, y: -222.44929424692108, z: 6920.391516675158,
	
	</body>
</html>

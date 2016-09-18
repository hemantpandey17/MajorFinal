 
 
<!DOCTYPE html>
<html>
<head>
	<title>Major Project</title>
	<script src="script/jquery.js"></script>
	<!--script src="http://maps.googleapis.com/maps/api/js?sensor=false"></script-->
	<link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,500,700" rel="stylesheet" type="text/css">
	<link rel="stylesheet" href="css/reset.css">
	<link rel="stylesheet" href="css/other.css">
	<link rel="stylesheet" href="css/main.css">	
</head>
<body>
<div class="container">
	<div class="left-sidebar">
		<div class="profile-area">

		</div>

		<div class="get-recommendation">
			<button onClick="getRecommendation()">Get Recommendations</button>
		</div>
		
		<div class="list">
			<div id="list"></div>
		</div>
	</div>

	<div class="right-area">
		<div class="topbar">
			<span class="id">User ID:</span>
			<input class="id-text" type="text" value="1">
			<span class="radius">Radius:</span>
			<input class="radius-text" type="text" value="3">
			<span class="radius-miles">miles</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp <a href="index.php">Logout</a>
		</div>

		<div class="right-content">
			<div id="map"></div>
		</div>
	</div>

</div>
<script>
	var map;
      function initMap() {
        map = new google.maps.Map(document.getElementById('map'), {
          center: {lat: 28.644800, lng: 77.216721},
          zoom: 12,
          mapTypeId: google.maps.MapTypeId.ROADMAP
        });
        $(document).ready(function(){
        	getLocation();	
        });
        
      }
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBq7wxEOm7rUlYlskJ9KP-stet-JiqQP30&callback=initMap"
    async defer></script>
<script src="script/myscriptv3.js"></script>
</body>
</html>
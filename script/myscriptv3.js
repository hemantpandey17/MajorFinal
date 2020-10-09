	//Variable Declarations
	var myLatLng;    //holds my [user] lattitude and longitude [google maps object]
	var icons = {
		red: "http://labs.google.com/ridefinder/images/mm_20_red.png",
		blue: "http://labs.google.com/ridefinder/images/mm_20_blue.png"
	}
	var people;     //holds all the recommended people within set radius

    /*
    Function to get user location. It uses HTML5 geo-location api.
    The function is called on button(Recommend) click. 
    */

	function getLocation(){	
		if(navigator.geolocation){
			navigator.geolocation.getCurrentPosition(setPosition);
		}
		else{
			alert("Geolocation is not supported by this browser.;")
		}
	} // end getLocation

	/*
    Function to set user location. It calls getMyPos().
    */

	function setPosition(position){
		lat = position.coords.latitude;
		lon = position.coords.longitude;
		myLatLng = new google.maps.LatLng(lat,lon);
		getMyPos(myLatLng);

	} //end setPosition
	
	/*
    Function to resize map area according to browser's current window height and width.
    */
	$(document).ready(function(){
			var height = $(window).height(); 		//Getting window height
			$("#map").height(height-70);			
			$(window).on('resize',function(){		//resizing map according
    		height = $(window).height(); 			//windows height
    		$("#map").height(height-70);
		});// end resize
	});// end ready for resize


	/*
    Function to put marker on map at user's current location.
    */
	function getMyPos(myLatLng){	
		console.log(myLatLng.toString());
		map.panTo(myLatLng);
		var myMarker = new google.maps.Marker({
		    position: myLatLng,
		    map: map,
		    title: 'My Position',
		    animation: google.maps.Animation.DROP
		 });
	}//end getMyPos

	/*
    Function fired when 'Get Recommendation' button is clicked
    */
	function getRecommendation(){
			var uid = $('.id-text').val();			//get id from textbox
			var rad = $('.radius-text').val();		//get radius from textbox
			var lat = myLatLng.lat();
			var lng = myLatLng.lng();
			getMyInfo(uid);
			var datasent = {lt: lat, ln: lng,id: uid, rd: rad};
			$.ajax({
				type: 'post',
				url: 'getpeople.php',
				data: datasent,
				dataType: 'text',
				success: ajaxsuccess
			});// end ajax
	}//end getRecommendation

	/*
    Function fired when recommendations have been fetched from database
    */
	function ajaxsuccess(datarecv){
		var outarr = datarecv.split('~');		//splitting recieved data based on delimiter(~)
		$('#list').html('');
		markCircle();							//marking circle on map with set radius
		people = {};						    
		var count = 0;
		for (var i = 0; i < outarr.length - 1; i++) {
			inarr = outarr[i].split(',');
			var id = inarr[0];
			var person = {};                    //creating each person using fetched details
			person.id = id;
			person.lat = inarr[1];
			person.lng = inarr[2];
			person.latLng = new google.maps.LatLng(person.lat,person.lng);
			person.distance = Number(inarr[3]).toPrecision(2);
			person.affinity = Number(inarr[4]).toPrecision(3);
			var personStr = JSON.stringify(person);
			people[id] = person;
			$("#list").append(                           //adding each person on side list
				'<div class="list-element cf">'+
				'<div class="uidClass">'+person.id+'</div>'+
				'<div class="latClass">'+person.lat+'</div>'+
				'<div class="lonClass">'+person.lng+'</div>'+
				'<div class="distanceClass">'+person.distance+' miles </div>'+
				'<div class="affinityClass">'+person.affinity+' %</div>'+
				"<button data-user='"+personStr+"' onClick='openw()'>></button>");		
		}// end for
		markPeople(people);				//marking each person on the map
	} // end ajaxsuccess

	/*
    Function to get and display user's profile
    */
	function getMyInfo(uid){
		var datasent = {idd: uid};
			$.ajax({
				type: 'post',
				url: 'getmyinfo.php',
				data: datasent,
				dataType: 'text',
				success: function(datarecv){
					$('.profile-area').html('');
					$('.profile-area').append(datarecv);	//adding user profile data to profile section
				}//end 
			});// end ajax
	}//end getMyInfo

	/*
    Function to display circle on map
    */
	function markCircle(){
		var radius = $('.radius-text').val();
		radius = 1610*Number(radius);  //miles to meters
		var blueCircle = {
	      strokeColor: '#2980b9',
	      strokeOpacity: 0.4,
	      strokeWeight: 2,
	      fillColor: '#3498db',
	      fillOpacity: 0.4,
	      map: map,
	      center: myLatLng,
	      radius: radius
	    };
	    new google.maps.Circle(blueCircle);
	}// end markCircle

	/*
    Function to mark each person on the map
    */
	function markPeople(people){
		$.each(people, function(id, person) {
		    var marker = new google.maps.Marker({
			    position: person.latLng,
			    map: map,
			    icon: icons.red,
			    title: 'ID: '+person.id,
			    animation: google.maps.Animation.DROP
			 });
			person.marker = marker;
			person.marker.setMap(map);
			getPersonInfo(person);      //get each person's profile
		});			
	}//end markPeople

	/*
    Function to add infoWindow on each marker filled with person's profile data
    */
	function getPersonInfo(person){
		$.ajax({
				type: 'post',
				url: 'getpeopleinfo.php',
				data: {in: person.id},
				dataType: 'text',
				success: function(datarec){
					var infoWindow = new google.maps.InfoWindow({
					    content: datarec,
					    height: 400
					  });
					person.infoWindow = infoWindow;
					person.marker.addListener('click', function() {
					    infoWindow.open(map, person.marker);
					});
				}// end success
			});// end ajax
	}//end getPersonInfo

	/*
    Function fired when we click button against any person from recommended list
    */
	function openw(){
		var person = $(event.target).data('user')
		google.maps.event.trigger(people[person.id]['marker'], 'click');
	}// end openw
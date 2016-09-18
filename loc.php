$page = new Page('PHP Latitude Longitude Finder Form'); 
$page->link('<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>'); 
$page->link('<script type="text/javascript"> 
  function googleMaps (lat, lng, zoom) { 
    geocoder = new google.maps.Geocoder(); 
    var myLatlng = new google.maps.LatLng(lat, lng); 
    var myOptions = { 
      zoom: zoom, 
      center: myLatlng, 
      mapTypeId: google.maps.MapTypeId.TERRAIN 
    } 
    map = new google.maps.Map(document.getElementById("map_canvas"), myOptions); 
    var marker = new google.maps.Marker({ 
        position: myLatlng,  
        map: map 
    }); 
    google.maps.event.addListener(map, "center_changed", function(){ 
      document.getElementById("latitude").value = map.getCenter().lat(); 
      document.getElementById("longitude").value = map.getCenter().lng(); 
      marker.setPosition(map.getCenter()); 
      document.getElementById("zoom").value = map.getZoom(); 
    }); 
    google.maps.event.addListener(map, "zoom_changed", function(){ 
      document.getElementById("zoom").value = map.getZoom(); 
    }); 
  } 
</script>');

/*
We set up a basic google map, passing in our 'latitude', 'longitude', and 'zoom' parameters (line 4 above) which we'll do later on in our body tag. To send the latitude, longitude, and zoom information to the form we'll add two listeners (line 17 and 23 above). Every time the center of the map is changed or the zoom is adjusted, the form will be updated.
*/

$html = ''; 
$form = new Form; 
$form->required(array()); 
$form->values(array()); 
$form->check(array('latitude'=>'num', 'longitude'=>'num', 'zoom'=>'int')); 
list($vars, $errors, $eject) = $form->validate('gmaplatlon'); 
if (!empty($vars) && empty($errors)) { 
 
} 
$form->prompt(100); 
$html .= '<p>' . $form->field('text', 'address', 'Address:', array('width'=>550)) . '</p>'; 
$page->jquery('$("#address").change(function(){ 
  geocoder.geocode({"address": $(this).attr("value")}, function(results, status) { 
    if (status == google.maps.GeocoderStatus.OK) { 
      map.setZoom(14); 
      map.setCenter(results[0].geometry.location); 
    } else { 
      alert("Geocode was not successful for the following reason: " + status); 
    } 
  }); 
});'); 
$html .= '<div id="map_canvas" style="height:300px; margin:5px 0px;"></div><br />'

/*
The first 10 lines (above) should be familiar enough. We're just setting up the form. Notice that we're including the address field (line 11) before we call the $form->header() method, so that when a user enters an address and hits enter to see the result on the map the form isn't sent. On line 12 to 21 (above) we put in a jquery command so that whenever the address field changes, the address is geocoded and the map is repositioned; updating the form's latitude, longitude, and zoom fields right along with it. Then (line 22) we put in our google map div.
*/
$values = $form->values(); 
if (isset($values['latitude']) && !empty($values['latitude']) && isset($values['longitude']) && !empty($values['longitude'])) { 
  $zoom = (isset($values['zoom']) && !empty($values['zoom'])) ? $values['zoom'] : 14; 
  $page->body("onload="googleMaps({$values['latitude']}, {$values['longitude']}, {$zoom})""); 
} else { 
  $page->body('onload="googleMaps(39.2323, -97.3828, 3)"'); 
} 
$html .= $form->header('gmaplatlon'); 
$html .= '<p>' . $form->field('text', 'latitude', 'Latitude:', array('width'=>150)) . '</p>'; 
$html .= '<p>' . $form->field('text', 'longitude', 'Longitude:', array('width'=>150)) . '</p>'; 
$html .= '<p>' . $form->field('text', 'zoom', 'Zoom:', array('width'=>25)) . '</p>'; 
$html .= '<p>' . $form->field('submit', 'Submit', '&nbsp;') . '</p>'; 
$html .= $form->close(); 
unset($form); 
 
display_page ($html);

 /*
If the user submitted the form, or if you're presenting the form to edit information you've already saved, then it's nice to have the map already pre-positioned at the saved location. So above (line 1), we check the forms preselected values. If the latitude and longitude are set and not empty (line 2) then we insert those values when we call the googleMaps function (line 4) in the body tag's onload parameter. You can view the official documentation at:
*/
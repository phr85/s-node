{* Do not edit from here... *}

{literal}
    <script type="text/javascript" src="http://www.google.com/jsapi?key={/literal}{$xt7000_viewer.key}{literal}"></script>
    <script type="text/javascript">
        google.load("maps", "2", {"locale" : "{/literal}{$SYSTEM_LANG}{literal}"});
        function initialize() {
            var map = new google.maps.Map2(document.getElementById("map"));
            map.setCenter(new GLatLng{/literal}{$xt7000_viewer.markerlatlong}{literal}, {/literal}{$xt7000_viewer.mapzoom}{literal});
            
            // Map-Controller
            map.addControl(new GMapTypeControl());
            map.addControl(new GLargeMapControl());
            
            // Marker
            var marker = new GMarker(new GLatLng{/literal}{$xt7000_viewer.markerlatlong}{literal}, {draggable: false});
            map.addOverlay(marker);
            
            GEvent.addListener(marker, "click", function() {
				marker.openInfoWindowHtml('<h1>{/literal}{$xt7000_viewer.title}</h1>{$xt7000_viewer.description}{literal}');
			});
        }
    
        google.setOnLoadCallback(initialize);
    </script>
{/literal}

{* ...to here! Unless you know what you are doing. *}

<h1>{$xt7000_viewer.title}</h1>
{$xt7000_viewer.description}
<div id="map" style="float: left; width: {$xt7000_viewer.width}px; height: {$xt7000_viewer.height}px;"></div>
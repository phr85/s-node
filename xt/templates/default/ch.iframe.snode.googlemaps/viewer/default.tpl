<!--P0-->
{XT_load_css file="googlemaps.css"}
{if $xt9100_error}
	<div id="mapError">{$xt9100_error}</div>
{else}
{literal}
<script src="http://maps.google.com/maps?file=api&v=2&hl=de&key={/literal}{$xt9100_viewer.key}{literal}" type="text/javascript"></script>
<script type="text/javascript">
//<![CDATA[
// Variabeln definieren
var map;
var icon0;
var newpoints = new Array();

// Wird bei Laden der Seite uebergebene Funktion aufrufen.
function addLoadEvent(func) { 
	var oldonload = window.onload; 
	if (typeof window.onload != 'function'){ 
		window.onload = func
	} else { 
		window.onload = function() {
			oldonload();
			func();
		}
	}
}
{/literal}

addLoadEvent(loadIt);
{literal}
function loadIt() {
      if (GBrowserIsCompatible()) {{/literal}
      	// Map aufbauen
        var map = new GMap2(document.getElementById("map"));
        // User ermoeglichen selbst zoom und maptyp zu kontrollieren
        map.addControl(new GSmallMapControl());
        map.addControl(new GMapTypeControl());
        // Zentrum-Koordinaten setzen
        {if $xt9100_viewer.map.latitude !="" OR $xt9100_viewer.map.longitude != ""}
    		map.setCenter(new GLatLng({$xt9100_viewer.map.latitude},{$xt9100_viewer.map.longitude}), {$xt9100_viewer.map.zoom});
    	{else}
    		map.setCenter(new GLatLng(0,0), {$xt9100_viewer.map.zoom});
    	{/if}
    	// Maptyp setzen
        map.setMapType({$xt9100_viewer.map.type});
        // Adressen markieren + Infoboxen anhaengen
        {foreach from=$xt9100_viewer.address item="ADDRESS" name="ADDRESS"}
    		{if $ADDRESS.latitude !="" OR $ADDRESS.longitude != ""}
    			// Markierungen setzen
	        	{if $ADDRESS.icon}
					var Icon{$smarty.foreach.ADDRESS.iteration} = new GIcon(); 
					Icon{$smarty.foreach.ADDRESS.iteration}.image = "/download.php?file_id={$ADDRESS.icon}&file_version=orig";
					Icon{$smarty.foreach.ADDRESS.iteration}.iconAnchor = new GPoint(6, 20);
					Icon{$smarty.foreach.ADDRESS.iteration}.infoWindowAnchor = new GPoint(6, 1);
					var point{$smarty.foreach.ADDRESS.iteration} = new GLatLng({$ADDRESS.latitude},{$ADDRESS.longitude});
					var marker{$smarty.foreach.ADDRESS.iteration} = new GMarker(point{$smarty.foreach.ADDRESS.iteration} , Icon{$smarty.foreach.ADDRESS.iteration});
				{else}
					var point{$smarty.foreach.ADDRESS.iteration} = new GLatLng({$ADDRESS.latitude},{$ADDRESS.longitude});
					var marker{$smarty.foreach.ADDRESS.iteration} = new GMarker(point{$smarty.foreach.ADDRESS.iteration});
				{/if}
				// Listener hinzufuegen. Wenn Marker angeklickt wird, Infobox anzeugen.
				GEvent.addListener(marker{$smarty.foreach.ADDRESS.iteration},"click", function() {literal}{{/literal}
					map.openInfoWindowHtml(point{$smarty.foreach.ADDRESS.iteration}, '<div><strong>{$ADDRESS.title}</strong><p>{if $ADDRESS.image}<img src="/download.php?file_id={$ADDRESS.image}&file_version=2" class="left" />{/if}{$ADDRESS.description}</p>{if $ADDRESS.planer}<p><br clear="all" /><i><a href="/index.php?TPL={$xt9100_viewer.map.directiontpl}&x9100_addr_id={$ADDRESS.id}">{'Get Directions'|translate}</a></i>&nbsp;<br clear"all"/></p>{else}<p><br clear="all" /></p>{/if}</div>');
				{literal}
				});
				{/literal}
				// Marker aktivieren
				map.addOverlay(marker{$smarty.foreach.ADDRESS.iteration});
			{/if}
		{/foreach}
      }
}
//]]>
</script>
<h1 class="map">{$xt9100_viewer.map.title}</h1>
<div class="mapDescription">
{$xt9100_viewer.map.description}
<br />
{if $xt9100_viewer.map.image}{if $xt9100_viewer.map.image_zoom}<a href="/download.php?file_id={$xt9100_viewer.map.image}&file_version=orig&type=.jpg" class="thickbox">{/if}{image version=$xt9100_viewer.map.image_version id=$xt9100_viewer.map.image alt=$xt9100_viewer.map.title}{if $xt9100_viewer.map.image_zoom}</a>{/if}{/if}
</div>
<div style="float: right;">
<div id="map" style="width:{if $xt9100_viewer.map.width}{$xt9100_viewer.map.width}{else}400{/if}px;height:{if $xt9100_viewer.map.height}{$xt9100_viewer.map.height}{else}250{/if}px"></div>
<br /><br />
</div>
	{if $xt9100_viewer.map.listtpl}
		<br clear="all" />
		<a href="/index.php?TPL={$xt9100_viewer.map.listtpl}">{"Back to Maplist"|livetranslate}</a>
	{/if}
{/if}
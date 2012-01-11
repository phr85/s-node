{XT_load_css file="googlemaps.css"}
{literal}
<script src="http://maps.google.com/maps?file=api&v=2&hl=de&key={/literal}{$xt9100_directions.key}{literal}" type="text/javascript"></script>
<script type="text/javascript">
//<![CDATA[
// Define variables
var map;
var icon0;
var newpoints = new Array();

// Beim start uebergebene Funktion laden
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
      if (GBrowserIsCompatible()) {
      	// Neues Map-Objekt deklarieren
        map = new GMap2(document.getElementById("map_canvas"));
        // Zentrum festsetzen
        map.setCenter(new GLatLng({/literal}{$xt9100_directions.address.latitude},{$xt9100_directions.address.longitude}), {if $xt9100_directions.map.zoom !=""}{$xt9100_directions.map.zoom}{else}8{/if}{literal});
        // Neues Routenplaner-Objekt deklarieren
        gdir = new GDirections(map, document.getElementById("directions"));
        GEvent.addListener(gdir, "load", onGDirectionsLoad);
        GEvent.addListener(gdir, "error", handleErrors);
        {/literal}
        // Neuen Markerpunkt erstellen
        var point = new GLatLng({$xt9100_directions.address.latitude},{$xt9100_directions.address.longitude});        
        {literal}
        var marker = new GMarker(point);
        // Marker hinzufuegen
        map.addOverlay(marker);
        // Wenn Marker angeklickt wird, Infobild oeffnen
        GEvent.addListener(marker, "click", function() {{/literal}
            marker.openInfoWindowHtml("<div><strong>{$xt9100_directions.address.title}</strong><p>{if $xt9100_directions.address.image}<img src='/download.php?file_id={$xt9100_directions.address.image}&file_version=2' class='left' />{/if}{$xt9100_directions.address.description}</p></div>");
        
     	{literal}});
      }
}    
	// Diese Funktion setzt die Adresse fest
    function setDirections(fromAddress, toAddress, locale) {
      gdir.load("from: " + fromAddress + " to: " + toAddress,
                { "locale": locale });
    }

    // Hier werden Fehler gehandhabt
    function handleErrors(){
    	{/literal}
	   if (gdir.getStatus().code == G_GEO_UNKNOWN_ADDRESS)
	     alert('{"Es konnte kein passender geographischer Standort zu der von Ihnen angegebenen Adresse gefunden werden. Bitte überprüfen Sie die Adresse oder spezifizieren Sie diese gegebenenfalls. Fehlercode: "|translate} ' + gdir.getStatus().code);
	   else if (gdir.getStatus().code == G_GEO_SERVER_ERROR)
	     alert('{"Die Anfrage konnte nicht korrekt absolviert werden. Der Grund hierfür ist jedoch unbekannt. Fehlercode: "|translate}' + gdir.getStatus().code);
	   
	   else if (gdir.getStatus().code == G_GEO_MISSING_QUERY)
	     alert('{"Sie haben anscheinend vergessen die Adresse anzugeben. Bitte korrigieren Sie dies. Fehlercode: "|translate}' + gdir.getStatus().code);

	   else if (gdir.getStatus().code == G_GEO_BAD_KEY)
	     alert('{"Der von Ihnen in der Konfigurationsdatei angegebene API-Key scheint ung&uuml;ltig zu sein. Bitte korrigieren Sie dies indem sie auf http://code.google.com/intl/de/apis/maps/signup.html Ihre Domain anmelden. Fehlercode: "|translate}' + gdir.getStatus().code);

	   else if (gdir.getStatus().code == G_GEO_BAD_REQUEST)
	     alert('{"Ihre Anfrage konnte leider nicht erfolgreich abgeschlossen werden. Fehlercode: "|translate}' + gdir.getStatus().code);
	    
	   else alert('{"Ein unbekannter Fehler ist aufgetreten."|translate}');
	   {literal}
	}
    function onGDirectionsLoad(){
    	
    }
{/literal}

//]]>
</script>
<br clear="all" />
{if $xt9100_directions.address.latitude == "" && $xt9100_directions.address.longitude == ""}
{"Couldnt find coordinates"|translate}
<br />
{else}
  <h1>{"Map Directions"|translate}</h1>
  	{if $xt9100_error}
  		<div id="mapError">{$xt9100_error}</div>
	{else}
	<form action="#" onsubmit="setDirections(this.from.value, this.to.value, this.locale.value); return false;">
	<table>
	   <tr>
	   	<td colspan="3">&nbsp;</td>
	   </tr>
	   <tr><th align="right">{"Startpunkt"|translate}:</th>
	   <td><input type="text" size="25" id="fromAddress" name="from" /></td>
	   </tr>
	   <tr>
	   <th align="right">{"Endpunkt"|translate}:</th>
	   <td align="right"><input type="text" size="25" id="toAddress" name="to" value="{if $xt9100_directions.address.addr_street != "" OR $xt9100_directions.address.addr_city != ""}{$xt9100_directions.address.addr_street} {$xt9100_directions.address.addr_city}{else}{$xt9100_directions.address.address}{/if}" /></td></tr>
	
	   <tr>
	   	<td colspan="3">&nbsp;</td>
	   </tr>
	   <tr>
	   <td colspan="3">
	    <input type="hidden" name="locale" value="{$SYSTEM_LANG}" />
	    <input name="submit" type="submit" value="{"Get Directions"|translate}" />
	   </td></tr>
	   </table>
	
	    
	  </form>
	
	    <br/>
	    <table class="directions">
	    <tr><th>{"Route"|translate}</th><th>{"Map"|translate}</th></tr>
	
	    <tr>
	    <td valign="top"><div id="directions" style="width: 275px;"></div></td>
	    <td valign="top"><div id="map_canvas" style="width: 310px; height: 400px; margin: 14px 0pt 3px; "></div></td>
	    </tr>
	</table>
	{/if}
<br clear="all" />
{/if}
{if $xt9100_directions.viewertpl}<a href="/index.php?TPL={$xt9100_directions.viewertpl}&amp;x{$BASEID}_id={$xt9100_directions.address.map_id}">{"Back to the main map"|translate}</a>{/if}
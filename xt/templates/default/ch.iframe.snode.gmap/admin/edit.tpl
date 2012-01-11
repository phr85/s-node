{literal}
    <script type="text/javascript">
    //<![CDATA[
        window.parent.frames['master'].document.forms[1].submit();
                
        function initialize() {
            if (GBrowserIsCompatible()) {
                var map = new GMap2(document.getElementById("map"));
                
                // Kartentypen-Controller
                map.addControl(new GMapTypeControl());
                map.addControl(new GLargeMapControl());

                // mapzoom aktualisieren nach dem der Zoomfaktor verändert wurde
                GEvent.addListener(map, "zoomend", function() {
                    var center = map.getZoom();
                    document.getElementById("mapzoom").value = center.toString();
                });
                                    
{/literal}
{if $DATA.gmap.markerlatlong == ''}
{literal}
                map.setCenter(new GLatLng(46.818188,8.227512),6);
{/literal}
{else}
{literal}
                map.setCenter(new GLatLng{/literal}{$DATA.gmap.markerlatlong}{literal}, {/literal}{$DATA.gmap.mapzoom}{literal});
{/literal}
{/if}

{if $DATA.gmap.markerlatlong != ''}
{literal}
                var marker = new GMarker(new GLatLng{/literal}{$DATA.gmap.markerlatlong}{literal}, {draggable: true});
    
                // marker aktualisieren nach dem der Pin bewegt wurde
                GEvent.addListener(marker, "dragend", function() {
                    var point = marker.getPoint();
                    document.getElementById("markerlatlong").value = point.toString();
                });
    
                map.addOverlay(marker);
{/literal}
{/if}
{literal}
        }
    }
    
    function showAddress(address) {
        var map = new GMap2(document.getElementById("map"));
        
        // Kartentypen-Controller
        map.addControl(new GMapTypeControl());
        map.addControl(new GLargeMapControl());
        
        var geocoder = new GClientGeocoder();
        var marker;
        if (geocoder) {
            geocoder.getLatLng(
            address,
            function(point) {
                if (!point) {
                    alert(address + " not found");
                } else {
                    map.setCenter(point, 13);
                    var marker = new GMarker(point, {draggable: true});
                    document.getElementById("markerlatlong").value = point.toString();
                    map.addOverlay(marker);
                    
                    GEvent.addListener(marker, "dragend", function() {
                        var point = marker.getPoint();
                        document.getElementById("markerlatlong").value = point.toString();
                    });
                }
            }
            );
        }

        // mapzoom aktualisieren nach dem der Zoomfaktor verändert wurde
        GEvent.addListener(map, "zoomend", function() {
            var center = map.getZoom();
            document.getElementById("mapzoom").value = center.toString();
        });
                
    }
    google.setOnLoadCallback(initialize);


//]]>
</script>
{/literal}
<form method="post" name="edit" action="{$smarty.server.PHP_SELF}?TPL={$TPL}">
{include file="ch.iframe.snode.gmap/admin/hiddenValues.tpl"}
<input type="hidden" name="x{$BASEID}_gmapheader" value="true" />
<table cellspacing="0" cellpadding="0" width="100%">
<tr>
<td class="view_header" colspan="2"><span class="title_light">{"Google Map"|translate}:</span> <span class="title">{$DATA.gmap.title}</span></td>
</tr>
<tr>
<td class="view_separator" colspan="4"><img src="{$XT_IMAGES}spacer.gif" alt="" /></td>
</tr>
<tr>
<td colspan="2">{include file="includes/buttons.tpl" data=$BUTTONS withouthidden="1"}</td>
</tr>
<tr>
<td class="view_separator" colspan="4"><img src="{$XT_IMAGES}spacer.gif" alt="" /></td>
</tr>
<tr>
<td class="left">{"Title"|translate}</td>
<td class="right"><input type="text" name="x{$BASEID}_title" size="42" value="{$DATA.gmap.title|htmlspecialchars}" /></td>
</tr>
<tr>
<td class="left">{"Description"|translate}</td>
<td class="right">{toggle_editor id="description"}<textarea id="x{$BASEID}_description" name="x{$BASEID}_description" rows="4" cols="40">{$DATA.gmap.description}</textarea></td>
</tr>
<tr>
<td class="view_header" colspan="2"><span class="title">{"Einstellungen"|translate}</span></td>
</tr>
<tr>
<td class="view_separator" colspan="4"><img src="{$XT_IMAGES}spacer.gif" alt="" /></td>
</tr>
<tr>
<td class="right" colspan="4">
</tr>
</table>

<table cellspacing="0" cellpadding="0" width="100%">
  <p>
    <input type="text" size="60" name="address" value="Bahnhofstrasse 5, 9435 Heerbrugg, Switzerland" />
    <a href="javascript:showAddress(document.forms['edit'].address.value);">Auf der Karte suchen...</a>
  </p>
<div id="map" style="float: left; width: 400px; height: 400px;"></div>
<div style="float: left; width: 100px; margin-left: 10px;">
zoomlevel: <input size="20" style="border: 1px solid grey;" type="text" readonly="readonly" id="mapzoom" name="x{$BASEID}_mapzoom" size="42" value="{$DATA.gmap.mapzoom}" /><br /><br />
Marker-Position: <input size="20" style="border: 1px solid grey;" type="text" readonly="readonly" id="markerlatlong" name="x{$BASEID}_markerlatlong" size="42" value="{$DATA.gmap.markerlatlong}" />
</div>

</td>
</tr>
</table>
</form>
{include file="includes/editor.tpl"}

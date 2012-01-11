{literal}
		<style type="text/css" media="screen"><!--
.hiddenDiv {
	display: none;
	margin: 10px 0px 0px 0px;
	}
.visibleDiv {
	margin: 10px 0px 0px 0px;
	display: block;
	}

--></style>
		
<script type="text/javascript"><!--
function changeme(id, group) {
		$('.' + group).hide();
		$('#' + id).show();
}
//-->
</script>
{/literal}
<form method="post" name="edit" action="{$smarty.server.PHP_SELF}?TPL={$TPL}" onSubmit="window.document.forms['edit'].x{$BASEID}_yoffset.value= window.pageYOffset;">
{include file="ch.iframe.snode.googlemaps/admin/hiddenValues.tpl"}
	<table cellspacing="0" cellpadding="0" width="100%">
	{if $ERRORS != "" OR $NON_CRUCIAL_ERRORS != ""}
	<tr>
		<td class="error_msg" colspan="4">
			{foreach name="errors" from=$ERRORS key="error" item="ERROR"}
				{$ERROR}
			{/foreach}
			{foreach name="errors2" from=$NON_CRUCIAL_ERRORS key="error" item="ERROR"}
				{$ERROR.address} {$ERROR.title}
			{/foreach}
		</td>
	</tr>
	{/if}
		<tr>
			<td class="view_header" colspan="2"><span class="title_light">{"Edit Map"|translate}:</span> <span class="title">{$DATA.map.title}</span></td>
		</tr>
		<tr>
			<td class="view_separator" colspan="4"><img src="{$XT_IMAGES}spacer.gif" alt="" /></td>
		</tr>
		<tr>
			<td colspan="2">{include file="includes/buttons.tpl" data=$BUTTONS withouthidden="1"}
				{include file="includes/lang_selector_submit.tpl" form="edit"}
			</td>
		</tr>
		<tr>
			<td class="left">{"Status"|translate}</td>
			<td class="right">
				<input type="hidden" name="x{$BASEID}_published" value="{$DATA.map.published}" />
				{if $DATA.map.active}
					{actionIcon 
			        action="deactivateMapEdit"
			        icon="active.png"
			        form="edit"
			        perm="statuschange"
			        id=$DATA.map.id
			        title="Deactivate this map"}
			    {else}
			       	{actionIcon 
			        action="activateMapEdit"
			        icon="inactive.png"
			        form="edit"
			        perm="statuschange"
			        id=$DATA.map.id
			        title="Activate this map"}
			    {/if}
				{if $DATA.map.lang == "de"}
					<img src="{$XT_IMAGES}lang/de.png" alt="Deutsch" />
				{elseif $DATA.map.lang == "fr"}
					<img src="{$XT_IMAGES}lang/fr.png" alt="Français" />
				{elseif $DATA.map.lang == "en"}
					<img src="{$XT_IMAGES}lang/en.png" alt="English" />
				{/if}
			</td>
		</tr>
		<tr>
			<td class="left">{"Title"|translate}</td>
			<td class="right"><input type="text" name="x{$BASEID}_title" size="42" value="{$DATA.map.title|htmlspecialchars}" /></td>
		</tr>
		<tr>
			<td class="left">{"Description"|translate}</td>
			<td class="right">{toggle_editor id="description"}<textarea id="x{$BASEID}_description" name="x{$BASEID}_description" rows="4" cols="40">{$DATA.map.description}</textarea></td>
		</tr>
		<tr>
			<td class="left">{"Map Center"|translate}</td>
			<td class="right">
  			<select name="x{$BASEID}_address_type" size="1" onchange="changeme(this.value,'mainaddr');">
				<option value="">{"Bitte selektieren"|translate}</option>
				<option {if $DATA.map.address_type == 1}selected="selected"{/if} value="1_addr">{"Adresse eingeben"|translate}</option>
				<option {if $DATA.map.address_type == 2}selected="selected"{/if} value="2_addr">{"Koordinaten eingeben"|translate}</option>
			</select>
			<div id="1_addr" class="{if $DATA.map.address_type == 1}visibleDiv{else}hiddenDiv{/if} mainaddr">
				<input type="text" name="x{$BASEID}_address" value="{$DATA.map.address}" size="42" />
			</div>
			<div id="2_addr" class="{if $DATA.map.address_type == 2}visibleDiv{else}hiddenDiv{/if} mainaddr">
				<a onclick="document.getElementById('mapCoordinateHelp').style.display='inline'; return false;" href="#">{"whatis"|translate}</a>
				<br />
				<div style="float: left; width: 60px;">Latitude:</div><div style="float: left; margin: 0px 0px 0px 10px;"><input type="text" name="x{$BASEID}_latitude" value="{$DATA.map.latitude}" size="29" /></div>
				<br /><br />
				<div style="float: left; width: 60px;">Longitude:</div><div style="float: left; margin: 0px 0px 0px 10px;"><input type="text" name="x{$BASEID}_longitude" value="{$DATA.map.longitude}" size="29" /></div>
				<br /><br />
				<div style="display: none;" id="mapCoordinateHelp">{"if cannot determine address"|translate} <a target="_blank" href="http://www.mygeoposition.com/">MyGeoPosition</a>.</div>
			</div>
			</td>
		</tr>
		<tr>
			<td class="left">{"Map Type"|translate}</td>
			<td class="right">
							<select name="x{$BASEID}_mapType">
								<option {if $DATA.map.type == 1}selected{/if} value="1">Standart</option>
								<option {if $DATA.map.type == 2}selected{/if} value="2">Statellite</option>
								<option {if $DATA.map.type == 3}selected{/if} value="3">Hybrid</option>
								<option {if $DATA.map.type == 4}selected{/if} value="4">Physical</option>
							</select>
			</td>
		</tr>
		<tr>
			<td class="left">{"Zoom level"|translate}</td>
			<td class="right">
							<select name="x{$BASEID}_zoomLevel">
								<option {if $DATA.map.zoom == 1}selected{/if} value="1">1</option>
								<option {if $DATA.map.zoom == 2}selected{/if} value="2">2</option>
								<option {if $DATA.map.zoom == 3}selected{/if} value="3">3</option>
								<option {if $DATA.map.zoom == 4}selected{/if} value="4">4</option>
								<option {if $DATA.map.zoom == 5}selected{/if} value="5">5</option>
								<option {if $DATA.map.zoom == 6}selected{/if} value="6">6</option>
								<option {if $DATA.map.zoom == 7}selected{/if} value="7">7</option>
								<option {if $DATA.map.zoom == 8}selected{/if} value="8">8</option>
								<option {if $DATA.map.zoom == 9}selected{/if} value="9">9</option>
								<option {if $DATA.map.zoom == 10}selected{/if} value="10">10</option>
								<option {if $DATA.map.zoom == 11}selected{/if} value="11">11</option>
								<option {if $DATA.map.zoom == 12}selected{/if} value="12">12</option>
								<option {if $DATA.map.zoom == 13}selected{/if} value="13">13</option>
								<option {if $DATA.map.zoom == 14}selected{/if} value="14">14</option>
								<option {if $DATA.map.zoom == 15}selected{/if} value="15">15</option>
								<option {if $DATA.map.zoom == 16}selected{/if} value="16">16</option>
								<option {if $DATA.map.zoom == 17}selected{/if} value="17">17</option>
								<option {if $DATA.map.zoom == 18}selected{/if} value="18">18</option>
								<option {if $DATA.map.zoom == 19}selected{/if} value="19">19</option>
							</select>
			</td>
		</tr>
		<tr>
			<td class="view_header" colspan="2"><span class="title">{"Hauptbild"|translate}</span></td>
		</tr>
		<tr>
			<td class="view_separator" colspan="4"><img src="{$XT_IMAGES}spacer.gif" alt="" /></td>
		</tr>
		 <tr>
		  <td class="left">{"Image"|translate}<a name="image" /></td>
		  <td class="right">{actionPopUp
		    icon="pick_photo.png"
		    title="Pick an image"|translate
		    TPL=$IMAGE_PICKER_TPL
		    BASEID=$IMAGE_PICKER_BASE_ID
		    fieldBaseId=$BASEID
		    fieldName="image"
		    form="edit"
		    name="picker"
		    anker="image"
		}{
		   actionIcon
		       action="deleteImage"
		       icon="delete.png"
		       form="edit"
		       yoffset=1
		       title="Delete Image"
		       ask="Are you sure that you want to delete this image relation"
		       id=$DATA.map.id
		   }<br />
		   {if $DATA.map.image < 1}
		   <img name="x{$BASEID}_image_view" src="{$XT_IMAGES}spacer.gif" alt="" />
		   {else}
		   {if $DATA.map.image_type == 2}
		   <div style="border: 1px solid black; margin-top: 5px; width: 200px;">
		   <object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=5,0,0,0" width="200" height="{math equation=200/(width/height) width=$DATA.width height=$DATA.height}">
		   <param name="movie" value="{$XT_WEB_ROOT}download.php?file_id={$DATA.map.image}" />
		   <param name="quality" value="high" />
		   <embed src="{$XT_WEB_ROOT}download.php?file_id={$DATA.image}" quality="high" width="200" height="{math equation=200/(width/height) width=$DATA.width height=$DATA.height}" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" /></embed>
		   </object>
		   </div>
		   <img name="x{$BASEID}_image_view" src="{$XT_IMAGES}spacer.gif" alt="" />
		   {else}
		   <img name="x{$BASEID}_image_view" src="{$XT_WEB_ROOT}download.php?file_id={$DATA.map.image}&amp;file_version=1" alt="" class="picked" />
		   {/if}
		   {/if}
			<input type="hidden" name="x{$BASEID}_image" value="{$DATA.map.image}" />
			<input type="hidden" name="x{$BASEID}_image_version" value="{$DATA.map.image_version}" />
			<input type="hidden" name="x{$BASEID}_image_zoom" {if $DATA.map.image_zoom}checked="checked"{/if}/>
		  </td>
		 </tr>
		 <tr>
		  <td class="left">{"Zoom Popup available?"|translate}</td>
		  <td class="right"><input type="checkbox" name="x{$BASEID}_image_zoom" value="1" {if $DATA.map.image_zoom == 1}checked{/if} />
		  </td>
		 </tr>
		<tr>
			<td class="view_header" colspan="2"><span class="title">{"Addressen"|translate}</span></td>
		</tr>
		<tr>
			<td class="view_separator" colspan="4"><img src="{$XT_IMAGES}spacer.gif" alt="" /></td>
		</tr>
		<input type="hidden" name="x{$BASEID}_map_c" value="{$DATA.map.c}" />
	</table>
	{literal}
<script type="text/javascript"><!--
var lastDiv = "";
function showDiv(divName) {
	// hide last div
	if (lastDiv) {
		document.getElementById(lastDiv).className = "hiddenDiv";
	}
	//if value of the box is not nothing and an object with that name exists, then change the class
	if (divName && document.getElementById(divName)) {
		document.getElementById(divName).className = "visibleDiv";
		lastDiv = divName;
	}
}
	{/literal}
//-->
</script>
{include file="includes/buttons.tpl" data=$BUTTONS_MAP_OPTIONS withouthidden="1" yoffset=true}
{foreach from=$DATA.addresses key="address" key="FIELD" item="ADDRESS" name="addresses"}
{assign var="number" value=$smarty.foreach.addresses.iteration}
{assign var="address_id" value=$ADDRESS.id}

<p style="padding: 0px 0px 0px 15px; font-weight: bold;">Address {$number} {
		   actionIcon
		       action="deleteAddress"
		       icon="delete.png"
		       form="edit"
		       yoffset=1
		       title="Delete Action"
		       ask="Are you sure that you want to delete this address relation"
		       address_id=$ADDRESS.id
      		   map_id=$ADDRESS.map_id
		   }</p>
<table cellspacing="0" cellpadding="0" width="100%">
<tr>
	<td class="view_separator" colspan="4"><img src="{$XT_IMAGES}spacer.gif" alt="" /></td>
</tr>
 <tr>
  <td class="left">{"Address_title"|translate} *</td>
  <td class="right"><input type="text" name="x{$BASEID}_address_data[{$FIELD}][title]" id="x{$BASEID}_address{$FIELD}_title" {if $NON_CRUCIAL_ERRORS.$address_id.title}style="border: 1px solid red;"{/if} value="{$ADDRESS.title}" size="42" />
  	<input type="hidden" name="x{$BASEID}_address_data[{$FIELD}][c]" value="{$ADDRESS.c}" /> 
   </td>
 </tr>
<tr>
	<td class="left">{"Status"|translate}</td>
	<td class="right">
		<input type="hidden" name="x{$BASEID}_published" value="{$DATA.map.published}" />
		{if $ADDRESS.active}
			{actionIcon 
	        action="deactivateAddressEdit"
	        icon="active.png"
	        form="edit"
	        perm="statuschange"
	        id=$ADDRESS.map_id
      		address_id=$ADDRESS.id
	        title="Deactivate this address"}
	    {else}
	       	{actionIcon 
	        action="activateAddressEdit"
	        icon="inactive.png"
	        form="edit"
	        perm="statuschange"
	        id=$ADDRESS.map_id
      		address_id=$ADDRESS.id
	        title="Activate this address"}
	    {/if}
	      {if !$smarty.foreach.addresses.last}{actionIcon
      action="changePosition"
      icon="explorer/arrow_down_green.png"
      direction="moveDown"
      address_id=$ADDRESS.id
      map_id=$ADDRESS.map_id
      actual_position=$ADDRESS.position
      form="edit"
      yoffset=true
      title="Insert element after this element"
  }{/if}{if !$smarty.foreach.addresses.first}{actionIcon
      action="changePosition"
      icon="explorer/arrow_up_green.png"
      direction="moveUp"
      address_id=$ADDRESS.id
      map_id=$ADDRESS.map_id
      actual_position=$ADDRESS.position
      form="edit"
      yoffset=true
      title="Insert element before this element"
  }
  {/if}
	</td>
</tr>
 <tr>
  <td class="left">
  {"Address_description"|translate}</td>
  <td class="right">{toggle_editor id="address_"|cat:$FIELD|cat:"description"}<textarea id="x{$BASEID}_address_{$FIELD}description" name="x{$BASEID}_address_data[{$FIELD}][description]" rows="4" cols="40">{$ADDRESS.description}</textarea></td>
 </tr>
 <tr>
  <td class="left">{"Address"|translate}<a name="addr_picker" /></td>
  <td class="right">
  	<select name="x{$BASEID}_address_data[{$FIELD}][type]" size="1" onchange="changeme(this.value,'subaddr{$FIELD}');">
				<option value="">{"Bitte selektieren"|translate}</option>
				<option {if $ADDRESS.type == 1}selected="selected"{/if} value="1_{$FIELD}">{"Adresse picken"|translate}</option>
				<option {if $ADDRESS.type == 2}selected="selected"{/if} value="2_{$FIELD}">{"Adresse eingeben"|translate}</option>
				<option {if $ADDRESS.type == 3}selected="selected"{/if} value="3_{$FIELD}">{"Koordinaten eingeben"|translate}</option>
			</select>
		<div id="1_{$FIELD}" class="{if $ADDRESS.type == 1}visibleDiv{else}hiddenDiv{/if} subaddr{$FIELD}"><input size="42" type="text" readonly="yes" class="disabled" id="x{$BASEID}_address{$FIELD}_address_picked_title" name="x{$BASEID}_address_data[{$FIELD}][address_picked_title]" value="{if $ADDRESS.addr_title != ""}{$ADDRESS.addr_title},{/if} {if $ADDRESS.addr_street != ""}{$ADDRESS.addr_street},{/if} {if $ADDRESS.addr_postalCode != ""}{$ADDRESS.addr_postalCode}{/if} {if $ADDRESS.addr_city}{$ADDRESS.addr_city}{/if}" />
  {actionPopUp
    icon="breakpoint_add.png"
    title="Pick an address"|translate
    TPL=$ADDR_PICKER_TPL
    BASEID=7400
    fieldBaseId=$BASEID
    fieldName="address"|cat:$FIELD|cat:"_address_picked"
    form="edit"
    name="addr_picker"
    anker="addr_picker"
}<input type="hidden" id="x{$BASEID}_address{$FIELD}_address_picked" name="x{$BASEID}_address_data[{$FIELD}][address_picked]" value="{$ADDRESS.addr_id}" /></div>
		<div id="2_{$FIELD}" class="{if $ADDRESS.type == 2}visibleDiv{else}hiddenDiv{/if} subaddr{$FIELD}"><input type="text" name="x{$BASEID}_address_data[{$FIELD}][address]" id="x{$BASEID}_address{$FIELD}_address" {if $NON_CRUCIAL_ERRORS.$address_id.address}style="border: 1px solid red;"{/if} value="{$ADDRESS.address}" size="42" /></div>
		<div id="3_{$FIELD}" class="{if $ADDRESS.type == 3}visibleDiv{else}hiddenDiv{/if} subaddr{$FIELD}">
		{if $NON_CRUCIAL_ERRORS.$address_id != ""}
			{$NON_CRUCIAL_ERRORS.$address_id.coordinates}
		{elseif $ADDRESS.latitude =="" OR $ADDRESS.longitude ==""}
			{"Address coordinates not found / address not saved yet"|translate}<br />
		{/if}
		<div style="float: left; width: 60px;">Latitude:</div><div style="float: left; margin: 0px 0px 0px 10px;"><input type="text" name="x{$BASEID}_address_data[{$FIELD}][latitude]" value="{$ADDRESS.latitude}" size="29" /></div>
		<br /><br />
		<div style="float: left; width: 60px;">Longitude:</div><div style="float: left; margin: 0px 0px 0px 10px;"><input type="text" name="x{$BASEID}_address_data[{$FIELD}][longitude]" value="{$ADDRESS.longitude}"  size="29" /></div>
		<br /><br />
		<div style="display: none;" id="addressCoordinateHelp{$FIELD}">{"if cannot determine address"|translate} <a target="_blank" href="http://www.mygeoposition.com/">MyGeoPosition</a>.</div></div></td>
 </tr>
 <tr>
  <td class="left">{"Address_planer"|translate}</td>
  <td class="right"><input value="1" {if $ADDRESS.planer}checked{/if} type="checkbox" name="x{$BASEID}_address_data[{$FIELD}][planer]"  /></td>
 </tr>
 <tr>
  <td class="left">{"Image"|translate}<a name="image{$FIELD}" /></td>
  <td class="right">{actionPopUp
    icon="pick_photo.png"
    title="Pick an image"|translate
    TPL=$IMAGE_PICKER_TPL
    BASEID=$IMAGE_PICKER_BASE_ID
    fieldBaseId=$BASEID
    fieldName="image"|cat:$FIELD
    form="edit"
    name="picker"
    anker="image"|cat:$FIELD
}{
   actionIcon
       action="deleteAddressImage"
       address_id=$ADDRESS.id
       icon="delete.png"
       form="edit"
       title="Delete Image"
       yoffset=1
       ask="Are you sure that you want to delete this image relation"
       map_id=$ADDRESS.id
   }<br />
   {if $ADDRESS.image < 1}
   <img name="x{$BASEID}_image{$FIELD}_view" src="{$XT_IMAGES}spacer.gif" alt="" />
   {else}
   {if $ADDRESS.image_type == 2}
   <div style="border: 1px solid black; margin-top: 5px; width: 200px;">
   <object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=5,0,0,0" width="200" height="{math equation=200/(width/height) width=$ADDRESS.width height=$ADDRESS.height}">
   <param name="movie" value="{$XT_WEB_ROOT}download.php?file_id={$ADDRESS.image}" />
   <param name="quality" value="high" />
   <embed src="{$XT_WEB_ROOT}download.php?file_id={$ADDRESS.image}" quality="high" width="200" height="{math equation=200/(width/height) width=$ADDRESS.width height=$ADDRESS.height}" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" /></embed>
   </object>
   </div>
   <img name="x{$BASEID}_image{$FIELD}_view" src="{$XT_IMAGES}spacer.gif" alt="" />
   {else}
   <img name="x{$BASEID}_image{$FIELD}_view" src="{$XT_WEB_ROOT}download.php?file_id={$ADDRESS.image}&amp;file_version=1" alt="" class="picked" />
   {/if}
   {/if}
   <input type="hidden" name="x{$BASEID}_image{$FIELD}" value="{$ADDRESS.image}" />
   <input type="hidden" name="x{$BASEID}_image{$FIELD}_version" value="{$ADDRESS.image_version}" />
  </td>
 </tr>
 <tr>
  <td class="left">{"Icon"|translate}<a name="icon{$FIELD}" /></td>
  <td class="right">{actionPopUp
    icon="pick_photo.png"
    title="Pick an image"|translate
    TPL=$IMAGE_PICKER_TPL
    BASEID=$IMAGE_PICKER_BASE_ID
    fieldBaseId=$BASEID
    fieldName="icon"|cat:$FIELD
    form="edit"
    name="picker"
    anker="icon"|cat:$FIELD
}{actionIcon
       action="deleteAddressIcon"
       address_id=$ADDRESS.id
       icon="delete.png"
       form="edit"
       title="Delete Image"
       yoffset=1
       ask="Are you sure that you want to delete this image relation"
       map_id=$ADDRESS.id
   }<br />
   {if $ADDRESS.icon < 1}
   <img name="x{$BASEID}_icon{$FIELD}_view" src="{$XT_IMAGES}spacer.gif" alt="" />
   {else}
   <img name="x{$BASEID}_icon{$FIELD}_view" src="{$XT_WEB_ROOT}download.php?file_id={$ADDRESS.icon}&amp;file_version=1" alt="" class="picked" />
   {/if}
   <input type="hidden" name="x{$BASEID}_icon{$FIELD}" value="{$ADDRESS.icon}" />
   <input type="hidden" name="x{$BASEID}_icon{$FIELD}_version" value="{$ADDRESS.icon_version}" />
  </td>
 </tr>
 <tr>
 <td colspan="4">&nbsp;</td>
   </tr>
</table>
<input type="hidden" name="x{$BASEID}_address_data[{$FIELD}][id]" value="{$ADDRESS.id}" />
{/foreach}
 {include file="includes/editor.tpl}
</form>
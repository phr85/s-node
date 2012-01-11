{if $ERROR|@count > 0}
	{foreach from=$ERROR item=ER}
		<span style="color:red;">{$ER}</span><br/>
	{/foreach}
{/if}
<form method="post" action="{$smarty.server.PHP_SELF}" name="edit" id="addaddressform">
<table cellpadding="0" cellspacing="0" width="100%" class="inputtable">
<tr>
  <td class="view_header" colspan="2">
   <span class="title">{"Add address"|translate}</span>
  </td>
 </tr>
 <tr>
  <td class="view_separator" colspan="2"><img src="{$XT_IMAGES}spacer.gif" alt="" /></td>
 </tr>
 <tr>
  <td class="adminleft">{"Display name"|translate}{if "title"|in_array:$REQUIRED_FIELDS}*{/if}</td>
  <td class="adminright"><input id="x{$BASEID}_title" type="text" name="x{$BASEID}_title" value="{$DATA.title}" size="42" style="background-color:#EEEEEE;"/></td>
 </tr>
 <tr>
  <td class="adminleft">{"First name"|translate}{if "firstName"|in_array:$REQUIRED_FIELDS}*{/if} / {"Last name"|translate}{if "lastName"|in_array:$REQUIRED_FIELDS}*{/if}</td>
  <td class="adminright"><select name="x{$BASEID}_gender" {if $DATA.type == '1' || $DATA.type == '2'}disabled{/if}>
  <option value="0" {if $DATA.gender == 0}selected{/if}>{"Unknown"|translate}</option>
  <option value="1" {if $DATA.gender == 1}selected{/if}>{"Mr."|translate}</option>
  <option value="2" {if $DATA.gender == 2}selected{/if}>{"Mrs."|translate}</option>
  </select> <input id="firstName" name="x{$BASEID}_firstName" value="{$DATA.firstName}" size="11" />&nbsp;<input id="lastName" type="text" name="x{$BASEID}_lastName" value="{$DATA.lastName}" size="13" /></td>
 </tr>
 <tr>
  <td class="adminleft">{"Position"|translate}</td>
  <td class="adminright"><input type="text" name="x{$BASEID}_position" value="{$DATA.position}" size="20"/></td>
 </tr>
 <tr>
  <td class="adminleft">{"Street"|translate}{if "street"|in_array:$REQUIRED_FIELDS}*{/if}</td>
  <td class="adminright"><input type="text" name="x{$BASEID}_street" value="{$DATA.street}" size="42" /></td>
 </tr>
 <tr>
  <td class="adminleft">{"Postal code"|translate}{if "postalCode"|in_array:$REQUIRED_FIELDS}*{/if} / {"City"|translate}{if "city"|in_array:$REQUIRED_FIELDS}*{/if}</td>
  <td class="adminright">
   <input type="text" name="x{$BASEID}_postalCode" value="{$DATA.postalCode}" size="8" />
   <input type="text" name="x{$BASEID}_city" value="{$DATA.city}" size="30" />
  </td>
 </tr>
 <tr>
  <td class="adminleft">{"Country"|translate}{if "country"|in_array:$REQUIRED_FIELDS}*{/if}</td>
  <td class="adminright">
   <select name="x{$BASEID}_country" onchange="getregions(this.options[this.selectedIndex].value);" id="country">
   <option value="CH">Schweiz</option>
   <option value="AT">&Ouml;sterreich</option>
   <option value="FR">France</option>
   <option value="DE">Deutschland</option>
   <option value="IT">Italy</option>
   <option value="CH">--------------------------</option>
   {foreach from=$COUNTRIES item=COUNTRY}
   <option value="{$COUNTRY.country}" {if $COUNTRY.country == $DATA.country}selected{/if}>{$COUNTRY.name}</option>
   {/foreach}
   </select>
  </td>
 </tr>
 <tr>
  <td class="adminleft">{"Region"|translate}{if "state"|in_array:$REQUIRED_FIELDS}*{/if}</td>
  <td class="adminright">
   <select name="x{$BASEID}_state" id="regions">
   	 <option value="0">--</option>
   </select>
  </td>
 </tr>

  <tr>
   <td class="adminleft">{"Website"|translate}{if "website"|in_array:$REQUIRED_FIELDS}*{/if}</td>
   <td class="adminright"><input type="text" name="x{$BASEID}_website" value="{$DATA.website}" size="42" /></td>
  </tr>
  <tr>
   <td class="adminleft">{"Skype"|translate}{if "skype"|in_array:$REQUIRED_FIELDS}*{/if}</td>
   <td class="adminright"><input type="text" name="x{$BASEID}_skype" value="{$DATA.skype}" size="42" /></td>
  </tr>
  <tr>
   <td class="adminleft">{"E-Mail (Business)"|translate}{if "email"|in_array:$REQUIRED_FIELDS}*{/if}</td>
   <td class="adminright"><input type="text" name="x{$BASEID}_email" value="{$DATA.email}" size="42" /></td>
  </tr>
  <tr>
   <td class="adminleft">{"E-Mail (Private)"|translate}{if "email_private"|in_array:$REQUIRED_FIELDS}*{/if}</td>
   <td class="adminright"><input type="text" name="x{$BASEID}_email_private" value="{$DATA.email_private}" size="42" /></td>
  </tr>
  <tr>
   <td class="adminleft">{"Telephone (Business)"|translate}{if "tel"|in_array:$REQUIRED_FIELDS}*{/if}</td>
   <td class="adminright"><input type="text" name="x{$BASEID}_tel" value="{$DATA.tel}" size="20" />
   {if $DATA.tel != ''}<a href="callto://{$DATA.tel}"><img src="images/icons/telephone.png" style="padding-left: 5px; vertical-align: middle;" alt="{'Call'|translate}" title="{'Call'|translate}" /></a>{else}<img src="images/icons/telephone_na.png" style="padding-left: 5px; vertical-align: middle;" alt="{'Call'|translate}" title="{'Call'|translate}" />{/if}
   </td>
  </tr>
  <tr>
   <td class="adminleft">{"Telephone (Private)"|translate}{if "tel_private"|in_array:$REQUIRED_FIELDS}*{/if}</td>
   <td class="adminright"><input type="text" name="x{$BASEID}_tel_private" value="{$DATA.tel_private}" size="20" />
   {if $DATA.tel_private != ''}<a href="callto://{$DATA.tel_private}"><img src="images/icons/telephone.png" style="padding-left: 5px; vertical-align: middle;" alt="{'Call'|translate}" title="{'Call'|translate}" /></a>{else}<img src="images/icons/telephone_na.png" style="padding-left: 5px; vertical-align: middle;" alt="{'Call'|translate}" title="{'Call'|translate}" />{/if}
   </td>
  </tr>
  <tr>
   <td class="adminleft">{"Mobile (Business)"|translate}{if "tel_mobile"|in_array:$REQUIRED_FIELDS}*{/if}</td>
   <td class="adminright"><input type="text" name="x{$BASEID}_tel_mobile" value="{$DATA.tel_mobile}" size="20" />
   {if $DATA.tel_mobile != ''}<a href="callto://{$DATA.tel_mobile}"><img src="images/icons/telephone.png" style="padding-left: 5px; vertical-align: middle;" alt="{'Call'|translate}" title="{'Call'|translate}" /></a>{else}<img src="images/icons/telephone_na.png" style="padding-left: 5px; vertical-align: middle;" alt="{'Call'|translate}" title="{'Call'|translate}" />{/if}
   </td>
  </tr>
  <tr>
   <td class="adminleft">{"Mobile (Private)"|translate}{if "tel_mobile_private"|in_array:$REQUIRED_FIELDS}*{/if}</td>
   <td class="adminright"><input type="text" name="x{$BASEID}_tel_mobile_private" value="{$DATA.tel_mobile_private}" size="20" />
   {if $DATA.tel_mobile_private != ''}<a href="callto://{$DATA.tel_mobile_private}"><img src="images/icons/telephone.png" style="padding-left: 5px; vertical-align: middle;" alt="{'Call'|translate}" title="{'Call'|translate}" /></a>{else}<img src="images/icons/telephone_na.png" style="padding-left: 5px; vertical-align: middle;" alt="{'Call'|translate}" title="{'Call'|translate}" />{/if}
   </td>
  </tr>
  <tr>
   <td class="adminleft">{"Fax (Business)"|translate}{if "fax"|in_array:$REQUIRED_FIELDS}*{/if}</td>
   <td class="adminright"><input type="text" name="x{$BASEID}_fax" value="{$DATA.fax}" size="20" />
   {if $DATA.fax != ''}<a href="callto://{$DATA.fax}"><img src="images/icons/telephone.png" style="padding-left: 5px; vertical-align: middle;" alt="{'Call'|translate}" title="{'Call'|translate}" /></a>{else}<img src="images/icons/telephone_na.png" style="padding-left: 5px; vertical-align: middle;" alt="{'Call'|translate}" title="{'Call'|translate}" />{/if}
   </td>
  </tr>
  <tr>
   <td class="adminleft">{"Fax (Private)"|translate}{if "fax_private"|in_array:$REQUIRED_FIELDS}*{/if}</td>
   <td class="adminright"><input type="text" name="x{$BASEID}_fax_private" value="{$DATA.fax_private}" size="20" />
   {if $DATA.fax_private != ''}<a href="callto://{$DATA.fax_private}"><img src="images/icons/telephone.png" style="padding-left: 5px; vertical-align: middle;" alt="{'Call'|translate}" title="{'Call'|translate}" /></a>{else}<img src="images/icons/telephone_na.png" style="padding-left: 5px; vertical-align: middle;" alt="{'Call'|translate}" title="{'Call'|translate}" />{/if}
   </td>
  </tr>
  <tr>
   <td class="adminleft">{"Public (indexed)"|translate}</td>
   <td class="adminright"><input type="radio" name="x{$BASEID}_public" value="0" {if $DATA.public==0}checked="checked{/if}" />{"no"|translate}
   <input type="radio" name="x{$BASEID}_public" value="1" {if $DATA.public==1}checked="checked"{/if} />{"yes"|translate}
   </td>
  </tr>
  <tr>
   <td class="adminright" colspan="2">* = {"required fields"|translate}</td>
  </tr>
  <tr>
   <td class="adminright" colspan="2"><input type="submit" value="{"Save"|translate}" /></td>
  </tr>
  </table>
<input type="hidden" name="x{$BASEID}_image" value="{$DATA.image}" />
<input type="hidden" name="x{$BASEID}_image_version" value="{$DATA.image_version}" />
<input type="hidden" name="x{$BASEID}_id" value="{$DATA.id}" />
<input type="hidden" name="x{$BASEID}_action" value="useradd" />
<input type="hidden" name="TPL" value="{$TPL}" />
</form>

<script>
{literal}

document.firstLoad = false;

// Get all regions for a country
function getregions(country) {
	// get the select element with the id regions
	var elSel = document.getElementById('regions');
	// delete all entries unless the first
	while(elSel.length > 1) {
   		removeOptionLast();
   	}
	// If all entries are deleted get the new entries
	if (elSel.length <= 1) {
		ajaxReturnUrl('ajax.php?package=ch.iframe.snode.addressmanager&module=AX_actions&param_action=getregion&param_country=' + country,'action1');
		// start inserting the regions after 1 seconde
		setTimeout("setregions()",1000);
	}
}
// Insert the regions by executing the result. Simple, stupid and it works!
function setregions() {
	eval(getContent('action1'));
	if (document.firstLoad == false) {
		var elSel = document.getElementById('regions');
		for (var i = 1; i <= elSel.length - 1; i++){
			if (elSel.options[i].value == '{/literal}{$DATA.state}{literal}' || elSel.options[i].value == '0{/literal}{$DATA.state}{literal}') {
				elSel.options[i].selected = true;
			}
		}
		document.firstLoad = true;
	}
}

function appendOptionLast(text,value)
{
  var elOptNew = document.createElement('option');
  elOptNew.text = text;
  elOptNew.value = value;
  var elSel = document.getElementById('regions');

  try {
    elSel.add(elOptNew, null); // standards compliant; doesn't work in IE
  }
  catch(ex) {
    elSel.add(elOptNew); // IE only
  }
}

function removeOptionLast()
{
  var elSel = document.getElementById('regions');
  if (elSel.length > 0)
  {
    elSel.remove(elSel.length - 1);
  }
}

getregions(document.getElementById('country').options[document.getElementById('country').selectedIndex].value);
{/literal}
</script>
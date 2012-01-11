<form method="POST" name="addresstable">
 {include file="includes/charfilter.tpl" form="addresstable"}
 <table cellspacing="0" cellpadding="0" width="100%">

 <tr>
  <td class="row" colspan="3">
   {"Search for"|translate}&nbsp;
   <input type="text" name="x{$BASEID}_search" value="{$SEARCHTERM}" onclick="this.select();" />&nbsp;
   {"in"|translate}&nbsp;
   <select name="x{$BASEID}_search_field">
    <option value="title" {if $SEARCHFIELD=="title"}selected="selected"{/if}>{"Organization / Name"|translate}</option>
    <option value="firstName" {if $SEARCHFIELD=="firstName"}selected="selected"{/if}>{"First name"|translate}</option>
    <option value="lastName" {if $SEARCHFIELD=="lastName"}selected="selected"{/if}>{"Last name"|translate}</option>
    <option value="street" {if $SEARCHFIELD=="street"}selected="selected"{/if}>{"Street"|translate}</option>
    <option value="postalCode" {if $SEARCHFIELD=="postalCode"}selected="selected"{/if}>{"Postal code"|translate}</option>
    <option value="city" {if $SEARCHFIELD=="city"}selected="selected"{/if}>{"City"|translate}</option>
    <option value="id" {if $SEARCHFIELD=="id"}selected="selected"{/if}>{"ID"|translate}</option>
   </select>
   <input type="submit" value="{'Search'|translate}" />
  </td>
   </tr>
   <tr>
  <td class="row" colspan="3" >{"Zeige Adressen folgenden Typs"|translate}:
   <select name="x{$BASEID}_filtertype" onChange="this.form.submit();">
    <option value="-1" {if $FILTERTYPE == -1}selected{/if}>{"All"|translate}</option>
    <option value="-2" {if $FILTERTYPE == -2}selected{/if}>{"Undefined"|translate}</option>
    {foreach from=$ADDRESSTYPES item=TYPE key=TYPEKEY}
    <option value="{$TYPEKEY}" {if $FILTERTYPE == $TYPEKEY}selected{/if}>{$TYPE|translate}</option>
    {/foreach}
   </select>
   &nbsp;
   &nbsp;
     
   <select name="x{$BASEID}_country" onChange="this.form.submit();">
   <option value="">{"Select a country"|translate}</option>
   {foreach from=$COUNTRIES item=COUNTRY}
   <option value="{$COUNTRY.country}" {if $COUNTRY.country == $COUNTRYSELECTED}selected="selected"{/if}>{$COUNTRY.name}</option>
   {/foreach}
   </select>
  
   
  </td>
 </tr>

{* /* TODO Filter für addressübersicht implementieren
  {foreach from=$PROPERTIEFILTER item="PROPERTY" key="PROPERTYID"}
 <tr>
  <td class="row" align="right" colspan="3">Filter {$PROPERTY}:
   {subplugin package="ch.iframe.snode.properties" module="viewer" property=$PROPERTYID style="dropdown_addressfilter.tpl" SOURCEBASEID=$BASEID}
  </td>
 </tr>
{/foreach}
*}
  <tr>
   <td class="table_header" width="81">{"Options"|translate}</td>
   <td class="table_header" width="62">{actionIcon action="NULL" label="ID" form=addresstable sort=$sort.0.value icon=$sort.0.icon}</td>
   <td class="table_header">{actionIcon action="NULL" form=addresstable label="Display name" sort=$sort.1.value icon=$sort.1.icon}</td>
  </tr>

  {foreach from=$DATA item=ADDRESS name=ADDRESSTABLE}
      <tr class="{cycle values="row_a,row_b"}">
       <td class="button">
       <a href="#" onclick="
		window.parent.opener.document.forms['{$FORM}'].{$field}.value='{$ADDRESS.id}';
		window.parent.opener.document.forms['{$FORM}'].{$TITLEFIELD}.value='{$ADDRESS.title}';
		window.close();">
  		<img src="{$XT_IMAGES}icons/check_small.png" width="12" height="12" alt="&nbsp;" /></a>
       </td>
       <td class="row">{$ADDRESS.id}&nbsp;</td>
       <td class="row">
 {if $ADDRESS.type == 3}
   <img src="{$XT_IMAGES}icons/user.png" alt="{"Person"|translate}"/>
    {if $ADDRESS.organisation_name != ""}
   		<i>({$ADDRESS.organisation_name})</i>
   	{/if}
   	{if $ADDRESS.organizationalunit_name != ""}
   		<i>({$ADDRESS.organizationalunit_name})</i>
   	{/if}
   {/if}
   {if $ADDRESS.type == 1}
   <img src="{$XT_IMAGES}icons/factory.png" alt="{"Company"|translate}"/>
   {/if}
   {if $ADDRESS.type == 2 }
   <img src="{$XT_IMAGES}icons/member2.png" alt="{"Department"|translate}"/>
    {if $ADDRESS.organisation_name != ""}
   		<i>({$ADDRESS.organisation_name})</i>
   	{/if}
   {/if}
 {if $ADDRESS.type == 0}
   <img src="{$XT_IMAGES}icons/help2.png" alt="{"Person"|translate}"/>
 {/if}

 {$ADDRESS.title}
 
   {if $ADDRESS.user_id != ""}
   		 <img src="{$XT_IMAGES}icons/worker.png" alt="{"Address of a system user"|translate}"/> <b>({$ADDRESS.user_name})</b>

   	{/if}

		</td>
      </tr>
  {/foreach}
 </table>
 {include file="includes/navigator.tpl" form="addresstable"}
 <input type="hidden" name="x{$BASEID}_id" value="" />
 <input type="hidden" name="x{$BASEID}_sort" value="" />
 <input type="hidden" name="x{$BASEID}_action" value="" />
</form>
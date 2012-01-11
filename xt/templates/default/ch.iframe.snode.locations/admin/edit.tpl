<script language="JavaScript"><!--
window.parent.frames['master'].document.forms[1].submit();
//-->
</script>
<form method="post" name="edit">
 <h2><span class="light">{"Location"|translate}: </span>{$LOCATION.title}</h2>
 {include file="includes/buttons.tpl" data=$BUTTONS}
 <table cellspacing="0" cellpadding="0" width="100%">
  <tr>
   <td class="left">{"Title"|translate}</td>
   <td class="right"><input type="text" name="x{$BASEID}_title" value="{$LOCATION.title}" size="42" /></td>
  </tr>
  <tr>
   <td class="left">{"Description"|translate}</td>
   <td class="right">{toggle_editor id="description"}
   <textarea id="x{$BASEID}_description" name="x{$BASEID}_description" rows="6" cols="70">{$LOCATION.description}</textarea></td>
  </tr>
  <tr>
   <td class="left">{"Postal code"|translate} / {"City"|translate}</td>
   <td class="right"><input type="text" name="x{$BASEID}_cityCode" value="{$LOCATION.cityCode}" size="7" /> <input type="text" name="x{$BASEID}_city" value="{$LOCATION.city}" size="30" /></td>
  </tr>
  <tr>
  <td class="left">{"Country"|translate}</td>
  <td class="right">
   <select name="x{$BASEID}_country" onchange="document.forms['edit'].x{$BASEID}_action.value='save';document.forms['edit'].submit();">
   {foreach from=$COUNTRIES item=COUNTRY}
   <option value="{$COUNTRY.country}" {if $COUNTRY.country == $LOCATION.country}selected{/if}>{$COUNTRY.name}</option>
   {/foreach}
   </select>
  </td>
 </tr>
 </table>
 <input type="hidden" name="x{$BASEID}_location_id" />
 {include file="includes/editor.tpl"}
</form>

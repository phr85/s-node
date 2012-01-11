<script language="JavaScript"><!--
window.parent.frames['master'].document.forms[1].submit();
//-->
</script>
<form method="POST" name="edit">
{include file="includes/buttons.tpl" data=$EDIT_BUTTONS}
<table cellspacing="0" cellpadding="0" width="100%">
 <tr>
  <td class="view_header" colspan="2">
   <span class="title_light">{"Area"|translate}:</span><span class="title"> {$AREA.title}</span>
  </td>
 </tr>
 <tr>
  <td class="view_separator" colspan="2"><img src="{$XT_IMAGES}spacer.gif" alt="" /></td>
 </tr>
 <tr>
  <td class="left">{"Title"|translate}</td>
  <td class="right"><input type="text" name="x{$BASEID}_title" value="{$AREA.title}" size="42">
 </tr>
 <tr>
  <td class="left">{"Area lead"|translate}</td>
  <td class="right">
   <select name="x{$BASEID}_employee_id">
    <option value="0" {if $AREA.employee_id == 0}selected{/if}>{"Not assigned"|translate}</option>
    {foreach from=$EMPLOYEES item=EMPLOYEE}
    <option value="{$EMPLOYEE.id}" {if $AREA.employee_id == $EMPLOYEE.id}selected{/if}>{$EMPLOYEE.lastName} {$EMPLOYEE.firstName} {if $EMPLOYEE.email != ''}({$EMPLOYEE.email}){/if}</option>
    {/foreach}
   </select>
  </td>
 </tr>
 <tr>
  <td class="view_header" colspan="2">
   <span class="title">{"Information"|translate}</span>
  </td>
 </tr>
 <tr>
  <td class="view_separator" colspan="2"><img src="{$XT_IMAGES}spacer.gif" alt="" /></td>
 </tr>
 <tr>
  <td class="left">{"ID"|translate}</td>
  <td class="right">{$AREA.id}</td>
 </tr>
 <tr>
  <td class="left">{"Author"|translate}</td>
  <td class="right">{$AREA.creation_user}&nbsp;</td>
 </tr>
 <tr>
  <td class="left">{"Creation date"|translate}</td>
  <td class="right">{$AREA.creation_date|date_format:"%d.%m.%Y %H:%I:%S"}</td>
 </tr>
 <tr>
  <td class="left">{"Last Modifier"|translate}</td>
  <td class="right">{$AREA.mod_user}&nbsp;</td>
 </tr>
 <tr>
  <td class="left">{"Last Modification date"|translate}</td>
  <td class="right">{$AREA.mod_date|date_format:"%d.%m.%Y %H:%I:%S"}</td>
 </tr>
</table>
<input type="hidden" name="x{$BASEID}_id" value="{$AREA.id}" />
<input type="hidden" name="x{$BASEID}_position" />
<input type="hidden" name="x{$BASEID}_insert_position" />
</form>
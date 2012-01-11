<form method="POST">
{include file="includes/buttons.tpl" data=$BUTTONS}
<table cellspacing="0" cellpadding="0" width="100%">
 <tr>
  <td class="view_header">
   <span class="title">{"Datasources"|translate}</span><br />
  </td>
 </tr>
 <tr>
  <td class="view_separator" colspan="4"><img src="{$XT_IMAGES}spacer.gif" alt="" /></td>
 </tr>
 <tr>
  <td style="padding: 15px;">
   <table cellspacing="0" cellpadding="0" width="100%">
    <tr>
     <td class="wizard" colspan="2"><b>{"Which existing data tables you want to use in your plugin?"|translate}</b></td>
    </tr>
    {foreach from=$TABLES item=TABLE}
    <tr>
     <td style="padding: 5px; width: 16px; padding-top: 2px; padding-bottom: 2px;"><input type="checkbox" name="x{$BASEID}_tables[{$TABLE}]" value="1"></td>
     <td class="wizard" style="padding-top: 2px; padding-bottom: 2px;">{$TABLE}</td>
    </tr>
    {/foreach}
    <tr>
     <td class="wizard" colspan="2"><input type="button" onClick="this.form.x{$BASEID}_action.value='goToNextStep';this.form.submit();" name="x{$BASEID}_wizard_submit" value="{"Next"|translate}"></td>
    </tr>
   </table>
  </td>
 </tr>
</table>
<input type="hidden" name="x{$BASEID}_wizard" value="1" />
<input type="hidden" name="x{$BASEID}_step" value="4" />
</form>

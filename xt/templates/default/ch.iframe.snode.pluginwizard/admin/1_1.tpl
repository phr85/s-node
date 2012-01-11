<form method="POST">
{include file="includes/buttons.tpl" data=$BUTTONS}
<table cellspacing="0" cellpadding="0" width="100%">
 <tr>
  <td class="view_header">
   <span class="title">{"Create a new plugin"|translate}</span><br />
  </td>
 </tr>
 <tr>
  <td class="view_separator" colspan="4"><img src="{$XT_IMAGES}spacer.gif" alt="" /></td>
 </tr>
 <tr>
  <td style="padding: 15px;">
   <table cellspacing="0" cellpadding="0" width="100%">
    <tr>
     <td class="wizard" colspan="2"><b>{"Plugin name"|translate}</b></td>
    </tr>
    <tr>
     <td style="padding: 5px;" colspan="2"><input type="text" name="x{$BASEID}_name" size="42"></td>
    </tr>
    <tr>
     <td class="wizard" colspan="2"><b>{"Your name (Developer)"|translate}</b></td>
    </tr>
    <tr>
     <td style="padding: 5px;" colspan="2"><input type="text" name="x{$BASEID}_name" size="42"></td>
    </tr>
    <tr>
     <td class="wizard" colspan="2"><b>{"Vendor (Company name)"|translate}</b></td>
    </tr>
    <tr>
     <td style="padding: 5px;" colspan="2"><input type="text" name="x{$BASEID}_name" size="42"></td>
    </tr>
    <tr>
     <td class="wizard" colspan="2"><b>{"Plugin package name"|translate}</b><br /><span class="subline">e.g yourdomain.yourcompany.snode.yourplugin (ch.iframe.snode.test1)</span></td>
    </tr>
    <tr>
     <td style="padding: 5px;" colspan="2"><input type="text" name="x{$BASEID}_package_name" size="42"></td>
    </tr>
    <tr>
     <td class="wizard" colspan="2"><input type="button" onClick="this.form.x{$BASEID}_action.value='goToNextStep';this.form.submit();" name="x{$BASEID}_wizard_submit" value="{"Next"|translate}"></td>
    </tr>
   </table>
  </td>
 </tr>
</table>
<input type="hidden" name="x{$BASEID}_wizard" value="1" />
<input type="hidden" name="x{$BASEID}_step" value="2" />
</form>

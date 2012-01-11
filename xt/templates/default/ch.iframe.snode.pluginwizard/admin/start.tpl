<form method="POST">
{include file="includes/buttons.tpl" data=$BUTTONS}
<table cellspacing="0" cellpadding="0" width="100%">
 <tr>
  <td class="view_header">
   <span class="title">{"Plugin development wizard"|translate}</span><br />
  </td>
 </tr>
 <tr>
  <td class="view_separator" colspan="4"><img src="{$XT_IMAGES}spacer.gif" alt="" /></td>
 </tr>
 <tr>
  <td style="padding: 15px;">
   <table cellspacing="0" cellpadding="0" width="100%">
    <tr>
     <td class="wizard" colspan="2">{"What do you want to do?"|translate}</td>
    </tr>
    <tr>
     <td style="padding: 5px; width: 16px;"><input type="radio" name="x{$BASEID}_wizard" checked value="1"></td>
     <td class="wizard"><b>Create</b> a new plugin</td>
    </tr>
    <tr>
     <td style="padding: 5px; width: 16px;"><input type="radio" name="x{$BASEID}_wizard" value="2"></td>
     <td class="wizard"><b>Modify</b> an existing plugin (Modify existing actions, extensions, templates, etc.)</td>
    </tr>
    <tr>
     <td style="padding: 5px; width: 16px;"><input type="radio" name="x{$BASEID}_wizard" value="3"></td>
     <td class="wizard"><b>Extend</b> an existing plugin (Adding new actions, extensions, etc.)</td>
    </tr>
    <tr>
     <td style="padding: 5px; width: 16px;"><input type="radio" name="x{$BASEID}_wizard" value="4"></td>
     <td class="wizard"><b>Contribute</b> to an existing plugin (Adding new extra-functionality to existing plugins)</td>
    </tr>
    <tr>
     <td class="wizard" colspan="2"><input type="button" onClick="this.form.x{$BASEID}_action.value='goToNextStep';this.form.submit();" name="x{$BASEID}_wizard_submit" value="{"Next"|translate}"></td>
    </tr>
   </table>
  </td>
 </tr>
</table>
<input type="hidden" name="x{$BASEID}_step" value="1" />
</form>

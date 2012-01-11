<form method="POST">
{include file="includes/buttons.tpl" data=$BUTTONS}
<table cellspacing="0" cellpadding="0" width="100%">
 <tr>
  <td class="view_header">
   <span class="title">{"Administration"|translate}</span><br />
  </td>
 </tr>
 <tr>
  <td class="view_separator" colspan="4"><img src="{$XT_IMAGES}spacer.gif" alt="" /></td>
 </tr>
 <tr>
  <td style="padding: 15px;">
   <table cellspacing="0" cellpadding="0" width="100%">
    <tr>
     <td class="wizard" colspan="2"><b>{"Navigation section"|translate}</b><br /><br /><img src="{$XT_IMAGES}admin/wizard/section.jpg" alt="" /></td>
    </tr>
    <tr>
     <td style="padding: 5px;" colspan="2"><input type="text" name="x{$BASEID}_nav_section" size="42" value="System"></td>
    </tr>
    <tr>
     <td class="wizard" colspan="2"><b>{"Default tab"|translate}</b>({"Would be active if none of the other tabs is active"|translate})<br /><br /><img src="{$XT_IMAGES}admin/wizard/tabs.jpg" alt="" /></td>
    </tr>
    <tr>
     <td style="padding: 5px;" colspan="2">
      <input type="text" name="x{$BASEID}_tab_names[0]" size="30" value="Overview" onKeyUp="document.getElementById('tab_shortcut0').value=this.value.toLowerCase().substring(0,1);document.getElementById('tab_file0').value=this.value.toLowerCase()+'.php'">
      <input type="text" id="tab_file0" name="x{$BASEID}_tab_files[0]" size="30" value="overview.php" >
      <input type="text" id="tab_shortcut0" name="x{$BASEID}_tab_shortcuts[0]" size="4" value="o" >&nbsp;&nbsp;Visible ?
      <input type="checkbox" name="x{$BASEID}_tab_visibilities[0]" value="1" checked disabled>&nbsp;&nbsp;Default ?
      <input type="checkbox" name="x{$BASEID}_tab_default" value="1" checked disabled>
     </td>
    </tr>
    <tr>
     <td class="wizard" colspan="2"><b>{"Additional tabs"|translate}</b></td>
    </tr>
    <tr>
     <td style="padding: 5px;" colspan="2">
      <input type="text" name="x{$BASEID}_tab_names[1]" size="30" onKeyUp="document.getElementById('tab_shortcut1').value=this.value.toLowerCase().substring(0,1);document.getElementById('tab_file1').value=this.value.toLowerCase()+'.php'">
      <input type="text" id="tab_file1" name="x{$BASEID}_tab_files[1]" size="30" >
      <input type="text" id="tab_shortcut1" name="x{$BASEID}_tab_shortcuts[1]" size="4" >&nbsp;&nbsp;Visible ?
      <input type="checkbox" name="x{$BASEID}_tab_visibilities[1]" value="1" checked>&nbsp;&nbsp;Default ?
      <input type="checkbox" name="x{$BASEID}_tab_default" value="1" disabled>
     </td>
    </tr>
    <tr>
     <td style="padding: 5px;" colspan="2">
      <input type="text" name="x{$BASEID}_tab_names[2]" size="30" onKeyUp="document.getElementById('tab_shortcut2').value=this.value.toLowerCase().substring(0,1);document.getElementById('tab_file2').value=this.value.toLowerCase()+'.php'">
      <input type="text" id="tab_file2" name="x{$BASEID}_tab_files[2]" size="30" >
      <input type="text" id="tab_shortcut2" name="x{$BASEID}_tab_shortcuts[2]" size="4" >&nbsp;&nbsp;Visible ?
      <input type="checkbox" name="x{$BASEID}_tab_visibilities[2]" value="1" checked>&nbsp;&nbsp;Default ?
      <input type="checkbox" name="x{$BASEID}_tab_default" value="1" disabled>
     </td>
    </tr>
    <tr>
     <td style="padding: 5px;" colspan="2">
      <input type="text" name="x{$BASEID}_tab_names[3]" size="30" onKeyUp="document.getElementById('tab_shortcut3').value=this.value.toLowerCase().substring(0,1);document.getElementById('tab_file3').value=this.value.toLowerCase()+'.php'">
      <input type="text" id="tab_file3" name="x{$BASEID}_tab_files[3]" size="30" >
      <input type="text" id="tab_shortcut3" name="x{$BASEID}_tab_shortcuts[3]" size="4" >&nbsp;&nbsp;Visible ?
      <input type="checkbox" name="x{$BASEID}_tab_visibilities[3]" value="1" checked>&nbsp;&nbsp;Default ?
      <input type="checkbox" name="x{$BASEID}_tab_default" value="1" disabled>
     </td>
    </tr>
    <tr>
     <td style="padding: 5px;" colspan="2">
      <input type="text" name="x{$BASEID}_tab_names[4]" size="30" onKeyUp="document.getElementById('tab_shortcut4').value=this.value.toLowerCase().substring(0,1);document.getElementById('tab_file4').value=this.value.toLowerCase()+'.php'">
      <input type="text" id="tab_file4" name="x{$BASEID}_tab_files[4]" size="30" >
      <input type="text" id="tab_shortcut4" name="x{$BASEID}_tab_shortcuts[4]" size="4" >&nbsp;&nbsp;Visible ?
      <input type="checkbox" name="x{$BASEID}_tab_visibilities[4]" value="1" checked>&nbsp;&nbsp;Default ?
      <input type="checkbox" name="x{$BASEID}_tab_default" value="1" disabled>
     </td>
    </tr>
    <tr>
     <td style="padding: 5px;" colspan="2">
      <input type="text" name="x{$BASEID}_tab_names[5]" size="30" onKeyUp="document.getElementById('tab_shortcut5').value=this.value.toLowerCase().substring(0,1);document.getElementById('tab_file5').value=this.value.toLowerCase()+'.php'">
      <input type="text" id="tab_file5" name="x{$BASEID}_tab_files[5]" size="30" >
      <input type="text" id="tab_shortcut5" name="x{$BASEID}_tab_shortcuts[5]" size="4" >&nbsp;&nbsp;Visible ?
      <input type="checkbox" name="x{$BASEID}_tab_visibilities[5]" value="1" checked>&nbsp;&nbsp;Default ?
      <input type="checkbox" name="x{$BASEID}_tab_default" value="1" disabled>
     </td>
    </tr>

    <tr>
     <td class="wizard" colspan="2"><input type="button" onClick="this.form.x{$BASEID}_action.value='goToNextStep';this.form.submit();" name="x{$BASEID}_wizard_submit" value="{"Next"|translate}"></td>
    </tr>
   </table>
  </td>
 </tr>
</table>
<input type="hidden" name="x{$BASEID}_wizard" value="1" />
<input type="hidden" name="x{$BASEID}_step" value="3" />
</form>

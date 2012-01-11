<form method="POST">
{include file="includes/buttons.tpl" data=$BUTTONS}
<table cellspacing="0" cellpadding="0" width="100%">
 <tr>
  <td class="view_header">
   <span class="title">{"Samples"|translate}</span><br />
  </td>
 </tr>
 <tr>
  <td class="view_separator" colspan="4"><img src="{$XT_IMAGES}spacer.gif" alt="" /></td>
 </tr>
 <tr>
  <td style="padding: 15px;">
   <table cellspacing="0" cellpadding="0" width="100%">
    <tr>
     <td class="wizard" colspan="2"><b>{"What should the wizard create for you?"|translate}</b></td>
    </tr>

    <tr>
     <td style="padding: 5px; width: 16px; padding-top: 2px; padding-bottom: 2px;">
      <input type="checkbox" name="x{$BASEID}_create[0]" value="1" onclick="showhideCheckbox('x{$BASEID}_create[0]','create0')" disabled>
     </td>
     <td class="wizard" style="padding-top: 2px; padding-bottom: 2px;">Sample overview (No split)</td>
    </tr>
    <tr id="create0" style="display: {if $INFOEMAIL==1}table-row{else}none{/if};">
     <td style="padding: 5px; width: 16px;">&nbsp;</td>
     <td class="wizard">
      <table cellspacing="0" cellpadding="0" width="100%">
       <tr>
        <td style="width: 100px;"><span class="subline">Choose table:</span></td>
        <td class="wizard_form">
         <select name="x{$BASEID}_create0_table">
          {foreach from=$TABLES key=TABLE item=ITEM}
          <option>{$TABLE}</option>
          {/foreach}
         </select>
        </td>
       </tr>
       <tr>
        <td style="width: 100px;"><span class="subline">Fields to display</span></td>
        <td class="wizard_form">
         <input type="checkbox" name="x{$BASEID}_create0_fields[0]" value="1">
        </td>
       </tr>
      </table>
     </td>
    </tr>

    <tr>
     <td style="padding: 5px; width: 16px; padding-top: 2px; padding-bottom: 2px;"><input disabled type="checkbox" name="x{$BASEID}_create[1]" value="1"></td>
     <td class="wizard" style="padding-top: 2px; padding-bottom: 2px;">Sample overview (Left: Overview table, Right: Edit)</td>
    </tr>
    <tr>
     <td style="padding: 5px; width: 16px; padding-top: 2px; padding-bottom: 2px;"><input disabled type="checkbox" name="x{$BASEID}_create[2]" value="1"></td>
     <td class="wizard" style="padding-top: 2px; padding-bottom: 2px;">Sample tree overview (Left: Overview tree, Right: Edit)</td>
    </tr>
    <tr>
     <td style="padding: 5px; width: 16px; padding-top: 2px; padding-bottom: 2px;"><input disabled type="checkbox" name="x{$BASEID}_create[3]" value="1"></td>
     <td class="wizard" style="padding-top: 2px; padding-bottom: 2px;">Action: Deactivate / Activate</td>
    </tr>
    <tr>
     <td style="padding: 5px; width: 16px; padding-top: 2px; padding-bottom: 2px;"><input disabled type="checkbox" name="x{$BASEID}_create[4]" value="1"></td>
     <td class="wizard" style="padding-top: 2px; padding-bottom: 2px;">Action: Delete</td>
    </tr>
    <tr>
     <td style="padding: 5px; width: 16px; padding-top: 2px; padding-bottom: 2px;"><input disabled type="checkbox" name="x{$BASEID}_create[5]" value="1"></td>
     <td class="wizard" style="padding-top: 2px; padding-bottom: 2px;">Action: Save</td>
    </tr>
    <tr>
     <td style="padding: 5px; width: 16px; padding-top: 2px; padding-bottom: 2px;"><input disabled type="checkbox" name="x{$BASEID}_create[6]" value="1"></td>
     <td class="wizard" style="padding-top: 2px; padding-bottom: 2px;">Action: Save and close</td>
    </tr>
    <tr>
     <td class="wizard" colspan="2"><input type="button" onClick="this.form.x{$BASEID}_action.value='goToNextStep';this.form.submit();" name="x{$BASEID}_wizard_submit" value="{"Finish"|translate}"></td>
    </tr>
   </table>
  </td>
 </tr>
</table>
<input type="hidden" name="x{$BASEID}_wizard" value="1" />
<input type="hidden" name="x{$BASEID}_step" value="5" />
</form>

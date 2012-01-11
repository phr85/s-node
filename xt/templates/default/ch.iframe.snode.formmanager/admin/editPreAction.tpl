<form method="POST" name="editPreAction">
<table cellspacing="0" cellpadding="0" width="100%">
 <tr>
  <td class="view_header" colspan="2">
   <span class="title_light">{"PreAction"|translate}:</span><span class="title"> {$DATA.pos}</span>
  </td>
 </tr>
 <tr>
  <td class="view_separator" colspan="2"><img src="{$XT_IMAGES}spacer.gif" alt="" /></td>
 </tr>
</table>
{include file="includes/buttons.tpl" data=$EDIT_PREACTION_BUTTONS}
<table cellspacing="0" cellpadding="0" width="100%">
 <tr>
  <td class="left">{"Action type"|translate}</td>
  <td class="right">
   <select name="x{$BASEID}_type" onChange="document.forms['editPreAction'].x{$BASEID}_new_type.value=1;document.forms['editPreAction'].x{$BASEID}_action.value='savePreAction';document.forms['editPreAction'].submit()">
   <option value="3" {if $DATA.type == 3}selected{/if}>{"Call script"|translate}</option>
   <option value="2" {if $DATA.type == 2}selected{/if}>{"Send mail"|translate}</option>
    <option value="5" {if $DATA.type == 5}selected{/if}>{"Send internal message"|translate}</option>

   </select>
  </td>
 </tr>
 {if $DATA.type == 2}
 <tr>
  <td class="left">{"E-Mail address"|translate}</td>
  <td class="right"><input type="text" name="x{$BASEID}_value" value="{$DATA.value}" size="42" style="color: red;"></td>
 </tr>
 {/if}
 {if $DATA.type == 3}
 <tr>
  <td class="left">{"Choose script"|translate}</td>
  <td class="right">
   <select name="x{$BASEID}_value" onChange="document.forms['editPreAction'].x{$BASEID}_new.value=1;document.forms['editPreAction'].x{$BASEID}_action.value='savePreAction';document.forms['editPreAction'].submit()">
    {foreach from=$SCRIPTS item=SCRIPT}
    <option value="{$SCRIPT.id}" {if $SCRIPT.id == $DATA.value}selected{/if}>{$SCRIPT.title}</option>
    {/foreach}
   </select>
  </td>
 </tr>
 <tr>
  <td class="right" colspan="2">{$SCRIPT_CONTENT}</td>
 </tr>
 {/if}
 {if $DATA.type == 5}
 <tr>
  <td class="left">{"Choose receiver"|translate}</td>
  <td class="right">
   <select name="x{$BASEID}_value" onChange="document.forms['editPreAction'].x{$BASEID}_new.value=1;document.forms['editPreAction'].x{$BASEID}_action.value='savePreAction';document.forms['editPreAction'].submit()">
    {foreach from=$USERS item=USER}
    <option value="{$USER.id}" {if $USER.id == $DATA.value}selected{/if}>{$USER.username}</option>
    {/foreach}
   </select>
  </td>
 </tr>
 {/if}
</table>
<input type="hidden" name="x{$BASEID}_rule_id" value="{$DATA.id}" />
<input type="hidden" name="x{$BASEID}_new" value="0" />
<input type="hidden" name="x{$BASEID}_form_id" />
<input type="hidden" name="x{$BASEID}_new_type" value="0" />
<input type="hidden" name="x{$BASEID}_script_id" />
</form>

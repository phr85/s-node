<form method="POST" name="editElementRule">
<table cellspacing="0" cellpadding="0" width="100%">
 <tr>
  <td class="view_header" colspan="2">
   <span class="title_light">{"Rule"|translate}:</span><span class="title"> {$DATA.title}</span>
  </td>
 </tr>
 <tr>
  <td class="view_separator" colspan="2"><img src="{$XT_IMAGES}spacer.gif" alt="" /></td>
 </tr>
</table>
{include file="includes/buttons.tpl" data=$EDIT_RULE_BUTTONS}
<table cellspacing="0" cellpadding="0" width="100%">
 <tr>
  <td class="left">{"Title"|translate}</td>
  <td class="right"><input type="text" name="x{$BASEID}_title" value="{$DATA.title|htmlspecialchars}" size="42"></td>
 </tr>
 <tr>
  <td class="left">{"Compare mode"|translate}</td>
  <td class="right">
   <select name="x{$BASEID}_compare_type" onChange="document.forms['editElementRule'].x{$BASEID}_action.value='saveRule';document.forms['editElementRule'].submit()">
    <option value="1" {if $DATA.compare_type == 1}selected{/if}>{"Simple compare"|translate}</option>
    <option value="2" {if $DATA.compare_type == 2}selected{/if}>{"Regular expression compare (Perl)"|translate}</option>
    <option value="3" {if $DATA.compare_type == 3}selected{/if}>{"Regular expression compare (POSIX)"|translate}</option>
    <option value="4" {if $DATA.compare_type == 4}selected{/if}>{"Rulescript"|translate}</option>
   </select>
  </td>
 </tr>
 {if $DATA.compare_type == 1}
 <tr>
  <td class="left">{"Compare query"|translate}</td>
  <td class="right">
   <select name="x{$BASEID}_compare_query">
    <option value="==" {if $DATA.compare_query == '=='}selected{/if}>{"Equal"|translate}</option>
    <option value=">=" {if $DATA.compare_query == '>='}selected{/if}>{"Greater than or equal"|translate}</option>
    <option value="<=" {if $DATA.compare_query == '<='}selected{/if}>{"Less than or equal"|translate} </option>
    <option value="!=" {if $DATA.compare_query == '!='}selected{/if}>{"Not equal"|translate}</option>
    <option value=">"  {if $DATA.compare_query == '>'}selected{/if}>{"Greater than"|translate}</option>
    <option value="<"  {if $DATA.compare_query == '<'}selected{/if}>{"Less than"|translate}</option>
   </select>
  </td>
 </tr>
 {/if}

 {if $DATA.compare_type == 2 || $DATA.compare_type == 3}
 <tr>
  <td class="left">{"Compare query (e.g. >=)"|translate}</td>
  <td class="right"><input type="text" name="x{$BASEID}_compare_query" value="{$DATA.compare_query}" size="42"></td>
 </tr>
 {/if}

 {if $DATA.compare_type == 1 || $DATA.compare_type == 2 || $DATA.compare_type == 3}
 <tr>
  <td class="left">{"Compare against value"|translate}</td>
  <td class="right"><input type="text" name="x{$BASEID}_value" value="{$DATA.value}" size="42"></td>
 </tr>
 <tr>
  <td class="left">{"Error message on failure"|translate}</td>
  <td class="right"><input type="text" name="x{$BASEID}_error_msg" value="{$DATA.error_msg|default:"!"}" size="60" style="color: red;"></td>
 </tr>
 {/if}
 {if $DATA.compare_type == 4}

 <tr>
  <td class="left">{"Choose script"|translate}</td>
  <td class="right">
   <select name="x{$BASEID}_value" onChange="document.forms['editAction'].x{$BASEID}_new.value=1;document.forms['editAction'].x{$BASEID}_action.value='saveAction';document.forms['editAction'].submit()">
    {foreach from=$SCRIPTS item=SCRIPT}
    <option value="{$SCRIPT.id}" {if $SCRIPT.id == $DATA.value}selected{/if}>{$SCRIPT.title}</option>
    {/foreach}
   </select>
  </td>
 </tr>

 {/if}
</table>
<input type="hidden" name="x{$BASEID}_rule_id" value="{$DATA.id}" />
<input type="hidden" name="x{$BASEID}_script_id" />
<input type="hidden" name="x{$BASEID}_form_id" />
</form>

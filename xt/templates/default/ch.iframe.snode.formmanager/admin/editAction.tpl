<form method="POST" name="editAction">
<table cellspacing="0" cellpadding="0" width="100%">
 <tr>
  <td class="view_header" colspan="2">
   <span class="title_light">{"Action"|translate}:</span><span class="title"> {$DATA.pos}</span>
  </td>
 </tr>
 <tr>
  <td class="view_separator" colspan="2"><img src="{$XT_IMAGES}spacer.gif" alt="" /></td>
 </tr>
</table>
{include file="includes/buttons.tpl" data=$EDIT_ACTION_BUTTONS}
<table cellspacing="0" cellpadding="0" width="100%">
 <tr>
  <td class="left">{"Action type"|translate}</td>
  <td class="right">
   <select name="x{$BASEID}_type" onChange="document.forms['editAction'].x{$BASEID}_new_type.value=1;document.forms['editAction'].x{$BASEID}_action.value='saveAction';document.forms['editAction'].submit()">
    <option value="1" {if $DATA.type == 1}selected{/if}>{"Redirect (External)"|translate}</option>
    <option value="7" {if $DATA.type == 7}selected{/if}>{"Redirect (Internal)"|translate}</option>
    <option value="2" {if $DATA.type == 2}selected{/if}>{"Send mail"|translate}</option>
    <option value="5" {if $DATA.type == 5}selected{/if}>{"Send internal message"|translate}</option>
    <option value="3" {if $DATA.type == 3}selected{/if}>{"Call script"|translate}</option>
    <option value="4" {if $DATA.type == 4}selected{/if}>{"Call form"|translate}</option>
   </select>
  </td>
 </tr>
 {if $DATA.type == 1}
 <tr>
  <td class="left">{"Value (e.g. redirect url...)"|translate}</td>
  <td class="right"><input type="text" name="x{$BASEID}_value" value="{$DATA.value}" size="42" style="color: red;"></td>
 </tr>
 {/if}
 {if $DATA.type == 7}
 <tr>
  <td class="left">{"Choose page"|translate}</td>
  <td class="right">
  <a href="#" onclick="popup('{$smarty.server.PHP_SELF}?TPL=131&field=x{$BASEID}_value&form=editAction',960,500);">
<img src="images/icons/breakpoint_add.png" {"please select a Page"|alttag}></a>
<input type="hidden" name="x{$BASEID}_value_title" size="60" disabled value="{$PAGES[$BANNER.link][title]}">


   <select name="x{$BASEID}_value" value="{$DATA.value}">
   {foreach from=$PAGES item=PAGE}
    <option value="{$PAGE.node_id}" {if $DATA.value == $PAGE.node_id}selected{/if}>{$PAGE.title}</option>
   {/foreach}
   </select>
  </td>
 </tr>
 {/if}
 {if $DATA.type == 2}
 <tr>
  <td class="left">{"E-Mail address"|translate} ++</td>
  <td class="right"><input type="text" name="x{$BASEID}_value" value="{$DATA.value}" size="42" style="color: red;">
  <br />
  <br />

  info@foo.bar.com<br />
  field:SCRIPTING_IDENTIFIER<br />
  session:SESSIONVARIABLE<br />
  request:PHP REQUEST Value<br />
  get:PHP GET Value<br />
  post:PHP POST Value<br />


  </td>
 </tr>
 <tr>
  <td class="left">{"mail template"|translate}</td>
  <td class="right"><input type="text" name="x{$BASEID}_metadata" value="{$DATA.metadata}" size="42">
   </td>
 </tr>

 {/if}
 {if $DATA.type == 3}
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
 <tr>
  <td class="right" colspan="2">{$SCRIPT_CONTENT}</td>
 </tr>
 {/if}
 {if $DATA.type == 4}
 <tr>
  <td class="left">{"Choose form to call"|translate}</td>
  <td class="right">
   <select name="x{$BASEID}_value" onChange="document.forms['editAction'].x{$BASEID}_new.value=1;document.forms['editAction'].x{$BASEID}_action.value='saveAction';document.forms['editAction'].submit()">
    {foreach from=$FORMS item=FORM}
    <option value="{$FORM.id}" {if $FORM.id == $DATA.value}selected{/if}>{$FORM.title}</option>
    {/foreach}
   </select>
  </td>
 </tr>
 {/if}
 {if $DATA.type == 5}
 <tr>
  <td class="left">{"Choose receiver"|translate}</td>
  <td class="right">
   <select name="x{$BASEID}_value" onChange="document.forms['editAction'].x{$BASEID}_new.value=1;document.forms['editAction'].x{$BASEID}_action.value='saveAction';document.forms['editAction'].submit()">
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

<form method="post" name="edit">
<table cellspacing="0" cellpadding="0" width="100%">
 <tr>
  <td class="view_header" colspan="2">
   <span class="title_light">{"Parameters for"|translate}</span>:&nbsp;<span class="title">{$DATA.package}.{$DATA.module}</span>
  </td>
 </tr>
  <tr>
  <td class="view_separator" colspan="2"><img src="{$XT_IMAGES}spacer.gif" alt="" /></td>
 </tr>
</table>
{include file="includes/buttons.tpl" data=$EDITCONTENTS_BUTTONS}
<table cellspacing="0" cellpadding="0" width="100%">
{foreach from=$DATA.params item=PARAM key=NAME}
 <tr>
  <td class="view_header" colspan="2">
   <span class="title">{$PARAM.title}</span>
  </td>
 </tr>
  <tr>
  <td class="view_separator" colspan="2"><img src="{$XT_IMAGES}spacer.gif" alt="" /></td>
 </tr>
 <tr>
  <td colspan="2" class="view_right">{$PARAM.description}&nbsp;</td>
 </tr>
  {if $PARAM.entrytype == 'userinput'}
  {if $PARAM.title == "style" || $PARAM.title == "Style" }
  	<tr>
       <td class="view_right" colspan="2">

          <select name="x{$BASEID}_params[{$NAME}]">
          	{foreach from=$TEMPLATES item=TT}
          		{if $TT.default != ""}
          		<option value="{$TT.default}" {if $PARAM.value == $TT.default}selected="selected"{/if}{if $PARAM.value=="" AND $PARAM.defaultvalue == $TT.default}selected="selected"{/if}>{$TT.default}</option>
          		{else}
          		<option value="{$TT.theme}" style="background-color:#38FF18;" {if $PARAM.value == $TT.theme}selected="selected"{/if}{if $PARAM.value =="" AND $PARAM.defaultvalue == $TT.theme}selected="selected"{/if}>{$TT.theme} ({$THEME})</option>
          		{/if}
          	{/foreach}
          </select>
       </td>
    </tr>
  {else}
     <tr>
       <td class="view_right" colspan="2">
          <input type="text" name="x{$BASEID}_params[{$NAME}]" size="50" value="{if $PARAM.value == ''}{$PARAM.defaultvalue}{else}{$PARAM.value}{/if}">
       </td>
    </tr>
  {/if}
 {elseif $PARAM.entrytype == 'popup'}
      <tr>
       <td class="view_right" colspan="2">
<a href="#" onclick="popup('{$smarty.server.PHP_SELF}?TPL={$PARAM.tpl}&field=x{$BASEID}_params_{$NAME}&form=edit&data={$PARAM.value}',960,500);">
<img src="images/icons/breakpoint_add.png" {"please select an item"|alttag}></a>
<input type="hidden" name="x{$BASEID}_params[{$NAME}]" value="{$PARAM.value}" />
<input type="hidden" name="x{$BASEID}_params_{$NAME}" value="{$PARAM.value}">
<input type="text" name="x{$BASEID}_params_{$NAME}_title" size="60" disabled value="{$PARAM.titlevalue|default:$PARAM.value}">

       </td>
    </tr>
 {else}
 <tr>
   <td class="view_right" colspan="2">
   <select name="x{$BASEID}_params[{$NAME}]" size="1">

        <option value="not_selected">&nbsp;</option>
       {foreach from=$PARAM.allowed item=VALUE}
            <option {if $VALUE.value != ''}value="{$VALUE.value}"{/if} {if $PARAM.value == $VALUE.value}selected{/if}>{$VALUE.label}</option>
       {/foreach}

   </select>
   </td>
 </tr>
 {/if}
 {/foreach}
</table>
<input type="hidden" name="x{$BASEID}_id" value="" />
<input type="hidden" name="x{$BASEID}_node_id" value="{$NODE_ID}" />
<input type="hidden" name="x{$BASEID}_node_pid" value="{$NODE_PID}" />
<input type="hidden" name="x{$BASEID}_node_perm_pid" />
<input type="hidden" name="x{$BASEID}_node_perm_id" />
<input type="hidden" name="x{$BASEID}_entry_id" value="{$ENTRY_ID}" />
<input type="hidden" name="x{$BASEID}_entry_position" value="{$ENTRY_POSITION}" />
<input type="hidden" name="x{$BASEID}_target_module" value="" />
<input type="hidden" name="x{$BASEID}_livetpl" value="{$LIVETPL}" />
<input type="hidden" name="TPL" value="{$TPL}" />
</form>
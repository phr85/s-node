<form method="post" name="navigation" action="{$smarty.server.PHP_SELF}?TPL={$TPL}" onSubmit="window.document.forms['navigation'].x{$BASEID}_yoffset.value=window.pageYOffset;">
{include file="includes/lang_selector_simple.tpl" form="navigation"}
<table cellpadding="0" cellspacing="0" width="100%">
 {foreach from=$NODES item=NODE}
  {if $NODE.id != 100 && $NODE.id != 106}
  {if $NODE.allowed.view == 1}
  <tr class="{cycle values="row_a,row_b"}">
   <td>
    <table cellspacing="0" cellpadding="0" width="100%">
     <tr>
      {if $NODE.l != 1}<td class="row" style="padding-left: {$NODE.level*20-32}px; width: 1px;">{if $NODE.subs > 0}{if $NODE.itw}<a href="javascript:document.forms['navigation'].x{$BASEID}_open.value={$NODE.pid};document.forms['navigation'].submit();"><img src="{$XT_IMAGES}icons/minus.gif" alt="" /></a>{else}<a href="javascript:document.forms['navigation'].x{$BASEID}_open.value={$NODE.id};document.forms['navigation'].submit();"><img src="{$XT_IMAGES}icons/plus.gif" alt="" /></a>{/if}{else}<img src="{$XT_IMAGES}spacer.gif" width="9" height="9" alt="" />{/if}</td>{/if}
      <td class="row" style="padding: 5px; padding-right: 0px;width: 16px">
      <a href="javascript:window.parent.frames['slave1'].document.forms[0].x{$BASEID}_action.value='';
window.parent.frames['slave1'].document.forms[0].x{$BASEID}_open.value={$NODE.id};
window.parent.frames['slave1'].document.forms[0].submit();
document.forms['navigation'].x{$BASEID}_open.value={$NODE.id};
document.forms['navigation'].submit();">{if $NODE.itw}{if $NODE.subs > 0}<img src="{$XT_IMAGES}icons/explorer/folder.png" alt="" />{else}<img src="{$XT_IMAGES}icons/explorer/folder.png" alt="" />{/if}{else}{if $NODE.subs > 0}<img src="{$XT_IMAGES}icons/explorer/folder_closed.png" alt="" />{else}<img src="{$XT_IMAGES}icons/explorer/folder_closed.png" alt="" />{/if}{/if}</a><br />
      </td>
      <td class="row">
      <a href="javascript:window.parent.frames['slave1'].document.forms[0].x{$BASEID}_action.value='';
window.parent.frames['slave1'].document.forms[0].x{$BASEID}_open.value={$NODE.id};
window.parent.frames['slave1'].document.forms[0].submit();
document.forms['navigation'].x{$BASEID}_open.value={$NODE.id};
document.forms['navigation'].submit();">
      {if $NODE.itw}<span style="color: black;">{if $NODE.selected}<b>{$NODE.title}</b>{if $NODE.subs > 0}&nbsp;({$NODE.subs}){/if}{else}{$NODE.title}{if $NODE.subs > 0}&nbsp;({$NODE.subs}){/if}{/if}</span>{else}{$NODE.title}{if $NODE.subs > 0}&nbsp;({$NODE.subs}){/if}{/if}{if !$NODE.lang_na}</a>{/if}</td>
      <td class="button" align="right">
&nbsp;
      </td>
     </tr>
    </table>
   </td>
  </tr>
  {/if}
  {/if}
 {/foreach}
</table>
<input type="hidden" name="x{$BASEID}_id" value="" />
<input type="hidden" name="x{$BASEID}_position" value="" />
<input type="hidden" name="x{$BASEID}_node_id" value="" />
<input type="hidden" name="x{$BASEID}_node_pid" value="" />
<input type="hidden" name="x{$BASEID}_open" value="" />
<input type="hidden" name="x{$BASEID}_action" value="" />
<input type="hidden" name="x{$BASEID}_target_module" value="" />
<input type="hidden" name="x{$BASEID}_source_node_id" value="" />
{yoffset}
</form>
</td>
</tr>
</table>
<form method="post" name="o">
{include file="includes/lang_selector_simple.tpl" form="o"}
<table cellpadding="0" cellspacing="0" width="100%">
 {foreach from=$NODES item=NODE}
  <tr class="{cycle values="row_a,row_b"}" colspan="2">
   <td>
    <table cellspacing="0" cellpadding="0" width="100%">
     <tr>
      {if $NODE.l != 1}<td class="row" style="padding-left: {$NODE.level*20-32}px; width: 1px;">{if $NODE.subs > 0}{if $NODE.itw}<a href="javascript:document.forms[0].x{$BASEID}_action.value='';document.forms[0].x{$BASEID}_open.value={$NODE.pid};document.forms[0].submit();document.forms['o'].x{$BASEID}_open.value={$NODE.pid};document.forms['o'].submit();"><img src="{$XT_IMAGES}icons/minus.gif" alt="" /></a>{else}<a href="javascript:document.forms[0].x{$BASEID}_action.value='';document.forms[0].x{$BASEID}_open.value={$NODE.id};document.forms[0].submit();document.forms['o'].x{$BASEID}_open.value={$NODE.id};document.forms['o'].submit();"><img src="{$XT_IMAGES}icons/plus.gif" alt="" /></a>{/if}{else}<img src="{$XT_IMAGES}spacer.gif" width="9" />{/if}</td>{/if}
      <td class="row" style="padding: 5px; padding-right: 0px;width: 16px">
       <a href="javascript:document.forms['o'].x{$BASEID}_open.value={$NODE.id};document.forms['o'].submit();">{if $NODE.itw}{if $NODE.subs > 0}<img src="{$XT_IMAGES}icons/explorer/folder.png" alt="" />{else}<img src="{$XT_IMAGES}icons/pick_photo.png" alt="" />{/if}{else}{if $NODE.subs > 0}<img src="{$XT_IMAGES}icons/explorer/folder_closed.png" alt="" />{else}<img src="{$XT_IMAGES}icons/photo_portrait.png" alt="" />{/if}{/if}</a><br />
      </td>
      <td class="row">{$NODE.title}</td>
      <td class="button" align="right">
      <a href="javascript:window.parent.opener.document.forms['{$FORM}'].{$FIELD}.value={$NODE.id};window.parent.opener.document.forms['{$FORM}'].{$FIELD}_title.value='{$NODE.title|stripquotes}';window.parent.close();"><img src="{$XT_IMAGES}icons/check.png" width="16" height="16" alt="{"Select this gallery"|translate}" /></a>
      </td>
     </tr>
    </table>
   </td>
  </tr>
 {/foreach}
</table>
<input type="hidden" name="x{$BASEID}_id" value="" />
<input type="hidden" name="x{$BASEID}_position" value="" />
<input type="hidden" name="x{$BASEID}_node_id" value="" />
<input type="hidden" name="x{$BASEID}_node_pid" value="" />
<input type="hidden" name="x{$BASEID}_open" value="" />
<input type="hidden" name="x{$BASEID}_source_node_id" value="" />
{yoffset}
</form>
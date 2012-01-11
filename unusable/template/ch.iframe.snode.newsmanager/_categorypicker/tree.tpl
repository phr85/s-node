<form method="POST" name="o">
{include file="includes/lang_selector_simple.tpl" form="o"}
<table cellpadding="0" cellspacing="0" width="100%">
 {foreach from=$NODES item=NODE}
  <tr class="{cycle values="row_a,row_b"}">
   <td>
    <table cellspacing="0" cellpadding="0" width="100%">
     <tr>
      {if $NODE.l != 1}<td class="row" style="padding-left: {$NODE.level*20-32}px; width: 1px;">{if $NODE.subs > 0 || $NEWS[$NODE.id] > 0}{if $NODE.itw}<a href="javascript:document.forms['o'].x{$BASEID}_open.value={$NODE.pid};document.forms['o'].submit();"><img src="{$XT_IMAGES}icons/minus.gif" alt=""></a>{else}<a href="javascript:document.forms['o'].x{$BASEID}_open.value={$NODE.id};document.forms['o'].submit();"><img src="{$XT_IMAGES}icons/plus.gif" alt=""></a>{/if}{else}<img src="{$XT_IMAGES}spacer.gif" width="9">{/if}</td>{/if}
      <td class="row" style="padding: 5px; padding-right: 0px;width: 16px">
       <a href="javascript:window.document.forms[0].x{$BASEID}_open.value={$NODE.id};window.document.forms[0].submit();document.forms['o'].x{$BASEID}_open.value={$NODE.id};document.forms['o'].submit();">{if $NODE.itw}{if $NODE.subs > 0}<img src="{$XT_IMAGES}icons/explorer/folder.png" alt="">{else}<img src="{$XT_IMAGES}icons/explorer/folder.png" alt="">{/if}{else}{if $NODE.subs > 0}<img src="{$XT_IMAGES}icons/explorer/folder_closed.png" alt="">{else}<img src="{$XT_IMAGES}icons/explorer/folder_closed.png" alt="">{/if}{/if}</a><br>
      </td>
      <td class="row"><a href="javascript:window.document.forms[0].x{$BASEID}_open.value={$NODE.id};window.document.forms[0].submit();document.forms['o'].x{$BASEID}_open.value={$NODE.id};document.forms['o'].submit();">{if $NODE.itw}<span style="color: black;">{if $NODE.selected}<b>{$NODE.title}</b>{else}{$NODE.title}{/if}</span>{else}{$NODE.title}{/if}&nbsp;</a></td>
      <td class="button" align="right">
      {actionIcon 
        action="addCategoryToSelection"
        icon="check.png"
        target="slave1"
        form="slave1"
        id=$NODE.id
        title="add this category to selection"
      }
      </td>
     </tr>
    </table>
   </td>
  </tr>
  {if $NODE.itw}
  {foreach from=$NEWS[$NODE.id] item=NEWS}
  <tr>
   <td>
    <table cellspacing="0" cellpadding="0" width="100%">
     <tr class="{cycle values="row_a,row_b"}">
      <td class="row" style="padding-left: {$NODE.level*20-12}px; width: 1px;"><img src="{$XT_IMAGES}spacer.gif" alt="" width="9" /></td>
      <td class="row" style="padding: 5px; padding-right: 0px;width: 16px">{if $NEWS.published == 1}<img class="icon" src="{$XT_IMAGES}icons/document_green.png" alt="{'Published'|translate}" title="{'Published'|translate}"/>{else}{actionIcon 
        action=""
        icon="document_red.png"
        form="o"
        perm="statuschange"
        id=$NEWS.id
        title="article is not published"
      }{/if}</td>
      <td class="row">
      <span style="color: black;"><b>{$NEWS.title}</b>&nbsp;
      <span style="color: #666666;">({$NEWS.rid})</span></td>
      <td class="button" width="80" align="right">&nbsp;</td>
     </tr>
    </table>
   </td>
  </tr>
  {/foreach}
  {/if}
 {/foreach}
</table>
<input type="hidden" name="x{$BASEID}_id" value="">
<input type="hidden" name="x{$BASEID}_position" value="">
<input type="hidden" name="x{$BASEID}_action" value="">
<input type="hidden" name="x{$BASEID}_node_id" value="">
<input type="hidden" name="x{$BASEID}_node_pid" value="">
<input type="hidden" name="x{$BASEID}_open" value="">
<input type="hidden" name="x{$BASEID}_source_node_id" value="">
{yoffset}
</form>
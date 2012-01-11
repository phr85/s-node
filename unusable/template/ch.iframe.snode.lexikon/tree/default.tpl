<table cellspacing="0" cellpadding="0">
<tr>
 <td style="font-size: 14px; font-style: italic; padding-bottom: 8px;">
  <b>{"Lexikon"|translate}</b>
 </td>
</tr>
</table>
{if sizeof($DATA) > 0}
<table width="100%" cellpadding="0" cellspacing="0" border="0" class="navigation_tree">
  {foreach from=$DATA item=NAV}
 <tr>
  {if $NAV.selected}
  <td class="navigation_tree_entry_active" style="padding-left: {$NAV.level*15-30}px;">
  <a href="{$smarty.server.PHP_SELF}?TPL={get_param param='details_tpl'}&amp;x{$BASEID}_node_id={$NAV.id}">
  {$NAV.title}</a>
  </td></tr>
      {foreach from=$SUBENTRIES item=SUBS}
       {if $SUBS.id == $SUBACTIVE}
          <tr><td class="navigation_tree_entry_active" style="padding-left: {$NAV.level*15-20}px;">
          <a href="{$smarty.server.PHP_SELF}?TPL=679&amp;x55000_article_id={$SUBS.id}">{$SUBS.title}</a>
          </td></tr>
          {else}
          <tr><td class="navigation_tree_entry" style="padding-left: {$NAV.level*15-20}px;">
          <a href="{$smarty.server.PHP_SELF}?TPL=679&amp;x55000_article_id={$SUBS.id}">{$SUBS.title}</a>
          </td></tr>
      {/if}
      {/foreach}
  {else}
  <td class="navigation_tree_entry" style="padding-left: {$NAV.level*15-30}px;">
  <a href="{$smarty.server.PHP_SELF}?TPL={get_param param='details_tpl'}&amp;x{$BASEID}_node_id={$NAV.id}">
  {$NAV.title}</a>
  </td>
     </tr>
  {/if}
 {/foreach}
</table>
{if $AUTH}<a href="{$smarty.server.PHP_SELF}?TPL={$ADMIN_TPL}&amp;x{$BASEID}_action=addPage&amp;x{$BASEID}_open={$NAV.pid}&amp;module=o"><img src="{$XT_IMAGES}icons/add.png" alt="{'Add a new page'|translate}" title="{'Add a new page'|translate}" style="padding-top: 6px;" /></a>{/if}
{/if}

{if sizeof($DATA.tree) > 0}
  {foreach from=$DATA.tree item=NAV}
  <div class="rezepte_tree{if $NAV.selected} rt_selected{/if}" style="padding-left: {$NAV.level*15-15}px;">
  <a href="{$smarty.server.PHP_SELF}?TPL={get_param param='details_tpl'}&amp;x{$BASEID}_node={$NAV.id}">
  {$NAV.title}</a>
   </div>
 {/foreach}
{/if}
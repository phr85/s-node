{if sizeof($DATA) > 0}
 {foreach from=$DATA item=NAV}
  {if $NAV.active_element}
   <img src="{$XT_IMAGES}spacer.gif" alt="" height="1" width="{$NAV.level*5-5}">
   <a href="{$smarty.server.PHP_SELF}?TPL={$NAV.id}">{$NAV.title}</a><br>
  {else}
   <img src="{$XT_IMAGES}spacer.gif" alt="" height="1" width="{$NAV.level*5-5}">
   <a href="{$smarty.server.PHP_SELF}?TPL={$NAV.id}">{$NAV.title}</a> {$NAV.level}-{$NAV.selected}<br>
  {/if}
 {/foreach}
{/if}

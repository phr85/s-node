{if sizeof($DATA) > 0}
 {foreach from=$DATA item=NAV}
  {if $NAV.active_element}
   <img src="{$XT_IMAGES}spacer.gif" alt="" height="1" width="{$NAV.level*5-5}" />
   <a {if $NAV.target != ''}target="{$NAV.target}"{/if} href="{if $NAV.ext_link}{$NAV.ext_link}{else}{$smarty.server.PHP_SELF}?TPL={$NAV.id}{/if}">{$NAV.title}</a><br />
  {else}
   <img src="{$XT_IMAGES}spacer.gif" alt="" height="1" width="{$NAV.level*5-5}" />
   <a {if $NAV.target != ''}target="{$NAV.target}"{/if} href="{if $NAV.ext_link}{$NAV.ext_link}{else}{$smarty.server.PHP_SELF}?TPL={$NAV.id}{/if}">{$NAV.title}</a> {$NAV.level}-{$NAV.selected}<br />
  {/if}
 {/foreach}
{/if}

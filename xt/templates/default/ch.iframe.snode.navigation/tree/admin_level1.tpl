{if sizeof($DATA) > 0}
 {foreach from=$DATA item=NAV}
  {if $NAV.itw
      }<div class="naventry_active" style="padding-left: {$NAV.level*6}px;">
      <a target="{$NAV.target}" href="{if $NAV.ext_link}{$NAV.ext_link|htmlentities}{else}{$smarty.server.PHP_SELF}?TPL={$NAV.id}&amp;adminmode=1{/if}">{$NAV.title|htmlentities}</a></div>{
      else
      }<div class="naventry" style="padding-left: {$NAV.level*6}px;">
      <a target="{$NAV.target}" href="{if $NAV.ext_link}{$NAV.ext_link|htmlentities}{else}{$smarty.server.PHP_SELF}?TPL={$NAV.id}&amp;adminmode=1{/if}">{$NAV.title|htmlentities}</a></div>{
      /if}
 {/foreach}
{/if}
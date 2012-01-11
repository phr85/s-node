{if sizeof($DATA) > 0}
 {foreach from=$DATA item=NAV}
    <div class="navigation_subentry{if $NAV.itw}_active{/if}" style="padding-left: {$NAV.level*11-20}px;">
    {if $NAV.subs}<img src="{$XT_IMAGES}icons/plus_blue.gif" />&nbsp;&nbsp;{/if}
    <a {if $NAV.target!=""}target="{$NAV.target}" {/if}href="{if $NAV.ext_link}{$NAV.ext_link}{else}{$smarty.server.PHP_SELF}?TPL={$NAV.id}&amp;adminmode=1{/if}">{$NAV.title|htmlspecialchars}</a>
    </div>
 {/foreach}
{/if}
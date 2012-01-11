{foreach from=$LANGUAGES key=LANGKEY item=LANGUAGE name=L}
    <a class="{if $LANGKEY == $SYSTEM_LANG}langlinkitw{else}langlink{/if}" 

href="{if !$NAV.ext_link}http://{$smarty.server.SERVER_NAME}/index_{$LANGKEY}.php{if $smarty.server.QUERY_STRING}?{$smarty.server.QUERY_STRING|escape}{/if}{else}{$NAV.ext_link}{/if}">
        {$LANGKEY|livetranslate}
    </a>
    {if !$smarty.foreach.L.last}
        <span>|</span>
    {/if}
{/foreach}
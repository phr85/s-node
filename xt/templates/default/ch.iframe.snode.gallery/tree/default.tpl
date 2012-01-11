{if sizeof($DATA) > 0}
<div style="border: 1px solid #c0c0c0; ">
{foreach from=$DATA item=NAV name=N}
<div style="padding-left:{$NAV.level*10}px; {if $NAV.itw}font-weight: bold;{/if}">
<a {if $NAV.target != ''}target="{$NAV.target}"{/if}
href="{if $NAV.ext_link}{$NAV.ext_link}{else}{$smarty.server.PHP_SELF}?TPL={$TPL}&amp;x{$BASEID}_node={$NAV.id}{/if}">{$NAV.title}</a>
</div>
{/foreach}
</div>
{/if}
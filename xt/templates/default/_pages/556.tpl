{include file="includes/header/header_admin_empty.tpl"}
{get_getvalue param="mod" assign="mod"}

{if $mod=="tree" OR $mod==""}
{plugin package="ch.iframe.snode.filemanager" module="_noderelations"}
{/if}
{if $mod=="list"}
{plugin package="ch.iframe.snode.category" module="_noderelations" display="list"}
{/if}

{include file="includes/footer/footer_admin_empty.tpl"}
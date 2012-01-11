{foreach from=$DATA item=REL}
{subplugin package="ch.iframe.snode.filemanager" module="downloadlist" category=$REL.content_id}
{/foreach}

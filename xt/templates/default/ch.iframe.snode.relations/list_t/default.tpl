{foreach from=$DATA item=REL}
<!-- example: subplugin package="ch.iframe.snode.filemanager" module="downloadlist" category=$REL.content_id -->
{print_data array=$REL}
{/foreach}

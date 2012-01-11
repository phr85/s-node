{foreach from=$xt3700_fulllist_reverse.DATA item=REL}
<!-- example: subplugin package="ch.iframe.snode.filemanager" module="downloadlist" category=$REL.content_id -->
{print_data array=$REL}
{/foreach}

{print_data array=$xt3700_fulllist_reverse.GROUPEDDATA}
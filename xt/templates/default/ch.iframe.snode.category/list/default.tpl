{foreach from=$SORTEDDATA.4500 item=REL}
{subplugin package="ch.iframe.snode.addresses" module="viewer" id=$REL.target_content_id}
{/foreach}

{foreach from=$DATA item=REL}
{if $REL.target_content_type==270}
{subplugin package="ch.iframe.snode.articles" module="viewer" id=$REL.target_content_id}
{/if}
{/foreach}

{print_data array=$SORTEDDATA}
{print_data array=$DATA}
<div style="background-color:#F1F1F1; padding: 3px;">
{foreach from=$DATA item=REL}
{subplugin package="ch.iframe.snode.filemanager" module="downloadlist" category=$REL.content_id}
{/foreach}
</div>
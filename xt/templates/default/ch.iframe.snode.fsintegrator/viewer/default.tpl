{foreach from=$FILES item=FILE name=FILEINTEGRATOR}
<div style="padding-left:{math equation="x * y - y" x=$FILE.depth y=20}px;">
{if $FILE.dir == 1}
	<img src="/images/icons/folder.png" alt="{"folder"|translate} {$FILE.filename}"/>
{else}
	{$FILE.filename|icon}
{/if}
<a href="{$FILE.location}" target="_blank">{$FILE.filename}</a>

</div>
{/foreach}
{$xt240_fileinfo.data.filename|icon}
<a href="{$XT_WEB_ROOT}download.php?file_id={$xt240_fileinfo.data.id}&download=true">{$xt240_fileinfo.data.title}</a> ({$xt240_fileinfo.data.filesize|format_filesize})<br />
{if $xt240_fileinfo.data.description!=""}
<span class="sideinfodesc">{$xt240_fileinfo.data.description}</span>
{/if}
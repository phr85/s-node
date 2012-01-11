{if sizeof($FILES) > 0}
<div class="right_head">Verwandte Dokumente</div>
<div style="padding: 10px;">
<table cellpadding="0" cellspacing="0" width="100%">
{foreach from=$FILES item=FILE}
<tr>
 <td width="20">{$FILE.filename|icon}</td>
 <td><a href="{$XT_WEB_ROOT}download.php?file_id={$FILE.id}">{$FILE.title}</a></td>
</tr>
{/foreach}
</table>
</div>
{/if}

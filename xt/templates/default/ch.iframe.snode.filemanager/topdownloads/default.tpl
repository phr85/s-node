<h1>{"Top"|translate} {$COUNT} {"Downloads"|translate}</h1><br />
<table cellpadding="0" cellspacing="0" width="100%">
{foreach from=$FILES item=FILE}
<tr>
 <td width="20" style="padding: 3px 0px;" valign="top">{$FILE.filename|icon}</td>
 <td style="padding: 5px 2px;" valign="top">
  <a href="{$XT_WEB_ROOT}download.php?file_id={$FILE.id}&download=true">{$FILE.title}</a> ({$FILE.downloads} {if $FILE.downloads == 1}{"Download"|translate}{else}{"Downloads"|translate}{/if})<br />
  <span style="color: #999999;">{$FILE.description}</span>
 </td>
</tr>
{/foreach}
</table>
{foreach from=$ERRORS item=ERROR}
{if $ERROR.severity == 16}
<table cellspacing="0" cellpadding="0" width="100%" class="info">
 <tr>
  <td class="info_msg">{$ERROR.desc}</td>
 </tr>
</table>
{/if}
{if $ERROR.severity == 1}
<table cellspacing="0" cellpadding="0" width="100%" class="error">
 <tr>
  <td class="error_msg">{$ERROR.desc}</td>
 </tr>
</table>
{/if}
{if $ERROR.severity == 4}
<table cellspacing="0" cellpadding="0" width="100%" class="warning">
 <tr>
  <td class="warning_msg">{$ERROR.desc}</td>
 </tr>
</table>
{/if}
{if $ERROR.severity == 2}
<table cellspacing="0" cellpadding="0" width="100%" class="info">
 <tr>
  <td class="info_msg">{$ERROR.desc}</td>
 </tr>
</table>
{/if}
{/foreach}
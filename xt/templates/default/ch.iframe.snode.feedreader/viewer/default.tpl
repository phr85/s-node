
<table cellspacing="0" cellpadding="0" width="100%">
 <tr>
  <td colspan="2">
   <span class="title">{$FEED.title}</title>
  </td>
 </tr>
 <tr>
  <td class="view_separator" colspan="2"><img src="{$XT_IMAGES}spacer.gif" alt="" /></td>
 </tr>
 </table>
<table cellspacing="0" cellpadding="0" width="100%">
{foreach from=$ITEMS item=entry}
 <tr>
  <td class="view_separator"><img src="{$XT_IMAGES}spacer.gif" alt="" height="10" /></td>
 </tr>
  <tr>
  <td>{if $entry.link != ''}<a href="{$entry.link|cleanlink}" target="_blank" title="{$entry.title}">{/if}{$entry.title}{if $entry.link != ''}</a>{/if}</td>
 </tr>
 <tr>
  <td>
  {if $entry.published != ''}{$entry.published|date_format:"%d %b %Y %H:%M:%S"}<br />{/if}
  {$entry.summary}
  </td>
 </tr>
 {/foreach}
</table>
<form method="post" name="edit">
<input type="hidden" name="x{$BASEID}_feed_id" />
<input type="hidden" name="x{$BASEID}_action" />
</form>
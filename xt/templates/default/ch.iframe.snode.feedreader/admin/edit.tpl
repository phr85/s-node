<script language="JavaScript"><!--
window.parent.frames['master'].document.forms[1].submit();
//-->
</script>
<form method="POST" name="edit">
{include file="includes/buttons.tpl" data=$EDIT_BUTTONS}
<table cellspacing="0" cellpadding="0" width="100%">
 <tr>
  <td class="view_header" colspan="2">
   <span class="title_light">{"Feed"|translate}:</span><span class="title">{$FEED.title}</span>
  </td>
 </tr>
 <tr>
  <td class="view_separator" colspan="2"><img src="{$XT_IMAGES}spacer.gif" alt="" /></td>
 </tr>
 <tr>
  <td class="left">{"Title"|translate}&nbsp;</td>
  <td class="right"><input type="text" name="x{$BASEID}_title" value="{$FEED.title}" size="42"></td>
 </tr>
 <tr>
  <td class="left">{"URL"|translate}&nbsp;</td>
  <td class="right"><input type="text" name="x{$BASEID}_url" value="{$FEED.url}" size="42"></td>
 </tr>
 <tr>
  <td class="left">{"Refresh every"|translate}&nbsp;</td>
  <td class="right"><input type="text" name="x{$BASEID}_refresh_interval" value="{$FEED.refresh_interval}" size="42">&nbsp;min.</td>
 </tr>
 <tr>
  <td class="left">{"Entries to keep"|translate}&nbsp;</td>
  <td class="right"><input type="text" name="x{$BASEID}_entries" value="{$FEED.entries}" size="42"></td>
 </tr>
 <tr>
  <td class="left">{"Protocol"|translate}&nbsp;</td>
  <td class="right"><img src="images/icons/feeds/{$FEED.protocol}.gif" />
  </td>
 </tr>
 {if $FEED.last_update > 0}
 <tr>
  <td class="left">{"Last Update"|translate}&nbsp;</td>
  <td class="right">{$FEED.last_update|date_format:"%A, %B %e, %Y %H:%I:%S"}
  </td>
 </tr>
 {/if}
</table>
<input type="hidden" name="x{$BASEID}_feed_id" value="{$FEED.id}" />
</form>
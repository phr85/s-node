<form method="post" action="{$smarty.server.PHP_SELF}?TPL={$TPL}" name="overview">
{include file="includes/buttons.tpl" data=$BUTTONS}
<table cellpadding="0" cellspacing="0" width="100%">
 <tr>
  <td class="table_header" width="10">{"Atm"|translate}</td>
  <td class="table_header">{"Subject"|translate}</td>
  <td class="table_header" width="180">
    {if $FOLDER != 'Sent'}
      {"Sender"|translate}
    {else}
      {"Recipient"|translate}
    {/if}
  </td>
  <td class="table_header" width="120">{"Date"|translate}</td>
  <td class="table_header" width="80">{"Size"|translate}</td>
 </tr>
 {foreach from=$MESSAGES key=MID item=MESSAGE}
 <tr class="{cycle values=row_a,row_b}">
  <td class="row_mail">?</td>
  <td class="row_mail">
  {
  actionLink
      action="viewMessage"
      text=$MESSAGE.subject|truncate:50:"...":true
      message_id=$MESSAGE.id
      form="0"
      target="slave1"
  }&nbsp;</td>
  <td class="row_mail">
    {if $FOLDER != 'Sent'}
      {$MESSAGE.senderaddress}
    {else}
      {$MESSAGE.zuaddress}
    {/if}
  </td>
  <td class="row_mail">{$MESSAGE.date|date_format:"%d.%m.%Y %H:%I"}</td>
  <td class="row_mail">{$MESSAGE.size|format_filesize}</td>
 </tr>
 {/foreach}
</table>
<input type="hidden" name="x{$BASEID}_id" value="">
<input type="hidden" name="x{$BASEID}_position" value="">
<input type="hidden" name="x{$BASEID}_node_id" value="">
<input type="hidden" name="x{$BASEID}_node_pid" value="">
<input type="hidden" name="x{$BASEID}_open" value="">
<input type="hidden" name="x{$BASEID}_source_node_id" value="">
<input type="hidden" name="x{$BASEID}_folder" value="">
{yoffset}
{include file="includes/navigator.tpl" form="overview"}
</form>
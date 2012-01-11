<form method="post" action="{$smarty.server.PHP_SELF}?TPL={$TPL}" name="overview">
{include file="includes/buttons.tpl" data=$BUTTONS}
<table cellpadding="0" cellspacing="0" width="100%">
    <tr>
        <td colspan="2"><h2>{$MAIL.subject}</h2></td>
    </tr>
    <tr>
        <td class="left">
          {if $FOLDER != 'Sent'}
            {"Sender"|translate}:
          {else}
            {"Recipient"|translate}:
          {/if}
        </td>
        <td class="right">
          {if $FOLDER != 'Sent'}
            {$MAIL.senderaddress} &lt;{$MAIL.von}&gt;
          {else}
            {$MAIL.zuaddress} &lt;{$MAIL.zu}&gt;
          {/if}
        </td>
    </tr>
    <tr>
        <td class="left">{"Date"|translate}:</td>
        <td class="right">{$MAIL.date|date_format:"%d.%m.%Y %H:%I"}</td>
    </tr>
    <tr>
        <td class="right" colspan="2">{$MAIL.body}</td>
    </tr>
</table>
<input type="hidden" name="x{$BASEID}_message_id" />
<input type="hidden" name="x{$BASEID}_action" />
</form>
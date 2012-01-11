<ul class="XTMSGbuttonbar">
{if $xt50_comp_messages.mode=="read" || $xt50_comp_messages.mode=="inbox" || $xt50_comp_messages.mode=="inbox_new" || $xt50_comp_messages.mode=="outbox" }
<li><a href="{$smarty.server.PHP_SELF}?TPL={$TPL}&amp;x{$BASEID}_mode=write"><img src="/images/icons/mail_new.png" alt="" /> {"write new message"|translate}</a></li>
<li>{actionIcon action="setMessageAsUnreaded" label="set as unread" icon="mail2.png" form="XTMSGform"}</li>
<li>{actionIcon action="setMessageAsReaded" label="set as readed" icon="mail.png" form="XTMSGform"}</li>
<li>{actionIcon action="deleteMessage" label="delete" icon="mail_delete.png" form="XTMSGform"}</li>
{/if}

{if $xt50_comp_messages.mode=="wastebasket" ||  $xt50_comp_messages.mode=="read_deleted"}
<li>{actionIcon action="deleteMessagePermanent" label="delete premanent" icon="mail_delete.png" form="XTMSGform"}</li>
<li>{actionIcon action="restoreMessage" label="restore message" icon="mail_delete.png" form="XTMSGform"}</li>
{/if}
{if $xt50_comp_messages.mode=="read"}
<li><a href="{$smarty.server.PHP_SELF}?TPL={$TPL}&amp;x{$BASEID}_mode=reply&amp;x{$BASEID}_message_id={$xt50_comp_messages.message.id}"><img src="/images/icons/mail_forward.png" alt="" /> {"reply"|translate}</a></li>
<li><a href="{$smarty.server.PHP_SELF}?TPL={$TPL}&amp;x{$BASEID}_mode={$xt50_comp_messages.return_to_mode}&amp;x{$BASEID}_message_id={$xt50_comp_messages.message.id}"><img src="/images/icons/cancel.png" alt="" /> {"close"|translate}</a></li>
{/if}

{if $xt50_comp_messages.mode=="reply"}
<li><a href="{$smarty.server.PHP_SELF}?TPL={$TPL}&amp;x{$BASEID}_mode=read&amp;x{$BASEID}_message_id={$xt50_comp_messages.message.id}"><img src="/images/icons/cancel.png" alt="" /> {"cancel"|translate}</a></li>
<li>{actionIcon action="replyMessage" label="send" icon="mail_preferences.png" form="XTMSGform"}</li>
{/if}

{if $xt50_comp_messages.mode=="write"}
<li><a href="{$smarty.server.PHP_SELF}?TPL={$TPL}&amp;x{$BASEID}_mode={$xt50_comp_messages.return_to_mode}&amp;x{$BASEID}_message_id={$xt50_comp_messages.message.id}"><img src="/images/icons/cancel.png" alt="" /> {"cancel"|translate}</a></li>
<li>{actionIcon action="writeMessage" label="send" icon="mail_preferences.png" form="XTMSGform"}</li>
{/if}
</ul>
<form method="POST" name="messages">
 {include file="includes/buttons.tpl" data=$OVERVIEW_BUTTONS form="messages"}
 <table cellpadding="0" cellspacing="0" width="100%">
  <tr>
   <td class="table_header" width="50">&nbsp;</td>
   <td class="table_header" width="20">{"Prio."|translate}</td>
   <td class="table_header">{"Subject"|translate}</td>
   <td class="table_header" width="80">{"Sender"|translate}</td>
  </tr>
  {foreach from=$DATA item=MAIL}
  <tr {if $MAIL.read_date == 0}class="row_red"{else}class="{cycle values="row_a,row_b"}"{/if}>
   <td class="button">{
   actionIcon
       action="readMessage"
       perm="read"
       icon="view.png"
       title="Read this message"
       target="slave1"
       id=$MAIL.id
       form="0"
   }{
   actionIcon
       action="deleteMessage"
       perm="delete"
       icon="delete.png"
       title="Read this message"
       id=$MAIL.id
       ask="Are you sure, that you want to delete this message?"
       form="messages"
   }</td>
   <td class="button">{if $MAIL.priority == 2}<img src="{$XT_IMAGES}icons/pin_red.png" alt="" />{else}{if $MAIL.priority == 0}<img src="{$XT_IMAGES}icons/pin_green.png" alt="" />{/if}{/if}<img src="{$XT_IMAGES}spacer.gif" alt="" /></td>
   <td class="row">{if $MAIL.read_date == 0}<b>{
   actionLink
       action="readMessage"
       perm="read"
       title="Read this message"
       target="slave1"
       id=$MAIL.id
       form="0"
       text=$MAIL.subject
   }</b>{else}{
   actionLink
       action="readMessage"
       perm="read"
       title="Read this message"
       target="slave1"
       id=$MAIL.id
       form="0"
       text=$MAIL.subject
   }{/if}</td>
   <td class="row">{$MAIL.username}</td>
  </tr>
  {/foreach}
 </table>
 {include file="includes/navigator.tpl" form="messages"}
 <input type="hidden" name="x{$BASEID}_id" value="">
</form>
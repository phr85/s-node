<form method="POST" name="messages">
 {include file="includes/buttons.tpl" data=$BUTTONS form="messages"}
 <table cellpadding="0" cellspacing="0" width="100%">
  <tr>
   <td class="table_header" width="20">{"Opt."|translate}</td>
   <td class="table_header">{"Subject"|translate}</td>
   <td class="table_header" width="80">{"Receiver"|translate}</td>
   <td class="table_header" width="100">{"Last read at"|translate}</td>
  </tr>
  {foreach from=$DATA item=MAIL}
  <tr class="{cycle values="row_a,row_b"}">
   <td class="button">{
   actionIcon
       action="readMessage"
       perm="read"
       icon="view.png"
       title="Read this message" 
       id=$MAIL.id
       form="messages"
   }</td>
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
   }{/if}</a></td>
   <td class="row">{$MAIL.username}</td>
   <td class="row">{if $MAIL.read_date == 0}<span style="color: red;"><b>{"Not read yet"|translate}</b></span>{else}{$MAIL.read_date|date_format:"%d.%m.%Y %H:%M"}{/if}</td>
  </tr>
  {/foreach}
 </table>
 <input type="hidden" name="x{$BASEID}_id" value="">
 <input type="hidden" name="x{$BASEID}_module" value="sm">
</form>
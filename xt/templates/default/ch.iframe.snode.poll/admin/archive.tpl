<form method="POST" name="poll">
 {include file="includes/buttons.tpl" data=$BUTTONS}
 {include file="includes/lang_selector_simple.tpl" form="article"}
 <table cellspacing="0" cellpadding="0" width="100%">
  <tr>
   <td class="table_header" width="80">&nbsp;</td>
   <td class="table_header" width="40">{actionIcon action="NULL" label="ID" form=poll sort=$sort.0.value icon=$sort.0.icon}</td>
   <td class="table_header">{actionIcon action="NULL" form=poll label="Title" sort=$sort.1.value icon=$sort.1.icon}</td>
  </tr>
  {foreach from=$DATA item=POLL name=POLLTABLE}
  <tr class="{cycle values="row_a,row_b"}" {if $POLL.locked_user == $USER_ID}style="background-image: url({$XT_IMAGES}admin/gfx/naventry_active.gif);"{/if}>
   <td class="button">{if $POLL.locked != 1 || $POLL.locked_user == $USER_ID}{if $POLL.active
   }{actionIcon 
        action="deactivatePoll"
        icon="active.png"
        form="poll"
        perm="statuschange"
        id=$POLL.id
        title="Deactivate this poll"
   }{else
   }{actionIcon 
        action="activatePoll"
        icon="inactive.png"
        form="poll"
        perm="statuschange"
        id=$POLL.id
        title="Activate this poll"
   }{/if
   }{actionIcon 
        action="editPoll"
        icon="pencil.png"
        form="0"
        target="slave1"
        id=$POLL.id
        perm="edit"
        title="Edit this poll"
   }{actionIcon 
        action="deletePoll"
        icon="delete.png"
        form="poll"
        id=$POLL.id
        perm="delete"
        title="Delete this poll"
        ask="Are you sure you want to delete this poll?"
   }{else}{"In edit"|translate}{/if}</td>
   <td class="row">{$POLL.id}</td>
   <td class="row">{
   actionLink
       action="editPoll"
       form="0"
       target="slave1"
       perm="view"
       id=$POLL.id
       text=$POLL.title|truncate:40:"...":true
   }&nbsp;</td>
  </tr>
  {/foreach}
 </table>
 <input type="hidden" name="poll" value="">
 {include file="includes/navigator.tpl" form="poll"}
 <input type="hidden" name="x{$BASEID}_id" value="">
 <input type="hidden" name="x{$BASEID}_sort" value="" />
 <input type="hidden" name="module" value="archive">
</form>
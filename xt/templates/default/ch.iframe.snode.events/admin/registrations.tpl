{literal}
<script type="text/javascript"><!--
if(window.parent.frames['master']){
    window.parent.frames['master'].document.forms[0].submit();
}
//-->
</script>
{/literal}
<h2><span class="light">{"Registrations"|translate}:</span> {$EVENT.title}</h2>
{include file="includes/buttons.tpl" data=$REGISTRATION_BUTTONS}

<form method="post" name="ro" action="{$smarty.server.PHP_SELF}?TPL={$TPL}">
    <table cellspacing="0" cellpadding="0" width="100%">
     <tr>
      <td class="table_header" width="40">&nbsp;</td>
      <td class="table_header" width="150">{"Firstname"|translate}</td>
      <td class="table_header" width="150">{"Lastname"|translate}</td>
      <td class="table_header">{"City"|translate}</td>
     </tr>
    {foreach from=$REGISTRATIONS item=REGISTRATION}
     <tr class="{cycle values="row_a,row_b"}">
      <td class="button" width="40" align="right">{actionIcon
            action="editRegistration"
            icon="pencil.png"
            form="ro"
            target="slave1"
            id=$REGISTRATION.id
            perm="edit"
            title="Edit this registration"
       }{actionIcon
            action="deleteRegistration"
            icon="delete.png"
            form="ro"
            id=$REGISTRATION.id
            perm="edit"
            title="Delete this event entry"
            ask="Are you sure you want to delete this registration?"
       }</td>
       <td class="row">{$REGISTRATION.firstName}</td>
       <td class="row">{$REGISTRATION.lastName}</td>
       <td class="row">{$REGISTRATION.city}</td>
     </tr>
     {/foreach}
    </table>
<input type="hidden" name="x{$BASEID}_action" value="" />
{include file="ch.iframe.snode.events/admin/hiddenValues.tpl"}
</form>
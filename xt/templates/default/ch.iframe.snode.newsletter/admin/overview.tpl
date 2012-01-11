<form method="post" action="{$smarty.server.PHP_SELF}?TPL={$TPL}" name="overview">
{include file="includes/buttons.tpl" data=$BUTTONS}
<table cellspacing="0" cellpadding="0" width="100%">
 <tr>
  <td class="table_header" width="100">&nbsp;</td>
  <td class="table_header" colspan="2">{"Title"|translate}</td>
    <td class="table_header" width="40">{"Language"|translate}</td>
  <td class="table_header" width="40">{"Status"|translate}</td>
  {if "batched_mode"|getConfigValue == true}
   <td class="table_header" width="40">{"Waiting"|translate}</td>
   <td class="table_header" width="40">{"Sent"|translate}</td>
   <td class="table_header" width="40">{"Views"|translate}</td>
  {/if}
 </tr>
 {foreach from=$NEWSLETTERS item=NEWSLETTER}
 <tr>
  <td class="button">{
  actionIcon
      action="editNewsletter"
      icon="pencil.png"
      title="Edit newsletter"
      newsletter_id=$NEWSLETTER.id
      target="slave1"
      form="0"
  }
  {
  actionIcon
      action="deleteNewsletter"
      icon="delete.png"
      title="Delete newsletter"
      form="overview"
      newsletter_id=$NEWSLETTER.id
      ask="Are you sure you want to delete this newsletter?"
  }
  {if "batched_mode"|getConfigValue == true}
  {actionIcon
      action="emptyQueue"
      icon="warning.png"
      title="Empty queue"
      form="overview"
      newsletter_id=$NEWSLETTER.id
      ask="Are you sure you want to empty the queue for this newsletter?"
  }
  {/if}{
  actionIcon
      action="duplicateNewsletter"
      icon="copy.png"
      title="Duplicate newsletter"
      newsletter_id=$NEWSLETTER.id
      form="overview"
  }
  </td>
  <td class="button" width="16"><img src="{$XT_IMAGES}icons/mail2.png" alt="" /></td>
  <td class="row" style="padding-left: 0px;">{actionLink
      action="editNewsletter"
      title="Edit newsletter"
      newsletter_id=$NEWSLETTER.id
      target="slave1"
      form="0"
      text=$NEWSLETTER.title|default:"untitled"
  }</td>
  <td class="row">{$NEWSLETTER.lang|translate}</td>
  <td class="row">{$NEWSLETTER.status}</td>
  {if "batched_mode"|getConfigValue == true}
   <td class="row">{$NEWSLETTER.waiting|default:"0"}</td>
   <td class="row">{$NEWSLETTER.sent|default:"0"}</td>
   <td class="row">{$NEWSLETTER.views|default:"0"} {if $NEWSLETTER.views != 0 && $NEWSLETTER.sent != 0}({math equation="(x / y)*100" x=$NEWSLETTER.views y=$NEWSLETTER.sent format="%.2f"} %){/if}</td>
  {/if}
 </tr>
 {/foreach}
</table>


{include file="ch.iframe.snode.newsletter/admin/hiddenValues.tpl"}
</form>

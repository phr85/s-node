<form method="POST" name="view">
<table cellspacing="0" cellpadding="0" width="100%">
 <tr>
  <td class="view_header">
   <span class="title">{$PROJECT.title}</span><br />
  </td>
 </tr>
 <tr>
  <td class="view_separator" colspan="4"><img src="{$XT_IMAGES}spacer.gif" alt="" /></td>
 </tr>
</table>
<table cellspacing="0" cellpadding="0" width="100%">
 <tr>
  <td class="view_header" colspan="4">
   <span class="subline">{if $PROJECT.description != ''}{$PROJECT.description}{else}{"No description"|translate}{/if}</span>
  </td>
 </tr>
 <tr>
  <td class="view_separator" colspan="4"><img src="{$XT_IMAGES}spacer.gif" alt="" /></td>
 </tr>
 <tr>
  <td class="view_left">{"Customer"|translate}:</td>
  <td class="view_right">{$CUSTOMER.title}</td>
 </tr>
 {if $CUSTOMER_PERSON.lastName != ''}
 <tr>
  <td class="view_left">{"Customer contact person"|translate}:</td>
  <td class="view_right"><img src="{$XT_IMAGES}icons/user_small.png" alt="" />&nbsp;&nbsp;{$CUSTOMER_PERSON.lastName}, {$CUSTOMER_PERSON.firstName}</td>
 </tr>
 {/if}
 {if $PROJECT.budget_end > 0}
 <tr>
  <td class="view_left">{"Bugdet range"|translate}:</td>
  <td class="view_right">{$PROJECT.budget_start} CHF - {$PROJECT.budget_end} CHF</td>
 </tr>
 {/if}
 <tr>
  <td class="view_left">{"Start"|translate}:</td>
  <td class="view_right">{$PROJECT.start_date|date_format:"%d.%m.%Y %H:%I"}</td>
 </tr>
 <tr>
  <td class="view_left">{"Deadline"|translate}:</td>
  <td class="view_right">{$PROJECT.end_date|date_format:"%d.%m.%Y %H:%I"}</td>
 </tr>
 <tr>
  <td colspan="4">{include file="includes/buttons.tpl" data=$VIEW_BUTTONS}</td>
 </tr>
 {foreach from=$RELATIONS item=RELATION}
 <tr>
  <td class="view_left" style="padding-bottom: 3px; padding-right: 0px;">
   <table cellspacing="0" cellpadding="0" width="100%">
    <tr>
     <td style="width: 16px; padding-right: 5px;"><img src="{$XT_IMAGES}icons/{$RELATION.icon}" alt="" /></td>
     <td style="color: #999999;">{$RELATION.content_type_title|translate}</td>
    </tr>
   </table>
  </td>
  <td class="view_right">{$RELATION.title}</td>
  <td class="button" align="right">{
  actionIcon
        action="deleteRelation"
        icon="delete.png"
        form="view"
        project_id=$PROJECT.id
        before_content_id=$RELATION.target_content_id
        before_content_type=$RELATION.target_content_type
        title="Delete this relation"
        ask="Are you sure you want to delete this relation?"
  }</td>
 </tr>
 {/foreach}
</table>
<input type="hidden" name="x{$BASEID}_project_id" value="{$PROJECT.id}" />
<input type="hidden" name="x{$BASEID}_before_content_id" />
<input type="hidden" name="x{$BASEID}_before_content_type" />
</form>

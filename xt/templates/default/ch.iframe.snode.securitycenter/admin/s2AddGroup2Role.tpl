<form method="POST" name="groups">
{include file="ch.iframe.snode.securitycenter/admin/hiddenValues.tpl"}
<table cellspacing="0" cellpadding="0" width="100%">
 <tr>
  <td class="view_header">
   <span class="title">{"Add groups to role"|translate}</span>
  </td>
 </tr>
<tr>
  <td class="view_separator" colspan="2"><img src="{$XT_IMAGES}spacer.gif" alt="" /></td>
 </tr>
 </table>
{include file="includes/charfilter.tpl" form="groups"}
 <table cellspacing="0" cellpadding="0" width="100%">
  <tr>
   <td class="table_header" width="30">&nbsp;</td>
   <td class="table_header" width="32">ID</td>
   <td class="table_header" width="120">{"Title"|translate}</td>
   <td class="table_header">{"Description"|translate}</td>
  </tr>
  {foreach from=$DATA item=GROUP}
      <tr class="{cycle values="row_a,row_b"}">
       <td class="button">
       {if $GROUP.checked}{actionIcon
                action="removeGroupFromRole"
                icon="explorer/arrow_right_red.png"
                form="groups"
                perm="groups"
                group_id=$GROUP.id
                role_id =$principal_id
                title="Remove from role"
      }{else}{actionIcon
                action="insertGroup2Role"
                icon="explorer/arrow_left_green.png"
                form="groups"
                perm="groups"
                group_id=$GROUP.id
                role_id =$principal_id
                title="Add to role"
      }{/if}

       </td>
       <td class="row">{$GROUP.id}&nbsp;</td>
       <td class="row">{$GROUP.title}&nbsp;</td>
       <td class="row">{$GROUP.description}&nbsp;</td>
      </tr>
  {/foreach}
 </table>
 {include file="includes/navigator.tpl" form="groups"}
</form>
<form method="POST" name="users">
{include file="ch.iframe.snode.securitycenter/admin/hiddenValues.tpl"}
<table cellspacing="0" cellpadding="0" width="100%">
 <tr>
  <td class="view_header">
   <span class="title">{"Add users to pool"|translate}</span>
  </td>
 </tr>
<tr>
  <td class="view_separator" colspan="2"><img src="{$XT_IMAGES}spacer.gif" alt="" /></td>
 </tr>
 </table>
{include file="includes/charfilter.tpl" form="users"}
 <table cellspacing="0" cellpadding="0" width="100%">
  <tr>
   <td class="table_header" width="30">&nbsp;</td>
   <td class="table_header" width="32">ID</td>
   <td class="table_header" width="120">{"username"|translate}</td>
   <td class="table_header">{"Description"|translate}</td>
  </tr>
  {foreach from=$DATA item=USER}
      <tr class="{cycle values="row_a,row_b"}">
       <td class="button">
       {if $USER.principal_type}{actionIcon
                action="removeUserFromPool"
                icon="explorer/arrow_right_red.png"
                form="users"
                perm="user"
                principal_id=$USER.id
                title="Remove from pool"
      }{else}{actionIcon
                action="insertUser2Pool"
                icon="explorer/arrow_left_green.png"
                form="users"
                perm="user"
                principal_id=$USER.id
                title="Add to pool"
      }{/if}

       </td>
       <td class="row">{$USER.id}&nbsp;</td>
       <td class="row">{$USER.username}&nbsp;</td>
       <td class="row">{$USER.firstName}&nbsp;{$USER.lastName}</td>
      </tr>
  {/foreach}
 </table>
 {include file="includes/navigator.tpl" form="users"}
</form>
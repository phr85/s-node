<form method="POST" name="roletable">
{include file="ch.iframe.snode.securitycenter/admin/hiddenValues.tpl"}
<table cellspacing="0" cellpadding="0" width="100%">
 <tr>
  <td class="view_header">
   <span class="title">{"Add roles to pool"|translate}</span>
  </td>
 </tr>
<tr>
  <td class="view_separator" colspan="2"><img src="{$XT_IMAGES}spacer.gif" alt="" /></td>
 </tr>
 </table>
  {include file="includes/charfilter.tpl" form="roletable"}
 <table cellspacing="0" cellpadding="0" width="100%">
  <tr>
   <td class="table_header" width="30">&nbsp;</td>
   <td class="table_header" width="32">ID</td>
   <td class="table_header" width="120">{"Title"|translate}</td>
   <td class="table_header">{"Description"|translate}</td>
  </tr>
  {foreach from=$DATA item=ROLE name=ROLESTABLE}
      <tr class="{cycle values="row_a,row_b"}">
       <td class="button">
       {if $ROLE.principal_type}{actionIcon
                action="removeRoleFromPool"
                icon="explorer/arrow_right_red.png"
                form="roletable"
                perm="roles"
                principal_id=$ROLE.id
                title="Remove from pool"
      }{else}{actionIcon
                action="insertRole2Pool"
                icon="explorer/arrow_left_green.png"
                form="roletable"
                perm="roles"
                principal_id=$ROLE.id
                title="Add to pool"
      }{/if}

       </td>
       <td class="row">{$ROLE.id}&nbsp;</td>
       <td class="row">{$ROLE.title}&nbsp;</td>
       <td class="row">{$ROLE.description}&nbsp;</td>
      </tr>
  {/foreach}
 </table>
 {include file="includes/navigator.tpl" form="roletable"}
</form>
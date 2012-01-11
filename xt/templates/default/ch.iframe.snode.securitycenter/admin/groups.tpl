<form method="POST" name="groups">
{include file="ch.iframe.snode.securitycenter/admin/hiddenValues.tpl"}
<table cellspacing="0" cellpadding="0" width="100%">
 <tr>
  <td class="view_header">
   <span class="title">{"Add groups to pool"|translate}</span>
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
       {if $GROUP.principal_type}{actionIcon
                action="removeGroupFromPool"
                icon="explorer/arrow_right_red.png"
                form="groups"
                perm="groups"
                principal_id=$GROUP.id
                title="Remove from pool"
      }{else}{actionIcon
                action="insertGroup2Pool"
                icon="explorer/arrow_left_green.png"
                form="groups"
                perm="groups"
                principal_id=$GROUP.id
                title="Add to pool"
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
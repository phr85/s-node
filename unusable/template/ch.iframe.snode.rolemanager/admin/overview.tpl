<form method="POST" name="roletable">
 {include file="includes/buttons.tpl" data=$BUTTONS}
 {include file="includes/charfilter.tpl" form="roletable"}
 <table cellspacing="0" cellpadding="0" width="100%">
  <tr>
   <td class="table_header" width="80">{"Options"|translate}</td>
   <td class="table_header" width="32">ID</td>
   <td class="table_header" width="100">{"Title"|translate}</td>
   <td class="table_header" width="100">{"Description"|translate}</td>
   <td class="table_header">&nbsp;</td>
  </tr>
  {foreach from=$DATA item=ROLE name=ROLESTABLE}
      <tr class="{cycle values="row_a,row_b"}">
       <td class="button">
       {if "statuschange"|allowed}{if $ROLE.active == 1}<a href="index.php?TPL={$TPL}&x{$BASEID}_action=deactivate&x{$BASEID}_id={$ROLE.id}"><img src="images/icons/active.gif" style="padding-right: 4px;" alt="{'Deactivate this role'|translate}" title="{'Deactivate this role'|translate}"></a>{else}<a href="index.php?TPL={$TPL}&x{$BASEID}_action=activate&x{$BASEID}_id={$ROLE.id}"><img src="images/icons/inactive.gif" style="padding-right: 4px;" alt="{'Activate this role'|translate}" title="{'Activate this role'|translate}"></a>{/if}{else}{$ICONSPACER}{/if}{if "view"|allowed}<a href="index.php?TPL={$TPL}&x{$BASEID}_action=view&x{$BASEID}_id={$ROLE.id}"><img src="images/icons/view.gif" style="padding-right: 4px;" alt="{'View information about this role'|translate}" title="{'View information about this role'|translate}"></a>{else}{$ICONSPACER}{/if}{if "edit"|allowed}<a href="index.php?TPL={$TPL}&x{$BASEID}_action=editRole&x{$BASEID}_id={$ROLE.id}"><img src="images/icons/pencil.png" alt="{'Edit this role'|translate}" title="{'Edit this role'|translate}" style="padding-right: 4px;"></a>{else}{$ICONSPACER}{/if}{if "delete"|allowed}<a href="javascript:ask('{'Are you sure to delete this role?'|translate}','index.php?TPL={$TPL}&x{$BASEID}_action=deleteRole&x{$BASEID}_id={$ROLE.id}');"><img src="images/icons/delete.png" alt="{'Delete this role'|translate}" title="{'Delete this role'|translate}"></a>{else}{$ICONSPACER}{/if}<br>
       </td>
       <td class="row">{$ROLE.id}&nbsp;</td>
       <td class="row">{$ROLE.title}&nbsp;</td>
       <td class="row">{$ROLE.description}&nbsp;</td>
       <td class="row">&nbsp;</td>
      </tr>
  {/foreach}
 </table>
 <br>
 {include file="includes/navigator.tpl" form="roletable"}
</form>
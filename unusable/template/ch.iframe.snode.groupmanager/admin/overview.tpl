<form method="POST" name="grouptable">
 {include file="includes/buttons.tpl" data=$BUTTONS}
 {include file="includes/charfilter.tpl" form="grouptable"}
 <table cellspacing="0" cellpadding="0" width="100%">
  <tr>
   <td class="table_header" width="80">{"Options"|translate}</td>
   <td class="table_header" width="32">ID</td>
   <td class="table_header" width="100">{"Title"|translate}</td>
   <td class="table_header" width="100">{"Description"|translate}</td>
   <td class="table_header">&nbsp;</td>
  </tr>
  {foreach from=$DATA item=GROUP name=GROUPSTABLE}
      <tr class="{cycle values="row_a,row_b"}">
       <td class="button">
       {if "statuschange"|allowed}{if $GROUP.active == 1}<a href="index.php?TPL={$TPL}&x{$BASEID}_action=deactivate&x{$BASEID}_id={$GROUP.id}"><img src="images/icons/active.gif" style="padding-right: 4px;" alt="{'Deactivate this group'|translate}" title="{'Deactivate this group'|translate}"></a>{else}<a href="index.php?TPL={$TPL}&x{$BASEID}_action=activate&x{$BASEID}_id={$GROUP.id}"><img src="images/icons/inactive.gif" style="padding-right: 4px;" alt="{'Activate this group'|translate}" title="{'Activate this group'|translate}"></a>{/if}{else}{$ICONSPACER}{/if}{if "view"|allowed}<a href="index.php?TPL={$TPL}&x{$BASEID}_action=view&x{$BASEID}_id={$GROUP.id}"><img src="images/icons/view.gif" style="padding-right: 4px;" alt="{'View information about this group'|translate}" title="{'View information about this group'|translate}"></a>{else}{$ICONSPACER}{/if}{if "edit"|allowed}<a href="index.php?TPL={$TPL}&x{$BASEID}_action=editGroup&x{$BASEID}_id={$GROUP.id}"><img src="images/icons/pencil.png" alt="{'Edit this group'|translate}" title="{'Edit this group'|translate}" style="padding-right: 4px;"></a>{else}{$ICONSPACER}{/if}{if "delete"|allowed}<a href="javascript:ask('{'Are you sure to delete this group?'|translate}','index.php?TPL={$TPL}&x{$BASEID}_action=deleteGroup&x{$BASEID}_id={$GROUP.id}');"><img src="images/icons/delete.png" alt="{'Delete this group'|translate}" title="{'Delete this group'|translate}"></a>{else}{$ICONSPACER}{/if}<br>
       </td>
       <td class="row">{$GROUP.id}&nbsp;</td>
       <td class="row">{$GROUP.title}&nbsp;</td>
       <td class="row">{$GROUP.description}&nbsp;</td>
       <td class="row">&nbsp;</td>
      </tr>
  {/foreach}
 </table>
 <br>
 {include file="includes/navigator.tpl" form="grouptable"}
</form>
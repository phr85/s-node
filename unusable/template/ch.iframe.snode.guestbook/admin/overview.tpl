<form method="POST" name="guestbook">
 {include file="includes/buttons.tpl" data=$BUTTONS}
 <table cellspacing="0" cellpadding="0" width="100%">
  <tr>
   <td class="table_header" width="80">{"Options"|translate}</td>
   <td class="table_header" width="250">{"Comment"|translate}</td>
   <td class="table_header" width="100">{"IP"|translate}</td>
   <td class="table_header" width="80">{"Adv. Options"|translate}</td>
   <td class="table_header" width="*">{"Date"|translate}</td>
  </tr>
  {foreach from=$DATA item=ENTRY name=ENTRYTABLE}
  <tr class="{cycle values="row_a,row_b"}">
   <td class="button">
   {if "statuschange"|allowed}{if $ENTRY.active == 1}<a href="index.php?TPL={$TPL}&amp;x{$BASEID}_action=deactivateEntry&amp;x{$BASEID}_id={$ENTRY.id}"><img src="images/icons/active.png" alt="{'Status'|translate}" title="{'Activate/Deactivate this entry'|translate}" style="padding-right: 4px;"></a>{else}<a href="index.php?TPL={$TPL}&amp;x{$BASEID}_action=activateEntry&amp;x{$BASEID}_id={$ENTRY.id}"><img src="images/icons/inactive.png" style="padding-right: 4px;"></a>{/if}{else}{$ICONSPACER}{/if}{if "view"|allowed}<a href="index.php?TPL={$TPL}&amp;x{$BASEID}_action=previewEntry&amp;x{$BASEID}_id={$ENTRY.id}"><img src="images/icons/view.png" alt="{'Preview'|translate}" title="{'Preview this entry'|translate}" style="padding-right: 4px;"></a>{else}{$ICONSPACER}{/if}{if "edit"|allowed}<a href="index.php?TPL={$TPL}&amp;x{$BASEID}_action=editEntry&amp;x{$BASEID}_id={$ENTRY.id}"><img src="images/icons/pencil.png" alt="{'Edit'|translate}" title="{'Edit this ENTRY'|translate}" style="padding-right: 4px;"></a>{else}{$ICONSPACER}{/if}{if "delete"|allowed}<a href="javascript:ask('Are you sure you want to delete this entry ?','{$smarty.server.PHP_SELF}?TPL={$TPL}&amp;x{$BASEID}_action=deleteEntry&amp;x{$BASEID}_id={$ENTRY.id}');"><img src="images/icons/delete.png" alt="{'Delete'|translate}" title="{'Delete this ENTRY'|translate}" ></a>{else}{$ICONSPACER}{/if}<br>
   </td>
   <td class="row">{$ENTRY.comment|truncate:40:"...":true}</td>
   <td class="row">{$ENTRY.ip}</td>
   <td class="button">{if "ipblocking"|allowed}{if $IPBLOCKING == 1}{if $ENTRY.blockip == 0}<a href="index.php?TPL={$TPL}&amp;x{$BASEID}_action=deactivateIp&amp;x{$BASEID}_id={$ENTRY.id}&amp;x{$BASEID}_ip={$ENTRY.ip}"><img src="images/icons/check.png" alt="{'blockip'|translate}" title="{'Block this ip'|translate}" style="padding-right: 4px;"></a>{else}<a href="index.php?TPL={$TPL}&amp;x{$BASEID}_action=activateIp&amp;x{$BASEID}_id={$ENTRY.id}&amp;x{$BASEID}_ip={$ENTRY.ip}"><img src="images/icons/forbidden.png"  alt="{'blockip'|translate}" title="{'Get ip free'|translate}" style="padding-right: 4px;"></a>{/if}{else}&nbsp;{/if}{else}{$ICONSPACER}{/if}</td>
   <td class="row">
   {if $ENTRY.creation_date > 0}
        {$ENTRY.creation_date|date_format:"%d.%m.%Y %H:%M:%S"}
   {/if}
   </td>
  </tr>
  {/foreach}
 </table>
 {include file="includes/navigator.tpl" form="guestbook"}
</form>
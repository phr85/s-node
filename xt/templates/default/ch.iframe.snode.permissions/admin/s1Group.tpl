<form method="POST" name="slave1">
{include file="ch.iframe.snode.nodepermissions/admin/hiddenValues.tpl"}
{include file="includes/buttons.tpl" data=$BUTTONS withouthidden=1}
{if $NOTSET}
<table cellspacing="0" cellpadding="0" width="100%">
 <tr>
  <td class="view_header_small" colspan="2">
   <span class="title">{"No Permissions setted"|translate}</span><br />
   <span class="subline">{"Permissions will be inherited from parent element"|translate}</span>
  </td>
 </tr>
</table>
{/if}
{include file="includes/lang_selector_submit.tpl" form="slave1" action="s1SaveGroupPermission"}
<table cellspacing="0" cellpadding="0" width="100%">
{foreach from=$PERMS key=KEY item=PERM}
<tr class="{cycle values="row_a,row_b"}">
 <td class="row" style="width: 12px; padding-right: 0px;">{if $PERM.rights}<input type="hidden" name="x{$BASEID}_perms[{$KEY}]" value="1"><img style="cursor: hand; cursor: pointer;" onclick="switchPerm(this, 'x{$BASEID}_perms[{$KEY}]');" src="{$XT_IMAGES}icons/check_small.png" alt="" />{else}<input type="hidden" name="x{$BASEID}_perms[{$KEY}]" value="0"><img style="cursor: hand; cursor: pointer;" onclick="switchPerm(this, 'x{$BASEID}_perms[{$KEY}]');" src="{$XT_IMAGES}icons/forbidden_small.png" alt="" />{/if}</td>
 <td class="row">{if $PERM.rights}<span style="color: green;">{$PERM.perm}</span>{else}<span style="color: red;">{$PERM.perm}</span>{/if}</td>
</tr>
{/foreach}
</table>
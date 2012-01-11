<form method="POST" name="master">
{include file="ch.iframe.snode.nodepermissions/admin/hiddenValues.tpl"}

<table cellspacing="0" cellpadding="0" width="100%">
<tr style="cursor: hand; cursor: pointer;">
 <td class="lang_tab" width="20">{actionIcon
        action="switch2UserMode"
        icon="user1.png"
        form="master"
        title="Users"}
 </td>
 <td class="lang_tab_active" width="20">{actionIcon
        action="switch2GroupMode"
        icon="group.png"
        form="master"
        title="Groups"}
 </td>
 <td class="lang_tab" width="20">{actionIcon
        action="switch2RoleMode"
        icon="worker.png"
        form="master"
        title="Roles"}
 </td>
<td class="lang_tab">{"Groupmode"|translate}</td>
</table>
<table cellspacing="0" cellpadding="0" width="100%">

<tr class="{cycle values="row_a,row_b"}">
 <td style="padding: 5px; border-bottom: 2px solid #ACB7C4;" colspan="2"><input type="text" name="x{$BASEID}_filter" value="{$ACTIVE_FILTER}"> <input type="submit" value="{"Search"|translate}" class="button"></td>
</tr>
{foreach from=$DATA item=ITEM}
<tr class="{cycle values="row_a,row_b"}">
<td class="row" style="padding-left: 5px; width: 1px;padding-right: 0px;"><img src="{$XT_IMAGES}icons/group.png" width="16" /></td>
      <td class="row">{if $ITEM.id == $GROUP_ID}{actionLink
      action= "clickOnGroup"
      form="master"
      yoffset=1
      text=$ITEM.title
      title= $ITEM.id
      group_id=$ITEM.id
      style="font-weight:bold;"
      }{else}{actionLink
      action= "clickOnGroup"
      form="master"
      yoffset=1
      text=$ITEM.title
      title= $ITEM.id
      group_id=$ITEM.id
      }{/if}
      </td>
</tr>
{/foreach}
</table>
{include file="includes/navigator.tpl" form="master"}
</form>
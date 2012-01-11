{literal}
<script type="text/javascript">
window.opener.location.href=window.opener.location;
</script>
{/literal}
<form method="POST" name="node_perms">
<table cellspacing="0" cellpadding="0" width="100%">
 <tr>
  <td class="admin_title" colspan="2">{"Edit node permissions"|translate}</td>
 </tr>
 <tr>
  <td class="table_header" colspan="2">{"Node"|translate}: {$NODE_ID}</td>
 </tr>
</table>
<table cellspacing="0" cellpadding="0" width="100%">
 <tr>
  <td style="padding: 10px; padding-right: 0px;" width="50%" valign="top">
   <table cellspacing="0" cellpadding="0">
    <tr style="cursor: hand; cursor: pointer;">
     <td onclick="document.forms['node_perms'].x{$BASEID}_mode.value='user';document.forms['node_perms'].submit()" class="lang_tab{if $ACTIVE_MODE == 'user'}_active{/if}"><img src="{$XT_IMAGES}icons/user1.png" alt="{'Users'|translate}" title="{'Users'|translate}" /></td>
     <td onclick="document.forms['node_perms'].x{$BASEID}_mode.value='group';document.forms['node_perms'].submit()" class="lang_tab{if $ACTIVE_MODE == 'group'}_active{/if}"><img src="{$XT_IMAGES}icons/group.png" alt="{'Groups'|translate}" title="{'Groups'|translate}" /></td>
     <td onclick="document.forms['node_perms'].x{$BASEID}_mode.value='role';document.forms['node_perms'].submit()" class="lang_tab{if $ACTIVE_MODE == 'role'}_active{/if}"><img src="{$XT_IMAGES}icons/worker.png" alt="{'Roles'|translate}" title="{'Roles'|translate}" /></td>
    </tr>
   </table>
   <table cellspacing="0" cellpadding="0" width="100%">
    <tr>
     <td class="table_header" colspan="2">{"Search for a"|translate} {$ACTIVE_MODE|translate}</td>
    </tr>
    <tr class="{cycle values="row_a,row_b"}">
     <td style="padding: 5px; border-bottom: 2px solid #ACB7C4;" colspan="2"><input type="text" name="x{$BASEID}_filter" value="{$ACTIVE_FILTER}"> <input type="submit" value="{"Search"|translate}" class="button"></td>
    </tr>
    {foreach from=$PRINCIPALS item=PRINCIPAL}
    <tr class="{cycle values="row_a,row_b"}">
     <td class="row{if $ACTIVE_PRINCIPAL == $PRINCIPAL.id}_active{/if}" style="width: 16px; padding: 4px; padding-right: 0px;"><img src="{$XT_IMAGES}icons/{$ACTIVE_MODE}.png" alt="" /></td>
     <td class="row{if $ACTIVE_PRINCIPAL == $PRINCIPAL.id}_active{/if}"><a href="javascript:document.forms['node_perms'].x{$BASEID}_{$ACTIVE_MODE}_id.value={$PRINCIPAL.id};document.forms['node_perms'].submit();">{$PRINCIPAL.title}</a></td>
    </tr>
    {/foreach}
   </table>
   {include file="includes/navigator.tpl" form="node_perms"}
  </td>
  <td style="padding: 10px;" width="50%" valign="top">
   <table cellspacing="0" cellpadding="0">
    <tr style="cursor: hand; cursor: pointer;">
     {foreach from=$LANGS key=KEY item=LANG}
     <td onclick="document.forms['node_perms'].x{$BASEID}_lang_filter.value='{$KEY}';document.forms['node_perms'].submit()" class="lang_tab{if $ACTIVE_LANG == $KEY}_active{/if}"><img src="{$XT_IMAGES}lang/{$KEY}.png" alt="{$KEY}" title="{$KEY}" /></td>
     {/foreach}
    </tr>
   </table>
   <table cellspacing="0" cellpadding="0" width="100%">
    <tr>
     <td class="table_header" colspan="2">{"Edit permissions"|translate}</td>
    </tr>
    {if $ACTIVE_PRINCIPAL}
    {foreach from=$PERMS key=KEY item=PERM}
    <tr class="{cycle values="row_a,row_b"}">
     <td class="row" style="width: 12px; padding-right: 0px;">{if $PERM.rights}<input type="hidden" name="x{$BASEID}_perms[{$KEY}]" value="1"><img style="cursor: hand; cursor: pointer;" onclick="switchPerm(this, 'x{$BASEID}_perms[{$KEY}]');" src="{$XT_IMAGES}icons/check_small.png" alt="" />{else}<input type="hidden" name="x{$BASEID}_perms[{$KEY}]" value="0"><img style="cursor: hand; cursor: pointer;" onclick="switchPerm(this, 'x{$BASEID}_perms[{$KEY}]');" src="{$XT_IMAGES}icons/forbidden_small.png" alt="" />{/if}</td>
     <td class="row">{if $PERM.rights}<span style="color: green;">{$PERM.perm}</span>{else}<span style="color: red;">{$PERM.perm}</span>{/if}</td>
    </tr>
    {/foreach}
    <tr>
     <td colspan="2" style="padding-top: 10px;"><input onclick="document.forms['node_perms'].x{$BASEID}_action.value='saveNodePermissions';document.forms['node_perms'].submit()" type="button" value="{"Save permissions"|translate}" class="button"></td>
    </tr>
    {else}
    <tr>
     <td class="right" style="border: 0px;">{"Please choose a principal first"|translate}</td>
    </tr>
    {/if}
   </table>
  </td>
 </tr>
</table>
<input type="hidden" name="x{$BASEID}_action" value="" />
<input type="hidden" name="x{$BASEID}_{$ACTIVE_MODE}_id" value="{$ACTIVE_PRINCIPAL}" />
<input type="hidden" name="x{$BASEID}_base_id" value="{$ACTIVE_BASEID}" />
<input type="hidden" name="x{$BASEID}_mode" value="{$ACTIVE_MODE}" />
<input type="hidden" name="x{$BASEID}_lang_filter" value="{$ACTIVE_LANG}" />
<input type="hidden" name="x{$BASEID}_save_lang" value="{$ACTIVE_LANG}" />
</form>

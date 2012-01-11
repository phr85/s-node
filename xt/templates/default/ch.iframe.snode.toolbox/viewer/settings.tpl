{include file="ch.iframe.snode.toolbox/viewer/header.tpl"}
<form action="{$smarty.server.PHP_SELF}?TPL={$TPL}" method="post" name="settings">
{include file="includes/buttons.tpl" data=$BUTTONS}
{include file="includes/lang_selector_simple.tpl" form="settings"}
<table cellspacing="0" cellpadding="0" width="100%" summary="">
 <tr>
  <td class="adminleft">
  	{"Page title"|translate}
  </td>
  <td class="adminright">
	<input type="text" name="x{$BASEID}_pagetitle" value="{$DATA.pagetitle|htmlspecialchars}" size="28" style="font-weight: bold;" />
  </td>
 </tr>

 <tr>
  <td class="adminright">
  	{"Description"|translate}<br/><span class="admingray">{"(Visible in the search result of google)"|translate}</span>
  </td>
  <td class="adminright">
	<textarea cols="28" rows="3" name="x{$BASEID}_description">{$DATA.description}</textarea>
  </td>
 </tr>
 <tr>
  <td class="adminright">
  	{"Keywords"|translate}<br/><span class="admingray">{"(comma seperated)"|translate}</span>
  </td>
  <td class="adminright">
	<textarea cols="28" rows="3" name="x{$BASEID}_keywords">{$DATA.keywords}</textarea>
  </td>
 </tr>


 {include file="includes/widgets/relations.tpl" cid=$DATA.node_id ctitle=$DATA.title|htmlentities live=1 BASEID=60}

 <tr>
  <td class="adminleft">
  	{"Access control"|translate}
  </td>
  <td class="adminright">
	{actionIcon

                action="editNodePerms"
                icon="lock.png"
                form="settings"
                node_id=$TPL
                node_pid=$PID
                node_perm="manageNodePermissions"
                title="Edit page node permissions"
          }
   </td>
 </tr>

 </table>
<input type="hidden" name="x{$BASEID}_tpl_id" value="{$TPL}"/>
 <input type="hidden" name="x{$BASEID}_node_id" value=""/>
 <input type="hidden" name="x{$BASEID}_node_pid" value=""/>
 </form>
{include file="ch.iframe.snode.toolbox/viewer/footer.tpl"}
<form method="POST" name="browser" onSubmit="window.document.forms['navigation'].x{$BASEID}_yoffset.value=window.pageYOffset;">
 {include file="includes/buttons.tpl" data=$BROWSER_BUTTONS}
 {include file="includes/lang_selector_simple.tpl" form="browser"}
<table cellpadding="0" cellspacing="0" width="100%">
 <tr>
  <td class="table_header">{"node_tree"|translate}</td>
 </tr>
 {foreach from=$NODES item=NODE}
  {if $NODE.allowed.view == 1}
  <tr class="{cycle values="row_a,row_b"}">
   <td>
    <table cellspacing="0" cellpadding="0" width="100%">
     <tr>
      <td class="row" style="padding-left: {$NODE.level*20-32}px; width: 1px;"><br></td>
      <td class="button" style="padding-right: 0px;width: 16px">
      {if $NODE.itw}{actionIcon
        action   = "openNode"
        icon     = "explorer/folder.png"
        form     = "1"
        target   = "master"
        active   = $NODE.id
        }{else}{actionIcon
        action   = "openNode"
        target   = master
        active   = $NODE.id
        open     = $NODE.id
        icon="explorer/folder_closed.png"
        form="browser"
        title=""}{/if}</a><br>
      </td>
      <td class="row">{if $NODE.itw}{actionLink
        action   = "openNode"
        target   = master
        active   = $NODE.id
        open     = $NODE.id
        form     ="browser"
        title    = $NODE.subs
        style    = "font-weight: bold;"
        text     = $NODE.title}{else}{actionLink
        action   = "openNode"
        target   = master
        active   = $NODE.id
        open     = $NODE.id
        form     ="browser"
        title    = $NODE.subs
        text     = $NODE.title}
        {/if}
        </td>
      <td class="button" align="right">
      {if $CTRL}{actionIcon
                action="insertNode"
                icon="explorer/arrow_down_green.png"
                form="1"
                node_perm="browserStructure"
                node_pid=$NODE.pid
                node_id=$NODE.id
                target="master"
                position="after"
                title="Insert after this node"

          }{actionIcon

                action="insertNode"
                icon="explorer/arrow_up_green.png"
                form="1"
                node_perm="browserStructure"
                node_pid=$NODE.pid
                node_id=$NODE.id
                target="master"
                position="before"
                title="Insert before this node"

          }{actionIcon

                action="insertNode"
                icon="explorer/folder_into.png"
                form="1"
                node_perm="browserStructure"
                node_pid=$NODE.pid
                node_id=$NODE.id
                target="master"
                position="into"
                title="Insert into this node"

      }

      {else}
      {if $NODE.active == 1
              }{actionIcon
              
                    action="deactivateNodeLang"
                    icon="active.png"
                    form="browser"
                    node_perm="browserStructure"
                    node_pid=$NODE.pid
                    id=$NODE.id
                    node_id=$NODE.id
                    title="Deactivate this node in this language"
                    yoffset="1"
		    
          }{else
              }{actionIcon 
                    action="activateNodeLang"
                    icon="inactive.png"
                    form="browser"
                    node_perm="browserStructure"
                    node_pid=$NODE.pid
                    id=$NODE.id
                    node_id=$NODE.id
                    title="Activate this node in this language"
                    yoffset="1"
                    
          }{/if}{
          actionIcon 
                action="cutNode"
                icon="cut.png"
                form="browser"
                node_id=$NODE.id
                node_pid=$NODE.pid
                node_perm="browserStructure"
                title="Cut"
          }{if !$PICKER
      }{actionIcon
                action="editNodePerms"
                icon="lock.png"
                form="browser"
                node_perm="manageNodePermissions"
                node_id=$NODE.id
                node_pid=$NODE.pid
                title="Edit page node permissions"
          }{actionIcon
                action="editNode"
                icon="pencil.png"
                form="1"
                target="master"
                node_id=$NODE.id
                node_pid=$NODE.pid
                node_perm="browserStructure"
                title="Edit this node"

          }{actionIcon
                action="deleteNode"
                icon="delete.png"
                form="1"
                target="master"
                node_id=$NODE.id
                node_pid=$NODE.pid
                node_perm="browserStructure"
                title="Delete this node"
                ask="Are you sure you want to delete this node?"

          }
       {/if}{/if}</td>


     </tr>
    </table>
   </td>
  </tr>
  {/if}
 {/foreach}
</table>
{actionIcon
    action="editNodePerms"
    icon="lock.png"
    form="browser"
    node_perm="manageNodePermissions"
    node_id=1
    node_pid=0
    title="Edit root node permissions"
}{if $CTRL}{actionIcon
    action="insertNode"
    icon="explorer/folder_into.png"
    form="1"
    node_perm="manageNodePermissions"
    node_pid=0
    node_id=1
    target="master"
    position="into"
    title="Insert into root node"
}{/if}
<input type="hidden" name="x{$BASEID}_id" value="">
<input type="hidden" name="x{$BASEID}_save_lang" value="">
<input type="hidden" name="x{$BASEID}_active">
<input type="hidden" name="x{$BASEID}_position">
<input type="hidden" name="x{$BASEID}_node_id" value="">
<input type="hidden" name="x{$BASEID}_node_pid" value="">
<input type="hidden" name="x{$BASEID}_open" value="">
<input type="hidden" name="showtabs" value="1">
<input type="hidden" name="x{$BASEID}_module" value="{$ADMINMODULE}">
    {yoffset}
</form>


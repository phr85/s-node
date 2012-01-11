{include file="ch.iframe.snode.toolbox/viewer/header.tpl"}
<form action="{$smarty.server.PHP_SELF}?TPL={$TPL}" method="post" name="content">
{include file="includes/buttons.tpl" data=$BUTTONS}
{include file="includes/lang_selector_simple.tpl" form="content"}
<table cellspacing="0" cellpadding="0" width="100%" summary="">
  <tr>
  <td class="adminleft" colspan="2">
  	{"content"|translate}
  </td>
 </tr>
 {foreach key=key from=$PACKAGES item=PACKAGE name=PKG}
 <tr>
  <td class="adminright" style="width:100px;">{if $CTRL != 1}
  {if $PACKAGE.active == 1}
  {actionIcon
      action="deactivateContent"
      icon="activated.png"
      form="content"
      title="Deactivate this content"
      entry_id = $PACKAGE.id
      node_id = $PACKAGE.node_id
  }
  {else}
    {actionIcon
      action="activateContent"
      icon="deactivated.png"
      form="content"
      title="Activate this content"
      entry_id = $PACKAGE.id
      node_id = $PACKAGE.node_id
  }
  {/if}
 <a href="javascript:popup('/index.php?TPL=102&amp;module=slave1&amp;x{$NAVIGATION_BASEID}_action=editContentSimple&amp;x{$NAVIGATION_BASEID}_livetpl=1&amp;x{$NAVIGATION_BASEID}_entry_id={$PACKAGE.id}&amp;x{$NAVIGATION_BASEID}_node_id={$PACKAGE.node_id}',800,600,'edit_{$PACKAGE.title}')"><img src="{$XT_IMAGES}/icons/pencil.png" alt="{"Edit this content"|translate}" title="{"Edit this content"|translate}"/></a>
  {actionIcon
      action="deleteContent"
      icon="delete.png"
      form="content"
      title="Delete this content"
      ask="Do you really want to delete this entry?"
      entry_id=$PACKAGE.id
      node_id = $PACKAGE.node_id
  }
  {if !$smarty.foreach.PKG.first}{
  actionIcon
      action="moveUpContent"
      icon="explorer/arrow_up_green.png"
      form="content"
      title="Move this content up"
      entry_id=$PACKAGE.id
      entry_pos=$PACKAGE.position
      node_id=$PACKAGE.node_id
  }{else}&nbsp;{/if}{if !$smarty.foreach.PKG.last}{
  actionIcon
      action="moveDownContent"
      icon="explorer/arrow_down_green.png"
      form="content"
      title="Move this content down"
      entry_id=$PACKAGE.id
      entry_pos=$PACKAGE.position
      node_id=$PACKAGE.node_id
  }{else}&nbsp;{/if}
{else}

<a href="javascript:popup('/index.php?TPL=102&amp;module=slave1&amp;x{$NAVIGATION_BASEID}_action=insertContentSimple&amp;x{$NAVIGATION_BASEID}_lang_filter={$ACTIVE_LANG}&amp;x{$NAVIGATION_BASEID}_livetpl=1&amp;x{$NAVIGATION_BASEID}_entry_pos={$PACKAGE.position}&amp;x{$NAVIGATION_BASEID}_insert_pos={$PACKAGE.position}&amp;x{$NAVIGATION_BASEID}_entry_mode=before&amp;x{$NAVIGATION_BASEID}_node_id={$PACKAGE.node_id}&amp;x{$NAVIGATION_BASEID}_node_pid={$PACKAGE.pid}',800,600,'edit_{$PACKAGE.title}');document.forms['content'].x{$BASEID}_action.value='addContentCancel';document.forms['content'].submit();"><img src="{$XT_IMAGES}icons/explorer/arrow_up_green.png" alt="{"Insert before"|translate}" title="{"Insert before"|translate}"/></a>
<a href="javascript:popup('/index.php?TPL=102&amp;module=slave1&amp;x{$NAVIGATION_BASEID}_action=insertContentSimple&amp;x{$NAVIGATION_BASEID}_lang_filter={$ACTIVE_LANG}&amp;x{$NAVIGATION_BASEID}_livetpl=1&amp;x{$NAVIGATION_BASEID}_entry_pos={$PACKAGE.position}&amp;x{$NAVIGATION_BASEID}_insert_pos={$PACKAGE.position}&amp;x{$NAVIGATION_BASEID}_entry_mode=after&amp;x{$NAVIGATION_BASEID}_node_id={$PACKAGE.node_id}&amp;x{$NAVIGATION_BASEID}_node_pid={$PACKAGE.pid}',800,600,'edit_{$PACKAGE.title}');document.forms['content'].x{$BASEID}_action.value='addContentCancel';document.forms['content'].submit();"><img src="{$XT_IMAGES}icons/explorer/arrow_down_green.png" alt="{"Insert after"|translate}" title="{"Insert after"|translate}"/></a>

{/if}
  </td>
  <td class="adminright">
	{if $PACKAGE.icon == ""}
		<img src="{$XT_IMAGES}icons/document.png" alt="{$PACKAGE.content_type_title|translate}" title="{$PACKAGE.content_type_title|translate}"/>
	{else}
		<img src="{$XT_IMAGES}icons/{$PACKAGE.icon}" alt="{$PACKAGE.content_type_title|translate}" title="{$PACKAGE.content_type_title|translate}"/>
	{/if}
	{$PACKAGE.content_title}
  </td>
 </tr>
 {/foreach}
 <tr>
  <td class="adminleft" colspan="2">
  	{"new site"|translate}
  </td>
 </tr>
 <tr>
  <td class="adminright" colspan="2">
  {
  actionIcon
      action="insertNode"
      icon="breakpoint_up.png"
      form="content"
      title="Insert page before"
      position="before"
      node_id=$TPL
      node_pid=$PID
      label="Insert page before"
  }<br/>
   {
  actionIcon
      action="insertNode"
      icon="breakpoint_down.png"
      form="content"
      title="Insert page after"
      position="after"
      node_id=$TPL
      node_pid=$PID
      label="Insert page after"
  }<br/>
   {
  actionIcon
      action="insertNode"
      icon="breakpoint_into.png"
      form="content"
      title="Insert page into"
      position="into"
      node_id=$TPL
      node_pid=$PID
      label="Insert page into"
  }<br/>
  </td>
</tr>
 </table>
 <input type="hidden" name="x{$BASEID}_entry_id" value=""/>
 <input type="hidden" name="x{$BASEID}_node_id" value=""/>
 <input type="hidden" name="x{$BASEID}_node_pid" value=""/>
 <input type="hidden" name="x{$BASEID}_entry_pos" value=""/>
 <input type="hidden" name="x{$BASEID}_position" value=""/>
 </form>
{include file="ch.iframe.snode.toolbox/viewer/footer.tpl"}
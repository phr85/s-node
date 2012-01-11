 {if $ctype == ""}
 {assign var="ctype" value=$BASEID}
 {/if}

 {if $formname == ""}
	 {assign var="formname" value=0}
 {/if}
 <tr>
  {if $live != 1}
  <td class="left">{"Relations"|translate}:</td>
  {else}
  <td class="adminleft" colspan="2">{"Relations"|translate}:</td></tr>
  {/if}

  {if $live != 1}
  <td class="right">
  {else}
   <tr><td class="adminright" colspan="2">
  {/if}

  <!-- a href="javascript:popup('/index.php?TPL=556&amp;ctype={$ctype}&amp;cid={$cid}&amp;ctitle={$ctitle|addslashes}&amp;mod=tree',370,300);"><img src="{$XT_IMAGES}icons/explorer/folder_into.png" {"file nodes"|alttag} /></a -->

  <a href="javascript:popup('/index.php?TPL=557&amp;ctype={$ctype}&amp;cid={$cid}&amp;ctitle={$ctitle|addslashes}&amp;conf[table_tree]=files_tree&amp;conf[table_nodes]=files_tree_details&amp;conf[itemrelfieldname]=file_id&amp;conf[noderelfieldname]=node_id&amp;conf[table_items]=files_details&amp;conf[table_items_relation]=files_rel&amp;conf[tree_ctype]=241&amp;conf[item_ctype]=240',370,300);"><img src="{$XT_IMAGES}icons/folder.png" {"files"|alttag} /></a>
  <img src="/images/icons/menu_continue.gif" alt="" />
  <!-- KATALOG a href="javascript:popup('/index.php?TPL=557&amp;ctype={$ctype}&amp;cid={$cid}&amp;ctitle={$ctitle}&amp;conf[table_tree]=catalog_tree&amp;conf[table_nodes]=catalog_tree_nodes&amp;conf[itemrelfieldname]=article_id&amp;conf[noderelfieldname]=node_id&amp;conf[table_items]=catalog_articles_details&amp;conf[table_items_relation]=catalog_tree_articles&amp;conf[tree_ctype]=1201&amp;conf[item_ctype]=1200',370,300);"><img src="{$XT_IMAGES}icons/package.png" {"catalog"|alttag} /></a -->
  <!-- REZEPTE <a href="javascript:popup('/index.php?TPL=557&amp;ctype={$ctype}&amp;cid={$cid}&amp;ctitle={$ctitle}&amp;conf[table_tree]=rezepte_tree&amp;conf[table_nodes]=rezepte_tree_nodes&amp;conf[itemrelfieldname]=recipe_id&amp;conf[noderelfieldname]=node_id&amp;conf[table_items]=rezepte_details&amp;conf[table_items_relation]=rezepte_r2tree&amp;conf[tree_ctype]=5701&amp;conf[item_ctype]=5700',370,300);"><img src="{$XT_IMAGES}icons/book_blue_next.png" {"rezepte"|alttag} /></a> -->
  <a href="javascript:popup('/index.php?TPL=555&amp;ctype={$ctype}&amp;cid={$cid}&amp;ctitle={$ctitle|addslashes}&amp;mod=tree',370,300);"><img src="{$XT_IMAGES}icons/colors.png" {"categories"|alttag} /></a>
  <img src="/images/icons/menu_continue.gif" alt="" />
  <a href="javascript:popup('/index.php?TPL=557&amp;ctype={$ctype}&amp;cid={$cid}&amp;ctitle={$ctitle|addslashes}&amp;conf[table_tree]=articles_tree&amp;conf[table_nodes]=articles_tree_details&amp;conf[itemrelfieldname]=article_id&amp;conf[noderelfieldname]=node_id&amp;conf[table_items]=articles&amp;conf[table_items_relation]=articles_tree_rel&amp;conf[tree_ctype]=271&amp;conf[item_ctype]=270',370,300);"><img src="{$XT_IMAGES}icons/document.png" {"articles"|alttag} /></a>
  <img src="/images/icons/menu_continue.gif" alt="" />
  
  {* Files Folders *}
  <a href="javascript:popup('/index.php?TPL=557&amp;ctype={$ctype}&amp;cid={$cid}&amp;ctitle={$ctitle|addslashes}&amp;conf[table_tree]=files_tree&amp;conf[table_nodes]=files_tree_details&amp;conf[itemrelfieldname]=node_id&amp;conf[noderelfieldname]=node_id&amp;conf[tree_ctype]=241&amp;conf[item_ctype]=240',370,300);"><img src="{$XT_IMAGES}icons/check.png" {"folders"|alttag} /></a>
  
  <img src="/images/icons/menu_continue.gif" alt="" />
  
  <a href="javascript:popup('/index.php?TPL=557&amp;ctype={$ctype}&amp;cid={$cid}&amp;ctitle={$ctitle|addslashes}&amp;conf[table_tree]=navigation&amp;conf[table_nodes]=navigation_details&amp;conf[itemrelfieldname]=node_id&amp;conf[noderelfieldname]=node_id&amp;conf[table_items]=articles&amp;conf[table_items_relation]=articles_tree_rel&amp;conf[tree_ctype]=60&amp;conf[item_ctype]=270',370,300);"><img src="{$XT_IMAGES}icons/window_sidebar.png" {"sitestructure"|alttag} /></a>

  <img src="/images/icons/menu_continue.gif" alt="" />
  <a href="javascript:popup('/index.php?TPL=557&amp;ctype={$ctype}&amp;cid={$cid}&amp;ctitle={$ctitle|addslashes}&amp;conf[table_tree]=events_tree&amp;conf[table_nodes]=events_tree_details&amp;conf[itemrelfieldname]=event_id&amp;conf[noderelfieldname]=node_id&amp;conf[table_items]=events_details&amp;conf[table_items_relation]=events_tree_rel&amp;conf[tree_ctype]=5101&amp;conf[item_ctype]=5100',370,300);"><img src="{$XT_IMAGES}icons/calendar.png" {"events"|alttag} /></a>
  <img src="/images/icons/menu_continue.gif" alt="" />
  </td>
 </tr>
 {xt_get_relations cid=$cid ctype=$ctype lang="$ACTIVE_LANG"}
{if $RELATIONS|@count > 0}
 <tr>
 	<td class="left" >{"Used Relations"|translate}</td>
 	<td class="right">

 <table width="100%">

{foreach item=RELATION from=$RELATIONS.list name="R"}
	<tr>
		<td class="right"><img src="{$XT_IMAGES}icons/{$RELATION.icon}" alt="{$RELATION.title}"/> {if $RELATION.title == ""}{"unknown"|translate}{else}{$RELATION.title}{/if}</td>
		<td class="right" width="60">
		<a href="javascript:
  if(confirm('{'Are you sure to delete this relation?'|translate}'))
   document.forms['{$formname}'].x{$BASEID}_XT_REL_relation_id.value='{$RELATION.id}';
   document.forms['{$formname}'].x{$BASEID}_action.value='ch.iframe.snode.relations.deleteRelation';
   document.forms['{$formname}'].submit();">
  	 		   		<img src="images/icons/delete.png" alt="{"Delete relation"|translate}" title="{"Delete relation"|translate}" />
   			  </a>
		    {if !$smarty.foreach.R.first}
               <a href="javascript:document.forms['{$formname}'].x{$BASEID}_action.value='ch.iframe.snode.relations.moveRelationUp'; document.forms['{$formname}'].x{$BASEID}_XT_REL_relation_id.value='{$RELATION.id}';   document.forms['{$formname}'].submit();">
  	 		   		<img src="images/icons/explorer/arrow_up_green.png" alt="{"Move this relation up"|translate}" title="{"Move this relation up"|translate}" />
   			  </a>

              {/if}
              {if !$smarty.foreach.R.last}
				<a href="javascript:document.forms['{$formname}'].x{$BASEID}_action.value='ch.iframe.snode.relations.moveRelationDown'; document.forms['{$formname}'].x{$BASEID}_XT_REL_relation_id.value='{$RELATION.id}';   document.forms['{$formname}'].submit();">
  	 		   		<img src="images/icons/explorer/arrow_down_green.png" alt="{"Move this relation down"|translate}" title="{"Move this relation down"|translate}" />
   			  </a>
              {/if}
		</td>
	</tr>
{/foreach}
</table>
<input type="hidden" name="x{$BASEID}_XT_REL_relation_id" value="">
</td>
 </tr>
 {/if}
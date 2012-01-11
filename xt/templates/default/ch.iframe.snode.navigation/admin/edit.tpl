<script language="JavaScript" type="text/javascript"><!--
window.parent.frames['master'].document.forms[1].module.value='oa';
window.parent.frames['master'].document.forms[1].x{$BASEID}_open.value={$DATA.node_id};
window.parent.frames['master'].document.forms[1].x{$BASEID}_lang_filter.value='{$ACTIVE_LANG}';
window.parent.frames['master'].document.forms[1].x{$BASEID}_yoffset.value=window.parent.frames['master'].pageYOffset;
window.parent.frames['master'].document.forms[1].submit();
//-->
</script>
<form action="{$smarty.server.PHP_SELF}?TPL={$TPL}&amp;x{$BASEID}_module=e" method="post" name="edit" onSubmit="window.document.forms['edit'].x{$BASEID}_yoffset.value= window.pageYOffset;">
<table cellspacing="0" cellpadding="0" width="100%">
 <tr>
  <td class="view_header" colspan="2">
   <span class="title_light">{$DATA.node_id}:</span> <span class="title">{$DATA.title}</span>
  </td>
 </tr>
 <tr>
  <td class="view_separator" colspan="2"><img src="{$XT_IMAGES}spacer.gif" alt="" /></td>
 </tr>
</table>
{include file="includes/buttons.tpl" data=$EDIT_BUTTONS}
{include file="includes/lang_selector_submit.tpl" form="edit"}
{if $LANGUAGE_TRANSFER}{include file="includes/buttons.tpl" data=$BUTTONS withouthidden="1"}{/if}
<table cellspacing="0" cellpadding="0" width="100%">
 <tr>
  <td class="left">{"Navigation"|translate}</td>
  <td class="right"><input type="text" size="42" name="x{$BASEID}_title" value="{$DATA.title|htmlspecialchars}" style="font-weight: bold;" /></td>
 </tr>
 <tr>
  <td class="left">{"Pagetitle"|translate}</td>
  <td class="right"><input type="text" size="42" name="x{$BASEID}_pagetitle" value="{$DATA.pagetitle|htmlspecialchars}" style="font-weight: bold;" /></td>
 </tr>
 <tr>
  <td class="left">{"ID"|translate}</td>
  <td class="right"><input type="text" size="10" name="x{$BASEID}_new_id" value="{$DATA.node_id}" disabled /></td>
 </tr>
 <tr>
  <td class="left">{"Template"|translate}</td>
  <td class="right">
  {if sizeof($LANGS) > 1}
  <input type="checkbox" name="x{$BASEID}_tpl_join" {if $DATA.tpl_join}checked="checked"{/if} id="joined" onchange="switchjoin();" /> <label for="joined">{"Joined"|translate} </label> 
  
  <script>
  var id = {$DATA.node_id};
  
  var lang = '{$ACTIVE_LANG}';
  
  {literal}
  function switchjoin(){
  	if($('#joined').attr('checked')){
  		$('#tplfile').val('_pages/' + id + '.tpl');
  	}else{
  		$('#tplfile').val('_pages/' + id + '_' + lang + '.tpl');
  		
  	}
  }
  </script>
  {/literal}
  <br />
  {/if}
  <input type="text" size="42" name="x{$BASEID}_tpl_file" id="tplfile" value="{$DATA.tpl_file}" />&nbsp;&nbsp;{
  actionIcon
      action="editTemplate"
      icon="edit_small.png"
      form="edit"
      title="Edit this template"
  }</td>
 </tr>
{if $DISPLAY.relations}
 {include file="includes/widgets/relations.tpl" cid=$DATA.node_id ctitle=$DATA.title|htmlentities}
{/if}
{if $DISPLAY.properties}
  {include file="includes/widgets/properties.tpl" content_id=$DATA.node_id content_type=$BASEID formname="edit" universal=true lang=$ACTIVE_LANG}
{/if}
 <tr>
  <td class="left">{"Target"|translate}</td>
  <td class="right">
   <select name="x{$BASEID}_target">
    <option value="_self"   {if $DATA.target == '_self'}selected{/if}>{"Same window"|translate} (_self)</option>
    <option value="_blank"  {if $DATA.target == '_blank'}selected{/if}>{"New window"|translate} (_blank)</option>
    <option value="_parent" {if $DATA.target == '_parent'}selected{/if}>{"Parent window"|translate} (_parent)</option>
    <option value="_top"    {if $DATA.target == '_top'}selected{/if}>{"Top window"|translate} (_top)</option>
   </select>
  </td>
 </tr>
 <!--
 <tr>
  <td class="left">{"Half decay period"|translate}</td>
  <td class="right">
   <input type="text" size="4" name="x{$BASEID}_halflife" value="{$DATA.halflife}">
   <select name="x{$BASEID}_halflife_mode">
    <option value="31536000" {if $DATA.halflife_mode == 31536000}selected{/if}>{"Years"|translate}</option>
    <option value="2592000" {if $DATA.halflife_mode == 2592000}selected{/if}>{"Month"|translate}</option>
    <option value="86400" {if $DATA.halflife_mode == 86400}selected{/if}>{"Days"|translate}</option>
    <option value="3600" {if $DATA.halflife_mode == 3600}selected{/if}>{"Hours"|translate}</option>
   </select>
  </td>
 </tr>
 -->
</table>

<table cellspacing="0" cellpadding="0" width="100%">
 <tr>
  <td class="view_header" colspan="3">
   <span class="title">{"Visibility"|translate}</span>
  </td>
 </tr>
 <tr>
  <td class="view_separator" colspan="3"><img src="{$XT_IMAGES}spacer.gif" alt="" /></td>
 </tr>
 <tr>
  <td class="left">{"Is this page public?"|translate}</td>
  <td class="right" width="40"><input onchange="switchImage(this, 'lock','lock_open.png','lock.png');" type="checkbox" name="x{$BASEID}_public" value="1" {if $DATA.public == 1}checked{/if}  />
   <img src="{$XT_IMAGES}icons/lock{if $DATA.public == 1}_open{/if}.png" alt="" id="lock" />
  </td>
  <td class="right">
   <input type="button" onclick="document.forms['edit'].x{$BASEID}_action.value='applyVisibility';document.forms['edit'].submit();" value="{'Apply for all subnodes'|translate}" />
  </td>
 </tr>
 <tr>
  <td class="left">{"Is this page visible?"|translate}</td>
  <td class="right"><input type="checkbox" name="x{$BASEID}_visible" value="1" {if $DATA.visible == 1}checked{/if} />
  </td>
  <td class="right">
   <input type="button" onclick="document.forms['edit'].x{$BASEID}_action.value='applyVisible';document.forms['edit'].submit();" value="{'Apply for all subnodes'|translate}" />
  </td>
</tr>
 <tr>
  <td class="left">{"Show in overview?"|translate}</td>
  <td class="right"><input type="checkbox" name="x{$BASEID}_show_in_overview" value="1" {if $DATA.show_in_overview == 1}checked{/if} />
  </td>
  <td class="right">
   <input type="button" onclick="document.forms['edit'].x{$BASEID}_action.value='applyVisibleOverview';document.forms['edit'].submit();" value="{'Apply for all subnodes'|translate}" />
  </td>
 </tr>
</table>


<!-- Begin Style -->
<table cellspacing="0" cellpadding="0" width="100%">
 <tr>
  <td class="view_header" colspan="2">
   <span class="title">{"Style"|translate}</span>
  </td>
 </tr>
 <tr>
  <td class="view_separator" colspan="2"><img src="{$XT_IMAGES}spacer.gif" alt="" /></td>
 </tr>
 <tr>
  <td class="left">{"Header"|translate}</td>
  <td class="right">

  <select name="x{$BASEID}_header">
   {foreach from=$USERTPL.HEADERS key="avTPL" item="avTPLTheme"}
    <option {if $avTPLTheme!='system'}style="background-color:#99FF99;"{/if} value="{$avTPL}"{if $avTPL==$DATA.header} selected="selected"{/if}>{$avTPL}  ({$avTPLTheme})</option>
   {/foreach}
   </select>

  </td>
 </tr>
 <tr>
  <td class="left">{"Footer"|translate}</td>
  <td class="right">
    <select name="x{$BASEID}_footer">
   {foreach from=$USERTPL.FOOTERS key="avTPL" item="avTPLTheme"}
    <option {if $avTPLTheme!='system'}style="background-color:#99FF99;"{/if} value="{$avTPL}"{if $avTPL==$DATA.footer} selected="selected"{/if}>{$avTPL}  ({$avTPLTheme})</option>
   {/foreach}
   </select>
   </td>
 </tr>
 <tr>
  <td class="left">{"CSS"|translate}</td>
  <td class="right"><input type="text" size="42" name="x{$BASEID}_css" value="{$DATA.css}" /></td>
 </tr>
 <tr>
  <td class="left">{"Apply style informations for all subsites."|translate}</td>
  <td class="right">
   <input type="button" onclick="document.forms['edit'].x{$BASEID}_action.value='applyStyle';document.forms['edit'].submit();" value="{'Apply for all subnodes'|translate}" />
  </td>
 </tr>
</table>
<!-- End Style -->



<table cellspacing="0" cellpadding="0" width="100%">
 <tr>
  <td class="view_header" colspan="2">
   <span class="title">{"Meta information"|translate}</span>
  </td>
 </tr>
 <tr>
  <td class="view_separator" colspan="2"><img src="{$XT_IMAGES}spacer.gif" alt="" /></td>
 </tr>
 <tr>
  <td class="left">{"Description"|translate}</td>
  <td class="right"><textarea cols="50" rows="3" name="x{$BASEID}_description">{$DATA.description}</textarea></td>
 </tr>
 <tr>
  <td class="left">{"Keywords"|translate}</td>
  <td class="right"><textarea cols="50" rows="3" name="x{$BASEID}_keywords">{$DATA.keywords}</textarea></td>
 </tr>
 <tr>
  <td class="left">{"Author"|translate}</td>
  <td class="right"><input type="text" size="42" name="x{$BASEID}_author" value="{$DATA.author}" /></td>
 </tr>
 <tr>
  <td class="left">{"Copyright statement"|translate}</td>
  <td class="right"><input type="text" size="42" name="x{$BASEID}_copyright" value="{$DATA.copyright}" /></td>
 </tr>
  <tr>
  <td class="left">{"Revisit after"|translate}</td>
  <td class="right"><input type="text" size="42" name="x{$BASEID}_revisit_after" value="{$DATA.revisit_after}" /></td>
 </tr>
</table>



<table cellspacing="0" cellpadding="0" width="100%">
 <tr>
  <td class="view_header" colspan="2">
   <span class="title">{"Apache Rewrite"|translate}</span>
  </td>
 </tr>
 <tr>
  <td class="view_separator" colspan="2"><img src="{$XT_IMAGES}spacer.gif" alt="" /></td>
 </tr>
  <tr>
  <td class="left">ApacheModRewrite</td>
  <td class="right"><input type="text" size="42" name="x{$BASEID}_rewrite_name" value="{$DATA.rewrite_name}" /></td>
 </tr>
</table>
<!-- Contents designer -->
<table cellpadding="0" cellspacing="0" border="0" width="100%">
  <tr>
  <td class="view_header" colspan="3">
   <span class="title">{"Contents"|translate}</span>
  </td>
 </tr>
  <tr>
  <td class="view_separator" colspan="3"><img src="{$XT_IMAGES}spacer.gif" alt="" /></td>
 </tr>
 </table>
 {include file="includes/buttons.tpl" data=$CONTENTS_BUTTONS withouthidden="1" yoffset="true"}
 <table width="100%" cellpadding="0" cellspacing="0">
 {foreach from=$PACKAGES item=PACKAGE name=A}
 <tr>
    <td class="left">{if $PACKAGE.active == 0}{
  actionIcon
      action="activateContent"
      icon="inactive.png"
      form="edit"
      title="Activate this content"
      entry_id=$PACKAGE.id
  }{else}{
  actionIcon
      action="deactivateContent"
      icon="active.png"
      form="edit"
      title="Deactivate this content"
      entry_id=$PACKAGE.id
  }{/if}{
  actionIcon
      action="editContent"
      icon="pencil.png"
      form="edit"
      title="Edit this content"
      entry_id=$PACKAGE.id
      entry_position=$PACKAGE.position
  }{
  actionIcon
      action="deleteContent"
      icon="delete.png"
      form="edit"
      title="Delete this content"
      ask="Do you really want to delete this entry?"
      entry_id=$PACKAGE.id
  }{if !$smarty.foreach.A.first}{
  actionIcon
      action="moveUpContent"
      icon="explorer/arrow_up_green.png"
      form="edit"
      title="Move this content up"
      entry_id=$PACKAGE.id
      entry_pos=$PACKAGE.position
  }{else}{$ICONSPACER}{/if}{if !$smarty.foreach.A.last}{
  actionIcon
      action="moveDownContent"
      icon="explorer/arrow_down_green.png"
      form="edit"
      title="Move this content down"
      entry_id=$PACKAGE.id
      entry_pos=$PACKAGE.position
  }{else}{$ICONSPACER}{/if}</td>
    <td class="right" width="100">{$PACKAGE.title}</td>
    <td class="right" align="right">{$PACKAGE.params}</td>
 </tr>
 {/foreach}
</table>
<!-- Contents desigenr -->



<table cellspacing="0" cellpadding="0" width="100%">
 <tr>
  <td class="view_header" colspan="2">
   <span class="title">{"Site information"|translate}</span>
  </td>
 </tr>
 <tr>
  <td class="view_separator" colspan="2"><img src="{$XT_IMAGES}spacer.gif" alt="" /></td>
 </tr>
 <tr>
  <td class="left">{"ID"|translate}</td>
  <td class="right">{$DATA.node_id}</td>
 </tr>
 <tr>
  <td class="left">{"Author"|translate}</td>
  <td class="right">{$DATA.creation_user}<input type="hidden" name="x{$BASEID}_creation_user" value="{$DATA.c_user}" /></td>
 </tr>
 <tr>
  <td class="left">{"Creation date"|translate}</td>
  <td class="right">{$DATA.creation_date|date_format:"%d.%m.%Y %H:%I:%S"}<input type="hidden" name="x{$BASEID}_creation_date" value="{$DATA.creation_date}" /></td>
 </tr>
 <tr>
  <td class="left">{"Last Modifier"|translate}</td>
  <td class="right">{$DATA.mod_user}</td>
 </tr>
 <tr>
  <td class="left">{"Last Modification date"|translate}</td>
  <td class="right">{$DATA.mod_date|date_format:"%d.%m.%Y %H:%I:%S"}</td>
 </tr>
</table>

<input type="hidden" name="x{$BASEID}_ext_link" value="{$DATA.ext_link}" />
<input type="hidden" name="x{$BASEID}_blank" value="{$DATA.blank}" />
<input type="hidden" name="x{$BASEID}_image" value="{$DATA.image}" />
<input type="hidden" name="x{$BASEID}_image_version" value="{$DATA.image_version}" />
<input type="hidden" name="x{$BASEID}_nav_image" value="{$DATA.nav_image}" />
<input type="hidden" name="x{$BASEID}_nav_image_version" value="{$DATA.nav_image_version}" />
<input type="hidden" name="x{$BASEID}_nav_image_active" value="{$DATA.nav_image_active}" />
<input type="hidden" name="x{$BASEID}_nav_image_active_version" value="{$DATA.nav_image_active_version}" />
<input type="hidden" name="x{$BASEID}_nav_image_rollover" value="{$DATA.nav_image_rollover}" />
<input type="hidden" name="x{$BASEID}_nav_image_rollover_version" value="{$DATA.nav_image_rollover_version}" />
<input type="hidden" name="x{$BASEID}_nav_image_active_rollover" value="{$DATA.nav_image_active_rollover}" />
<input type="hidden" name="x{$BASEID}_nav_image_active_rollover_version" value="{$DATA.nav_image_active_rollover_version}" />
<input type="hidden" name="x{$BASEID}_active" value="{$NAV_ACTIVE}" />
<input type="hidden" name="x{$BASEID}_lang" value="{$ACTIVE_LANG}" />
<input type="hidden" name="x{$BASEID}_id" value="{$DATA.node_id}" />
<input type="hidden" name="x{$BASEID}_node_id" value="{$DATA.node_id}" />
<input type="hidden" name="x{$BASEID}_node_pid" />
<input type="hidden" name="x{$BASEID}_node_perm_pid" />
<input type="hidden" name="x{$BASEID}_node_perm_id" />
<input type="hidden" name="x{$BASEID}_position" />
<input type="hidden" name="x{$BASEID}_active" value="{$DATA.active}" />
<input type="hidden" name="x{$BASEID}_entry_id" />
<input type="hidden" name="x{$BASEID}_entry_position" />
<input type="hidden" name="x{$BASEID}_entry_pos" />
<input type="hidden" name="x{$BASEID}_field" />
<input type="hidden" name="x{$BASEID}_based_on_tpl" value="{$DATA.based_on_tpl}" />
<input type="hidden" name="x{$BASEID}_target_module" value="" />
<input type="hidden" name="TPL" value="{$TPL}" />
<input type="hidden" name="x{$BASEID}_save_lang" value="{$ACTIVE_LANG}" />
{yoffset}
</form>

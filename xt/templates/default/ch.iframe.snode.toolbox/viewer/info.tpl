{include file="ch.iframe.snode.toolbox/viewer/header.tpl"}
<form action="{$smarty.server.PHP_SELF}?TPL={$TPL}" method="post" name="info">
{include file="includes/buttons.tpl" data=$BUTTONS}
{include file="includes/lang_selector_simple.tpl" form="info"}
<table cellspacing="0" cellpadding="0" width="100%" summary="">
 <tr>
  <td class="adminleft">
  	{"Navigation"|translate}
  </td>
  <td class="adminright">
	<input type="text" name="x{$BASEID}_title" value="{$DATA.title|htmlspecialchars}" size="18" style="font-weight: bold;" />
  </td>
 </tr>
 <tr>
  <td class="adminright">
    {if $DATA.active == 1}
		{"site is active"|translate}
	{else}
		{"site is not active"|translate}
	{/if}

  </td>
  <td class="adminright">
	{if $DATA.active == 1}
		<a href="#" onclick="document.forms['info'].x{$BASEID}_action.value='deactivatePage';document.forms['info'].submit();"><img src="{$XT_IMAGES}icons/activated.png" alt="{"deactivate"|translate}" /></a>
	{else}
		<a href="#" onclick="document.forms['info'].x{$BASEID}_action.value='activatePage';document.forms['info'].submit();"><img src="{$XT_IMAGES}icons/deactivated.png" alt="{"deactivate"|translate}" /></a>
	{/if}
  </td>
 </tr>
 <tr>
  <td class="adminright">
  	{"Page id"|translate}
  </td>
  <td class="adminright">
	<input type="text" name="x{$BASEID}_tpl_id" value="{$TPL}" size="18" style="border-width: 0px;" readonly="readonly" />
  </td>
 </tr>
 <tr>
  <td class="adminright">{"Header"|translate}</td>
  <td class="adminright">

  <select name="x{$BASEID}_header" style="width:150px;">
   {foreach from=$USERTPL.HEADERS key="avTPL" item="avTPLTheme"}
    <option {if $avTPLTheme!='system'}style="background-color:#99FF99;"{/if} value="{$avTPL}"{if $avTPL==$DATA.header} selected="selected"{/if}>{$avTPL}  ({$avTPLTheme})</option>
   {/foreach}
   </select>

  </td>
 </tr>
 <tr>
  <td class="adminright">{"Footer"|translate}</td>
  <td class="adminright">
    <select name="x{$BASEID}_footer" style="width:150px;">
   {foreach from=$USERTPL.FOOTERS key="avTPL" item="avTPLTheme"}
    <option {if $avTPLTheme!='system'}style="background-color:#99FF99;"{/if} value="{$avTPL}"{if $avTPL==$DATA.footer} selected="selected"{/if}>{$avTPL}  ({$avTPLTheme})</option>
   {/foreach}
   </select>
   </td>
 </tr>
 <tr>
  <td class="adminright">{"CSS"|translate}</td>
  <td class="adminright"><input type="text" size="18" name="x{$BASEID}_css" value="{$DATA.css}" /></td>
 </tr>
  <tr>
  <td class="adminright">{"Template file"|translate}</td>
  <td class="adminright"><input type="text" size="18" name="x{$BASEID}_tpl_file" value="{$DATA.tpl_file}" /></td>
 </tr>
 <tr>
  <td class="adminleft" colspan="2">
  	{"Behaviour"|translate}
  </td>
 </tr>
 <tr>
  <td class="adminright">{"Target"|translate}</td>
  <td class="adminright">
   <select name="x{$BASEID}_target" style="width:150px;">
    <option value="_self"{if $DATA.target == '_self'} selected="selected"{/if}>{"Same window"|translate} (_self)</option>
    <option value="_blank"{if $DATA.target == '_blank'} selected="selected"{/if}>{"New window"|translate} (_blank)</option>
    <option value="_parent"{if $DATA.target == '_parent'} selected="selected"{/if}>{"Parent window"|translate} (_parent)</option>
    <option value="_top"{if $DATA.target == '_top'} selected="selected"{/if}>{"Top window"|translate} (_top)</option>
   </select>
  </td>
 </tr>
 </table>
 </form>
{include file="ch.iframe.snode.toolbox/viewer/footer.tpl"}
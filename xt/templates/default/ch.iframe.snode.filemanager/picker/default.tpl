<table cellspacing="0" cellpadding="0" width="100%">
 <tr>
  <td colspan="3" class="toolbar" style="padding: 5px; height: 1px;">
  {subplugin package="ch.iframe.snode.filemanager" module="upload"}
  </td>
 </tr>
</table>
<table cellspacing="0" cellpadding="0" width="100%">
 <tr>
  <td width="200" style="padding: 5px;" valign="top">
  <form method="POST" name="picker">
   <table cellspacing="0" cellpadding="0" width="100%" style="background-color: #FFFFFF; border: 1px solid #7F9DB9;">
    <tr>
     <td valign="top">
	{include file="includes/buttons.tpl" data=$BUTTONS}
      <table cellspacing="0" cellpadding="0" width="100%">
      {foreach from=$NODES item=NODE}
      <tr>
       <td>
        <table cellspacing="0" cellpadding="0" width="100%">
         <tr>
          <td class="row" style="padding-left: {$NODE.level*20-32}px; width: 1px;">{if $NODE.subs > 0}{if $NODE.itw}<img src="{$XT_IMAGES}icons/minus.gif" alt="" />{else}<img src="{$XT_IMAGES}icons/plus.gif" alt="" />{/if}{else}<img src="{$XT_IMAGES}spacer.gif" width="9" />{/if}</td>
          <td class="row" style="padding: 5px; padding-left: 0px; padding-right: 0px;width: 16px">
           <a href="javascript:document.forms[1].x{$BASEID}_open.value={$NODE.id};document.forms[1].submit();">{if $NODE.itw}{if $NODE.subs > 0}<img src="{$XT_IMAGES}icons/explorer/folder.png" alt="" />{else}<img src="{$XT_IMAGES}icons/explorer/folder.png" alt="" />{/if}{else}{if $NODE.subs > 0}<img src="{$XT_IMAGES}icons/explorer/folder_closed.png" alt="" />{else}<img src="{$XT_IMAGES}icons/explorer/folder_closed.png" alt="" />{/if}{/if}</a><br />
          </td>
          <td class="row"><a href="javascript:document.forms[1].x{$BASEID}_open.value={$NODE.id};document.forms[1].submit();">{if $NODE.itw}<span style="color: black;">{if $NODE.selected}<b>{$NODE.title}</b>{else}{$NODE.title}{/if}</span>{else}{$NODE.title}{/if}&nbsp;</a></td>
         {if $CTRL}<td class="row" align="right">
         {if $NODE.id != 1}{actionIcon
                action="insertNode"
                icon="explorer/arrow_down_green.png"
                form="picker"
                node_perm="addFiles"
                node_pid=$NODE.pid
                node_id=$NODE.id
                position="after"
                title="Insert after this folder"}
                {actionIcon
                action="insertNode"
                icon="explorer/arrow_up_green.png"
                form="picker"
                node_perm="addFiles"
                node_pid=$NODE.pid
                node_id=$NODE.id
                position="before"
                title="Insert before this folder"}
                {/if}
                {actionIcon
                action="insertNode"
                icon="explorer/folder_into.png"
                form="picker"
                node_perm="addFiles"
                node_pid=$NODE.pid
                node_id=$NODE.id
                position="into"
                title="Insert into this node"}
         
         </td>{else}
         <td class="row" align="right">
          <a href="javascript:document.forms['picker'].x{$BASEID}_action.value='';document.forms['picker'].x{$BASEID}_open.value={$NODE.id};document.forms['picker'].submit();"><img src="{$XT_IMAGES}icons/pencil.png" alt="" /></a>
         </td>{/if}
         </tr>
        </table>
       </td>
      </tr>
      {/foreach}
      </table>
      <input type="hidden" name="x{$BASEID}_open" />
		<input type="hidden" name="x{$BASEID}_file_id" />
		<input type="hidden" name="x{$BASEID}_filename" value="{$SELECTED.filename}"/>
		<input type="hidden" name="x{$BASEID}_node_id" />
		<input type="hidden" name="x{$BASEID}_node_pid" />
		<input type="hidden" name="x{$BASEID}_node_perm" />
		<input type="hidden" name="x{$BASEID}_position" />
		<input type="hidden" name="x{$BASEID}_save_lang" value="{$ACTIVE_LANG}" />
		<input type="hidden" name="x{$BASEID}_order_by" value="{$ORDER_BY}" />
		<input type="hidden" name="x{$BASEID}_order_by_dir" value="{$ORDER_BY_DIR}"/>
		<input type="hidden" name="x{$BASEID}_active" value="{$ANODE.active}" />
		<input type="hidden" name="x{$BASEID}_image" value="{$ANODE.image}" />
		<input type="hidden" name="x{$BASEID}_image_version" value="{$ANODE.image_version}" />
      </form>
      
     <img src="{$XT_IMAGES}spacer.gif" width="200" height="10" />
     </td>
    </tr>
   </table>
  </td>
  <td width="340" style="padding: 5px; padding-left: 0px;" valign="top">
   <table cellspacing="0" cellpadding="0" width="100%" style="height: 100%; background-color: #FFFFFF; border: 1px solid #DDDDDD;">
    <tr>
     <td valign="top" valign="top">
     <div style="background-image: url({$XT_IMAGES}admin/gfx/table_header.gif); height:20px;">
	{"Sort by"|translate}&nbsp;
		<select onchange="document.forms[1].x{$BASEID}_order_by.value=this.options[this.selectedIndex].value;document.forms[1].submit();">
			<option value="det.title" {if $ORDER_BY == "det.title"}selected{/if}>{"Title"|translate}</option>
			<option value="b.filesize" {if $ORDER_BY == "b.filesize"}selected{/if}>{"Size"|translate}</option>
			<option value="b.upload_date" {if $ORDER_BY == "b.upload_date"}selected{/if}>{"Date"|translate}</option>
		</select>
		&nbsp;
		<select onchange="document.forms[1].x{$BASEID}_order_by_dir.value=this.options[this.selectedIndex].value;document.forms[1].submit();">
			<option value="asc" {if $ORDER_BY_DIR == "asc"}selected{/if}>{"asc"|translate}</option>
			<option value="desc" {if $ORDER_BY_DIR == "desc"}selected{/if}>{"desc"|translate}</option>
		</select>
	</div>
      {foreach from=$FILES item=FILE name=F}
      <div style="padding: 3px;cursor: hand; cursor: pointer; background-image: url({$XT_IMAGES}icons/filetypes/image_big.png); margin: 2px; float: left; border: 1px solid #DDDDDD;" onClick="document.forms[1].x{$BASEID}_file_id.value='{$FILE.id}';document.forms[1].submit();">{
        if $FILE.type == 1}<img src="{$XT_WEB_ROOT}download.php?file_id={$FILE.id}&file_name={$FILE.title}&file_version=cube" alt="{$FILE.title}" title="{$FILE.title}" width="80" height="80" />{/if}{
        if $FILE.type == 2}<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=5,0,0,0" width="80" height="80">
       <param name="movie" value="{$XT_WEB_ROOT}download.php?file_id={$FILE.id}" />
       <param name="quality" value="high" />
       <embed src="{$XT_WEB_ROOT}download.php?file_id={$FILE.id}" quality="high" width="80" height="80" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" /></embed>
      </object>{/if
        }<div style="color: #999999; padding-left: 3px;">{if $FILE.title != ""}{$FILE.title|truncate:14:"...":true}{else}{$FILE.filename|truncate:14:"...":true}{/if}</div>
        </div>
      {/foreach}
     </td>
    </tr>
   </table>
   <table cellspacing="0" cellpadding="0" width="100%" style="height: 100%; background-color: #FFFFFF; border: 1px solid #DDDDDD;margin-top: 5px;">
   	<tr>
    	<td valign="top" valign="top">
    	<form method="POST" name="picker_rf">
			<table cellspacing="0" cellpadding="0" width="100%">
			  <tr>
			   <td class="left">{"name"|translate}</td>
			   <td class="right"><input type="text" name="x{$BASEID}_title" value="{$ANODE.title|htmlspecialchars}" size="35"></td>
			  </tr>
			  <tr>
			   <td class="left">{"description"|translate}</td>
			   <td class="right">{toggle_editor id="description"}
			   <textarea id="x{$BASEID}_description" name="x{$BASEID}_description" cols="35" rows="4">{$ANODE.description}</textarea></td>
			  </tr>
			  <tr>
			   <td class="left">&nbsp;</td>
			   <td class="right"><input type="button" name="xyz" value="{"rename"|translate}" onclick="document.forms['picker_rf'].submit();"></td>
			  </tr>
			</table>
			{include file="includes/editor.tpl"}
			 <input type="hidden" name="x{$BASEID}_action" value="renameFolder" />
<input type="hidden" name="x{$BASEID}_open" />
<input type="hidden" name="x{$BASEID}_file_id" />
<input type="hidden" name="x{$BASEID}_filename" value="{$SELECTED.filename}"/>
<input type="hidden" name="x{$BASEID}_node_id" value="{$ANODE.node_id}"/>
<input type="hidden" name="x{$BASEID}_node_pid" />
<input type="hidden" name="x{$BASEID}_node_perm" />
<input type="hidden" name="x{$BASEID}_position" />
<input type="hidden" name="x{$BASEID}_save_lang" value="{$ACTIVE_LANG}" />
<input type="hidden" name="x{$BASEID}_order_by" value="{$ORDER_BY}" />
<input type="hidden" name="x{$BASEID}_order_by_dir" value="{$ORDER_BY_DIR}"/>
<input type="hidden" name="x{$BASEID}_active" value="{$ANODE.active}" />
<input type="hidden" name="x{$BASEID}_image" value="{$ANODE.image}" />
<input type="hidden" name="x{$BASEID}_image_version" value="{$ANODE.image_version}" />
</form>
		</td>
     </tr>
   </table>
  </td>
  <td style="padding: 5px; padding-left: 0px;" valign="top">
  {if $SELECTED}

      {if $SELECTED.type == 1}
        <div style="border: 1px solid #DDDDDD; padding: 3px;"><img src="{$XT_WEB_ROOT}download.php?file_id={$SELECTED.id}&file_name={$SELECTED.title}&file_version=3" alt="Loading... {$SELECTED.title}" /><br /><br />
            
            {if $smarty.request.tinymce == 1}
                <a href="javascript:window.opener.document.forms['{$PICKER_FORM}'].width.value='';window.opener.document.forms['{$PICKER_FORM}'].height.value='';window.opener.document.forms['{$PICKER_FORM}'].src.value='{$XT_WEB_ROOT}download.php?file_id={$SELECTED.id}&file_version={$DEFAULT_IMAGE_VERSION}';window.opener.getImageData();window.close();"><img src="{$XT_IMAGES}icons/check.png" title="{"Pick this image"|translate}" alt="{"Pick this image"|translate}" /></a>
                {else}
                <a href="javascript:window.opener.document.forms['{$PICKER_FORM}'].{$PICKER_FIELD}.value={$SELECTED.id};window.opener.document.forms['{$PICKER_FORM}'].{$PICKER_FIELD}_version.value={$DEFAULT_IMAGE_VERSION};window.opener.document.forms['{$PICKER_FORM}'].{$PICKER_FIELD}_view.src='{$XT_WEB_ROOT}download.php?file_id={$SELECTED.id}&file_version={$DEFAULT_IMAGE_VERSION}';window.close();"><img src="{$XT_IMAGES}icons/check.png" title="{"Pick this image"|translate}" alt="{"Pick this image"|translate}" /></a>
                {/if}
        </div>
        {get_config assign="imageVersions" name="imageversions"}

        <div style="display:block; width:100%; margin-top: 5px;">
        <table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color: #FFFFFF; border: 1px solid #DDDDDD;">
        {foreach from=$imageVersions item=versionName key=versionID}
            <tr>
                <td style="padding: 5px; border-bottom: 1px solid #DDDDDD; width: 16px;">
                {if $smarty.request.tinymce == 1}
                <a href="javascript:window.opener.document.forms['{$PICKER_FORM}'].width.value='';window.opener.document.forms['{$PICKER_FORM}'].height.value='';window.opener.document.forms['{$PICKER_FORM}'].src.value='{$XT_WEB_ROOT}download.php?file_id={$SELECTED.id}&file_version={$versionID}';window.opener.getImageData();window.close();"><img src="{$XT_IMAGES}icons/check.png" title="{"Pick this image"|translate}" alt="{"Pick this image"|translate}" /></a>
                {else}
                <a href="javascript:window.opener.document.forms['{$PICKER_FORM}'].{$PICKER_FIELD}.value={$SELECTED.id};window.opener.document.forms['{$PICKER_FORM}'].{$PICKER_FIELD}_version.value={$versionID};window.opener.document.forms['{$PICKER_FORM}'].{$PICKER_FIELD}_view.src='{$XT_WEB_ROOT}download.php?file_id={$SELECTED.id}&file_version={$versionID}';window.close();"><img src="{$XT_IMAGES}icons/check.png" title="{"Pick this image"|translate}" alt="{"Pick this image"|translate}" /></a>
                {/if}
                </td>
                <td style="padding: 5px; border-bottom: 1px solid #DDDDDD;">{$versionName}</td>
            </tr>
        {/foreach}
        </table>
        </div>
      {/if}
      {if $SELECTED.type == 2}
        <div style="border: 1px solid #DDDDDD; padding: 3px; float:left;">
        <object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=5,0,0,0" width="120">
            <param name="movie" value="{$XT_WEB_ROOT}download.php?file_id={$SELECTED.id}" />
            <param name="quality" value="high" />
            <embed src="{$XT_WEB_ROOT}download.php?file_id={$SELECTED.id}" quality="high" width="160" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" /></embed>
        </object></div>
        <br />
        {if $smarty.request.tinymce!=1}
        <a href="javascript:window.opener.document.forms['{$PICKER_FORM}'].{$PICKER_FIELD}.value={$SELECTED.id};window.opener.document.forms['{$PICKER_FORM}'].{$PICKER_FIELD}_version.value='embed';window.opener.document.forms['{$PICKER_FORM}'].{$PICKER_FIELD}_view.src='{$XT_WEB_ROOT}download.php?file_id={$SELECTED.id}&file_version=embed';window.close();"><img src="{$XT_IMAGES}icons/check.png" title="{"Pick this image"|translate}" alt="{"Pick this image"|translate}" /></a>
      	{/if}
     {/if}
   <table cellspacing="0" cellpadding="0" width="100%" style="height: 100%; background-color: #FFFFFF; border: 1px solid #DDDDDD;margin-top: 5px;">
   	<tr>
    	<td valign="top" valign="top">
    		<form method="POST" name="picker_edit">
			<table cellspacing="0" cellpadding="0" width="100%">
			  <tr>
			   <td class="left">{"name"|translate}</td>
			   <td class="right"><input type="text" name="x{$BASEID}_Ftitle" value="{$SELECTED.title|htmlspecialchars}" size="20"></td>
			  </tr>
			  <tr>
			   <td class="left">{"description"|translate}</td>
			   <td class="right">{toggle_editor id="Fdescription"}
			   <textarea id="x{$BASEID}_Fdescription" name="x{$BASEID}_Fdescription" cols="20" rows="4">{$SELECTED.description}</textarea></td>
			  </tr>
			  <tr>
			   <td class="left">{"Keywords"|translate}</td>
			   <td class="right">
			   <textarea name="x{$BASEID}_Fkeywords" cols="20" rows="2">{$SELECTED.keywords}</textarea></td>
			  </tr>
			  <tr>
			   <td class="left">&nbsp;</td>
			   <td class="right"><input type="button" name="xyz" value="{"Save"|translate}" onclick="document.forms['picker_edit'].submit();"></td>
			  </tr>
			</table>
			{include file="includes/editor.tpl"}
			<input type="hidden" name="x{$BASEID}_action" value="saveFilePicker" />
			<input type="hidden" name="x{$BASEID}_open" />
			<input type="hidden" name="x{$BASEID}_file_id" value="{$SELECTED.id}"/>
			<input type="hidden" name="x{$BASEID}_filename" value="{$SELECTED.filename}"/>
			<input type="hidden" name="x{$BASEID}_node_id" />
			<input type="hidden" name="x{$BASEID}_node_pid" />
			<input type="hidden" name="x{$BASEID}_node_perm" />
			<input type="hidden" name="x{$BASEID}_position" />
			<input type="hidden" name="x{$BASEID}_save_lang" value="{$ACTIVE_LANG}" />
			<input type="hidden" name="x{$BASEID}_order_by" value="{$ORDER_BY}" />
			<input type="hidden" name="x{$BASEID}_order_by_dir" value="{$ORDER_BY_DIR}"/>
			<input type="hidden" name="x{$BASEID}_active" value="{$ANODE.active}" />
			<input type="hidden" name="x{$BASEID}_image" value="{$ANODE.image}" />
			<input type="hidden" name="x{$BASEID}_image_version" value="{$ANODE.image_version}" />
			</form>
			<input type="hidden" name="x{$BASEID}_Fimage" value="{$SELECTED.image}" />
			<input type="hidden" name="x{$BASEID}_Ftype" value="{$SELECTED.type}" />
		</td>
     </tr>
   </table>
  {/if}
     </td>
    </tr>
   </table>
  </td>
 </tr>
</table>


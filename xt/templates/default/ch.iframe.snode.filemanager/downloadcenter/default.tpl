{if $FOLDER.active}
<form method="POST" name="dc">
<h1>{$FOLDER.title}</h1>
{$FOLDER.description}<br /><br />
<div>
	<div style="width:30%; float: left;">
		<b>{"Available categories"|livetranslate}</b><br /><br />
		 <table cellspacing="0" cellpadding="0" width="100%" summary="{"Available categories"|translate}">
		 {foreach from=$CATEGORIES item=CATEGORY name=C}
		  {if $CATEGORY.active == "1"}
		  <tr>
		   <td style="padding: 5px 0px; padding-left: {$CATEGORY.level*20-$CATEGORY.start_level*20-20}px;">
		    <table cellspacing="0" cellpadding="0" width="100%">
		     <tr>
		      <td style="width: 16px; padding-right: 5px;"><img src="{$XT_IMAGES}icons/explorer/folder_closed.png" alt="" /></td>
		      <td>
		       {if $CATEGORY.id == $smarty.request.x240_node_id || ($smarty.request.x240_node_id == "" && $smarty.foreach.C.first) }<b>{/if}
		       <a href="javascript:document.forms['dc'].x{$BASEID}_node_id.value='{$CATEGORY.id}';document.forms['dc'].submit();">{$CATEGORY.title}</a>
		       {if $CATEGORY.id == $smarty.request.x240_node_id || ($smarty.request.x240_node_id == "" && $smarty.foreach.C.first) }<b>{/if}
		      </td>
		    </table>
		   </td>
		  </tr>
		  {/if}
		 {/foreach}
		 </table>
	</div>
<div style="width: 69%;float:right;">
 <b>{"Available downloads for this category"|livetranslate}</b><br /><br />
 <table cellspacing="0" cellpadding="0" width="100%" summary="{"Available downloads for this category"|translate}">
 {foreach from=$FILES item=FILE}
 <tr>
  <td style="padding: 5px 0px;">
   &raquo;&nbsp;<a href="download.php?file_id={$FILE.id}&file_name={$FILE.filename}" target="{$TARGET}">{$FILE.title}</a>
  </td>
  <td style="padding: 5px 0px;" align="right">{$FILE.upload_date|date_format:"%d.%m.%Y %H:%M"}<br/>{$FILE.filesize|format_filesize}</td>
 </tr>
 <tr>
  <td style="padding: 5px 0px; padding-top: 0px;" colspan="2">
   {$FILE.description}
  </td>
 </tr>
 {/foreach}
 </table>
</div>
</div>
<input type="hidden" name="x{$BASEID}_node_id" />
</form>
{/if}

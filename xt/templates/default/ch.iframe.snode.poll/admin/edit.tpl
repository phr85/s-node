{literal}
<script type="text/javascript"><!--
if(window.parent.frames['master']){
    window.parent.frames['master'].document.forms[1].x{/literal}{$BASEID}_lang_filter.value='{$ACTIVE_LANG}';{literal}
    window.parent.frames['master'].document.forms[1].submit();
}
//-->
</script>
{/literal}
<form method="post" name="edit" action="{$smarty.server.PHP_SELF}?TPL={$TPL}" onSubmit="window.document.forms['edit'].x{$BASEID}_yoffset.value= window.pageYOffset;">
{include file="ch.iframe.snode.poll/admin/hiddenValues.tpl"}
	<table cellspacing="0" cellpadding="0" width="100%">
	{if $ERRORS != ""}
	<tr>
		<td class="error_msg" colspan="4">
			{foreach name="errors" from=$ERRORS key="error" item="ERROR"}
				{$ERROR}
			{/foreach}
		</td>
	</tr>
	{/if}
		<tr>
			<td class="view_header" colspan="2"><span class="title_light">{"Edit Poll"|translate}:</span> <span class="title">{$DATA.poll.title}</span></td>
		</tr>
		<tr>
			<td class="view_separator" colspan="4"><img src="{$XT_IMAGES}spacer.gif" alt="" /></td>
		</tr>
		<tr>
			<td colspan="2">{include file="includes/buttons.tpl" data=$BUTTONS withouthidden="1"}</td>
		</tr>
		<tr>
			<td class="left">{"Status"|translate}</td>
			<td class="right">
				<input type="hidden" name="x{$BASEID}_published" value="{$DATA.poll.published}" />
				{if $DATA.poll.active}
					{actionIcon 
			        action="deactivatePollEdit"
			        icon="active.png"
			        form="edit"
			        perm="statuschange"
			        id=$DATA.poll.id
			        title="Deactivate this poll"}
			    {else}
			       	{actionIcon 
			        action="activatePollEdit"
			        icon="inactive.png"
			        form="edit"
			        perm="statuschange"
			        id=$DATA.poll.id
			        title="Activate this poll"}
			    {/if}
				{if $DATA.poll.lang == "de"}
					<img src="{$XT_IMAGES}lang/de.png" alt="Deutsch" />
				{elseif $DATA.poll.lang == "fr"}
					<img src="{$XT_IMAGES}lang/fr.png" alt="Français" />
				{elseif $DATA.poll.lang == "en"}
					<img src="{$XT_IMAGES}lang/en.png" alt="English" />
				{/if}
			</td>
		</tr>
		<tr>
			<td class="left">{"Title"|translate}</td>
			<td class="right"><input type="text" name="x{$BASEID}_title" size="42" value="{$DATA.poll.title|htmlspecialchars}" /></td>
		</tr>
		<tr>
			<td class="left">{"Description"|translate}</td>
			<td class="right">{toggle_editor id="description"}<textarea id="x{$BASEID}_description" name="x{$BASEID}_description" rows="4" cols="40">{$DATA.poll.description}</textarea></td>
		</tr>
		<tr>
			<td class="view_header" colspan="2"><span class="title">{"Hauptbild"|translate}</span></td>
		</tr>
		<tr>
			<td class="view_separator" colspan="4"><img src="{$XT_IMAGES}spacer.gif" alt="" /></td>
		</tr>
		 <tr>
		  <td class="left">{"Image"|translate}<a name="image" /></td>
		  <td class="right">{actionPopUp
		    icon="pick_photo.png"
		    title="Pick an image"|translate
		    TPL=$IMAGE_PICKER_TPL
		    BASEID=$IMAGE_PICKER_BASE_ID
		    fieldBaseId=$BASEID
		    fieldName="image"
		    form="edit"
		    name="picker"
		    anker="image"
		}{
		   actionIcon
		       action="deleteImage"
		       icon="delete.png"
		       form="edit"
		       yoffset=1
		       title="Delete Image"
		       ask="Are you sure that you want to delete this image relation"
		       id=$DATA.poll.id
		   }<br />
		   {if $DATA.poll.image < 1}
		   <img name="x{$BASEID}_image_view" src="{$XT_IMAGES}spacer.gif" alt="" />
		   {else}
		   {if $DATA.poll.image_type == 2}
		   <div style="border: 1px solid black; margin-top: 5px; width: 200px;">
		   <object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=5,0,0,0" width="200" height="{math equation=200/(width/height) width=$DATA.width height=$DATA.height}">
		   <param name="movie" value="{$XT_WEB_ROOT}download.php?file_id={$DATA.poll.image}" />
		   <param name="quality" value="high" />
		   <embed src="{$XT_WEB_ROOT}download.php?file_id={$DATA.image}" quality="high" width="200" height="{math equation=200/(width/height) width=$DATA.width height=$DATA.height}" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" /></embed>
		   </object>
		   </div>
		   <img name="x{$BASEID}_image_view" src="{$XT_IMAGES}spacer.gif" alt="" />
		   {else}
		   <img name="x{$BASEID}_image_view" src="{$XT_WEB_ROOT}download.php?file_id={$DATA.poll.image}&amp;file_version=1" alt="" class="picked" />
		   {/if}
		   {/if}
			<input type="hidden" name="x{$BASEID}_image" value="{$DATA.poll.image}" />
			<input type="hidden" name="x{$BASEID}_image_version" value="" />
			<input type="hidden" name="x{$BASEID}_image_zoom" value="" />
		  </td>
		 </tr>
		 <tr>
		  <td class="left">{"Zoom Popup available?"|translate}</td>
		  <td class="right"><input type="checkbox" name="x{$BASEID}_image_zoom" value="1" {if $DATA.poll.image_zoom == 1}checked{/if} />
		  </td>
		 </tr>
		<tr>
			<td class="view_header" colspan="2"><span class="title">{"Einstellungen"|translate}</span></td>
		</tr>
		<tr>
			<td class="view_separator" colspan="4"><img src="{$XT_IMAGES}spacer.gif" alt="" /></td>
		</tr>
		<tr>
			<td class="left">{"Multiple"|translate}</td>
			<td class="right"><input type="checkbox" name="x{$BASEID}_multiple" value="1" {if $DATA.poll.multiple == 1}checked="checked"{/if} /></td>
		</tr>
		<tr>
		  	<td class="left">{"Date"|translate} (d.m.y)</td>
		  	<td class="right"><input type="text" name="x{$BASEID}_polldate_str" id="x{$BASEID}_polldate_str" value="{$DATA.poll.date|date_format:"%d.%m.%Y"}" size="12" />
		    	{include file="includes/widgets/datepicker.tpl" relative="polldate_str"}
				<input type="hidden" name="x{$BASEID}_polldate" value="{$DATA.date}" />
		 	</td>
		</tr>
		<tr>
			<td class="view_header" colspan="2"><span class="title">{"Auswahloptionen"|translate}</span></td>
		</tr>
		<tr>
			<td class="view_separator" colspan="4"><img src="{$XT_IMAGES}spacer.gif" alt="" /></td>
		</tr>
	</table>
{include file="includes/buttons.tpl" data=$BUTTONS_POLL_OPTIONS withouthidden="1" yoffset=true}
{foreach name="option_foreach" from=$DATA.answers key="option" item="ANSWER" name="answers"}
{assign var="number" value=$smarty.foreach.answers.iteration}

<p style="padding: 0px 0px 0px 15px; font-weight: bold;">Option {$number}{
		   actionIcon
		       action="deleteAnswer"
		       icon="delete.png"
		       form="edit"
		       yoffset=1
		       title="Delete Action"
		       ask="Are you sure that you want to delete this answer relation"
		       answer_id=$ANSWER.id
      		   poll_id=$ANSWER.poll_id
		   }</p>
<table cellspacing="0" cellpadding="0" width="100%">
<tr>
	<td class="view_separator" colspan="4"><img src="{$XT_IMAGES}spacer.gif" alt="" /></td>
</tr>
 <tr>
  <td class="left">{"Option_title"|translate}</td>
  <td class="right"><input type="text" name="x{$BASEID}_option_title[{$ANSWER.id}]" id="x{$BASEID}_option{$ANSWER.id}_title" value="{$ANSWER.title}" size="42" /></td>
 </tr>
 <tr>
  <td class="left">{"Option_position"|translate}</td>
  <td class="right">{$ANSWER.position}
  {if !$smarty.foreach.answers.last}{actionIcon
      action="changePosition"
      icon="explorer/arrow_down_green.png"
      direction="moveDown"
      answer_id=$ANSWER.id
      poll_id=$ANSWER.poll_id
      actual_position=$ANSWER.position
      form="edit"
      yoffset=true
      title="Insert element after this element"
  }{/if}{if !$smarty.foreach.answers.first}{actionIcon
      action="changePosition"
      icon="explorer/arrow_up_green.png"
      direction="moveUp"
      answer_id=$ANSWER.id
      poll_id=$ANSWER.poll_id
      actual_position=$ANSWER.position
      form="edit"
      yoffset=true
      title="Insert element before this element"
  }
  {/if}</td>
 </tr>
 <tr>
 <td colspan="4">&nbsp;</td>
   </tr>
</table>
{/foreach}
</form>

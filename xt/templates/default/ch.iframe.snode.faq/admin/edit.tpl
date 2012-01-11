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
{include file="includes/lang_selector_simple.tpl" form="edit"}
	<table cellspacing="0" cellpadding="0" width="100%">
	{if $xt1400_ERRORS != ""}
	<tr>
		<td class="error_msg" colspan="4">
			{foreach name="errors" from=$xt1400_ERRORS key="error" item="ERROR"}
				{$ERROR}
			{/foreach}
		</td>
	</tr>
	{/if}
		<tr>
			<td class="view_header" colspan="2"><span class="title_light">{"Edit Faq"|translate}:</span> <span class="title">{$xt1400_DATA.faq.title}</span></td>
		</tr>
		<tr>
			<td class="view_separator" colspan="4"><img src="{$XT_IMAGES}spacer.gif" alt="" /></td>
		</tr>
		<tr>
			<td colspan="2">{include file="includes/buttons.tpl" data=$xt1400_BUTTONS_FAQ withouthidden="1"}</td>
		</tr>
		<tr>
			<td class="left">{"Status"|translate}</td>
			<td class="right">
				<input type="hidden" name="x{$BASEID}_published" value="{$xt1400_DATA.faq.published}" />
				{if $xt1400_DATA.faq.active}
					{actionIcon 
			        action="deactivateFaqEdit"
			        icon="active.png"
			        form="edit"
			        perm="statuschange"
			        id=$xt1400_DATA.faq.id
			        title="Deactivate this faq"}
			    {else}
			       	{actionIcon 
			        action="activateFaqEdit"
			        icon="inactive.png"
			        form="edit"
			        perm="statuschange"
			        id=$xt1400_DATA.faq.id
			        title="Activate this faq"}
			    {/if}
				{if $xt1400_DATA.faq.lang == "de"}
					<img src="{$XT_IMAGES}lang/de.png" alt="Deutsch" />
				{elseif $xt1400_DATA.faq.lang == "fr"}
					<img src="{$XT_IMAGES}lang/fr.png" alt="Français" />
				{elseif $xt1400_DATA.faq.lang == "en"}
					<img src="{$XT_IMAGES}lang/en.png" alt="English" />
				{/if}
			</td>
		</tr>
		<tr>
			<td class="left">{"Title"|translate}</td>
			<td class="right"><input type="text" name="x{$BASEID}_title" size="42" value="{$xt1400_DATA.faq.title|htmlspecialchars}" /></td>
		</tr>
		<tr>
			<td class="left">{"Description"|translate}</td>
			<td class="right">{toggle_editor id="description"}<textarea id="x{$BASEID}_description" name="x{$BASEID}_description" rows="4" cols="40">{$xt1400_DATA.faq.description}</textarea></td>
		</tr>
		 <tr>
		  <td class="left">{"Questioner Name"|translate}</td>
		  <td class="right">{$xt1400_DATA.faq.questioner}</td>
		 </tr>
		 <tr>
		  <td class="left">{"Questioner Mail"|translate}</td>
		  <td class="right"><input type="text" name="x{$BASEID}_questioner_mail" size="42" value="{$xt1400_DATA.faq.questioner_mail}" /></td>
		 </tr>
		<tr>
		  	<td class="left">{"Date"|translate} (d.m.y)</td>
		  	<td class="right"><input type="text" name="x{$BASEID}_faqdate_str" id="x{$BASEID}_faqdate_str" value="{$xt1400_DATA.faq.date|date_format:"%d.%m.%Y"}" size="12" />
		    	{include file="includes/widgets/datepicker.tpl" relative="faqdate_str"}
				<input type="hidden" name="x{$BASEID}_faqdate" value="{$xt1400_DATA.date}" />
		 	</td>
		</tr>
		<tr>
			<td class="view_header" colspan="2"><span class="title">{"Answer"|translate}</span></td>
		</tr>
		<tr>
			<td class="view_separator" colspan="4"><img src="{$XT_IMAGES}spacer.gif" alt="" /></td>
		</tr>
		<tr>
			<td class="left">{"Is Answered"|translate}</td>
			<td class="right"><img src="{$XT_IMAGES}/icons/{if $xt1400_DATA.faq.is_answered == 1}status_1.gif{else}status_0.gif{/if}" title="{if $xt1400_DATA.faq.is_answered == 1}{"answered"|translate}{else}{"not answered"|translate}{/if}" alt="{if $xt1400_DATA.faq.is_answered == 1}{"answered"|translate}{else}{"not answered"|translate}{/if}" /></td>
		</tr>
		<tr>
			<td class="left">{"Answeraddress"|translate}</td>
			<td class="right">
				<select name="x{$BASEID}_answer_address" id="x{$BASEID}_answer_address">
				{foreach name="answeraddresses" from=$xt1400_DATA.answeraddresses item="ADDRESS"}
					<option {if $ADDRESS == $xt1400_DATA.faq.answer_address}selected="selected"{/if}>{$ADDRESS}</option>
				{/foreach}
				</select>
			</td>
		</tr>
		 <tr>
		  <td class="left">{"Answer Name"|translate}</td>
		  <td class="right"><input type="text" name="x{$BASEID}_answer_name" size="42" value="{$xt1400_DATA.faq.answer_name}" /></td>
		 </tr>
		<tr>
			<td class="left">{"Answer Title"|translate}</td>
			<td class="right"><input type="text" name="x{$BASEID}_answer_title" size="42" value="{$xt1400_DATA.faq.answer_title|htmlspecialchars}" /></td>
		</tr>
		<tr>
			<td class="left">{"Answer"|translate}</td>
			<td class="right">{toggle_editor id="answer"}<textarea name="x{$BASEID}_answer" id="x{$BASEID}_answer" rows="4" cols="40">{$xt1400_DATA.faq.answer}</textarea></td>
		</tr>
	</table>
	<div class="toolbar">
		{if $xt1400_DATA.faq.is_answered}
			 {actionIcon action="sendAnswer" icon="mail_forward.png" label="Re-send answer over mail" form="edit" yoffset=1 title="Send Answer Again" 
			 ask="Are you sure that you want to answer this question again?"
			 id=$xt1400_DATA.faq.id}
		{else}
			{actionIcon action="sendAnswer" icon="mail_forward.png" label="Send answer over mail" form="edit" yoffset=1 title="Send Answer"
			 id=$xt1400_DATA.faq.id}
		{/if}
	</div>
	<table cellspacing="0" cellpadding="0" width="100%">
		<tr>
			<td class="view_header" colspan="2"><span class="title">{"Main image"|translate}</span></td>
		</tr>
		<tr>
			<td class="view_separator" colspan="4"><img src="{$XT_IMAGES}spacer.gif" alt="" /></td>
		</tr>
		 <tr>
		  <td class="left">{"Image"|translate}<a name="image" /></td>
		  <td class="right">{actionPopUp
		    icon="pick_photo.png"
		    title="Pick an image"|translate
		    TPL=$xt1400_IMAGE_PICKER_TPL
		    BASEID=$xt1400_IMAGE_PICKER_BASE_ID
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
		       id=$xt1400_DATA.faq.id
		   }<br />
		   {if $xt1400_DATA.faq.image < 1}
		   <img name="x{$BASEID}_image_view" src="{$XT_IMAGES}spacer.gif" alt="" />
		   {else}
		   {if $xt1400_DATA.faq.image_type == 2}
		   <div style="border: 1px solid black; margin-top: 5px; width: 200px;">
		   <object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=5,0,0,0" width="200" height="{math equation=200/(width/height) width=$xt1400_DATA.width height=$xt1400_DATA.height}">
		   <param name="faq" value="{$XT_WEB_ROOT}download.php?file_id={$xt1400_DATA.faq.image}" />
		   <param name="quality" value="high" />
		   <embed src="{$XT_WEB_ROOT}download.php?file_id={$xt1400_DATA.image}" quality="high" width="200" height="{math equation=200/(width/height) width=$xt1400_DATA.width height=$xt1400_DATA.height}" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" /></embed>
		   </object>
		   </div>
		   <img name="x{$BASEID}_image_view" src="{$XT_IMAGES}spacer.gif" alt="" />
		   {else}
		   <img name="x{$BASEID}_image_view" src="{$XT_WEB_ROOT}download.php?file_id={$xt1400_DATA.faq.image}&amp;file_version=1" alt="" class="picked" />
		   {/if}
		   {/if}
			<input type="hidden" name="x{$BASEID}_image" value="{$xt1400_DATA.faq.image}" />
			<input type="hidden" name="x{$BASEID}_image_version" value="" />
			<input type="hidden" name="x{$BASEID}_image_zoom" value="" />
		  </td>
		 </tr>
		 <tr>
		  <td class="left">{"Zoom Popup available?"|translate}</td>
		  <td class="right"><input type="checkbox" name="x{$BASEID}_image_zoom" value="1" {if $xt1400_DATA.faq.image_zoom == 1}checked{/if} />
		  </td>
		 </tr>
		 </tr>
		<tr>
			<td class="view_header" colspan="2"><span class="title">{"Categories"|translate}</span></td>
		</tr>
		<tr>
			<td class="view_separator" colspan="4"><img src="{$XT_IMAGES}spacer.gif" alt="" /></td>
		</tr>
   <td class="left">{"Category tree"|translate}</td>
   <td class="right"><iframe src="/index.php?TPL=1401&amp;ctype={$BASEID}&amp;cid={$xt1400_DATA.faq.id}&amp;ctitle={$xt1400_DATA.faq.title}&amp;mod=tree" style="width:360px; height:180px"></iframe></td>
 </tr>
	</table>
	{include file="includes/editor.tpl"}
	{include file="ch.iframe.snode.faq/admin/hiddenValues.tpl"}
</form>
<br clear="all" />
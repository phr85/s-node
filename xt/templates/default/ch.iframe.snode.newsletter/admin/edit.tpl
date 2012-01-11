<script language="JavaScript"><!--
window.parent.frames['master'].document.forms[1].submit();
//-->
</script>
<form method="post" action="{$smarty.server.PHP_SELF}?TPL={$TPL}" name="edit">
<h2><span class="light">{"Newsletter"|translate}:</span> {$NEWSLETTER.title}</h2>
{if $NEWSLETTER.sent_date > 0}
<h3 style="padding-left:25px;">{$NEWSLETTER.sent_date|date_format:"%A, %B %e, %Y"}</h3>
{else}
<h3 style="padding-left:25px;">{"Newsletter unsent"|translate}</h3>
{/if}
{include file="includes/buttons.tpl" data=$BUTTONS}
<table cellspacing="0" cellpadding="0" width="100%">
 <tr>
  <td class="left">{"Title"|translate}</td>
  <td class="right"><input type="text" name="x{$BASEID}_title" size="42" value="{$NEWSLETTER.title}" /></td>
 </tr>
 <tr>
  <td class="left">{"Sender Name"|translate}</td>
  <td class="right"><input type="text" name="x{$BASEID}_sender_name" size="42" value="{$NEWSLETTER.sender_name}" /></td>
 </tr>
 <tr>
  <td class="left">{"Sender E-Mail"|translate}</td>
  <td class="right"><input type="text" name="x{$BASEID}_sender_email" size="42" value="{$NEWSLETTER.sender_email}" /></td>
 </tr>
 <tr>
  <td class="left">{"Description"|translate}</td>
  <td class="right">{toggle_editor id="description"}
  <textarea id="x{$BASEID}_description" name="x{$BASEID}_description" rows="6" cols="50">{$NEWSLETTER.description}</textarea></td>
 </tr>
 <tr>
  <td class="left">{"Categories"|translate}</td>
  <td class="right">

   {foreach from=$CATEGORIES item=CATEGORY}
   <input type="checkbox" name="x{$BASEID}_categories[]" value="{$CATEGORY.id}" {if $CATEGORY.selected}checked="checked"{/if} />
    {$CATEGORY.title}<br />
   {/foreach}

  </td>
 </tr>
<tr>
  <td class="left">{"Language"|translate}</td>
  <td class="right">
    <select name="x{$BASEID}_lang">
   {foreach from=$LANGS key=KEY item=LANG}
    <option value="{$KEY}" {if $KEY == $NEWSLETTER.lang}selected{/if}>{$LANG.name|translate}</option>
   {/foreach}
   </select>
  </td>
 </tr>
  <tr>
  <td class="left">{"Template"|translate}</td>
  <td class="right">
    {if $NEWSLETTER.template != ""}
        {assign var=SEND_TPL value=$NEWSLETTER.template}
    {else}
        {assign var=SEND_TPL value="default.tpl"}
    {/if}
    <select name="x{$BASEID}_template">
        {foreach from=$TEMPLATES item=TEMPLATE}
            <option value="{$TEMPLATE}" {if $SEND_TPL == $TEMPLATE}selected="selected"{/if}>{$TEMPLATE}</option>
        {/foreach}
    </select>
  </td>
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
       newsletter_id=$NEWSLETTER.id
   }<br />
   {if $NEWSLETTER.image < 1}
   <img name="x{$BASEID}_image_view" src="{$XT_IMAGES}spacer.gif" alt="" />
   {else}
   {if $NEWSLETTER.image_type == 2}
   <div style="border: 1px solid black; margin-top: 5px; width: 200px;">
   <object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=5,0,0,0" width="200">
   <param name="movie" value="{$XT_WEB_ROOT}download.php?file_id={$NEWSLETTER.image}" />
   <param name="quality" value="high" />
   <embed src="{$XT_WEB_ROOT}download.php?file_id={$NEWSLETTER.image}" quality="high" width="200" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" /></embed>
   </object>
   </div>
   <img name="x{$BASEID}_image_view" src="{$XT_IMAGES}spacer.gif" alt="" />
   {else}
   <img name="x{$BASEID}_image_view" src="{$XT_WEB_ROOT}download.php?file_id={$NEWSLETTER.image}&amp;file_version=1" alt="" class="picked" />
   {/if}
   {/if}
  </td>
 </tr>
</table>
<input type="hidden" name="x{$BASEID}_image" value="{$NEWSLETTER.image}" />
<input type="hidden" name="x{$BASEID}_image_version" value="{$NEWSLETTER.image_version}" />
{if $DISPLAY.relations}
<table cellspacing="0" cellpadding="0" width="100%">
 <tr>
  <td class="view_header" colspan="2">
   <span class="title"> {"Relations"|translate}</span>
  </td>
 </tr>
 <tr>
 <tr>
  <td class="view_separator" colspan="2"><img src="{$XT_IMAGES}spacer.gif" alt="" /></td>
 </tr>
 {include file="includes/widgets/relations.tpl" cid=$NEWSLETTER.id ctitle=$NEWSLETTER.title}
</table>
{/if}
{if $DISPLAY.properties}
<table cellspacing="0" cellpadding="0" width="100%">
 {include file="includes/widgets/properties.tpl" content_id=$NEWSLETTER.id content_type=$BASEID formname="edit" universal=true lang=$ACTIVE_LANG}
</table>
{/if}
<h2>{"Content (HTML)"|translate}</h2>
{include file="includes/buttons.tpl" data=$SECOND_BUTTONS withouthidden="1" yoffset=true}
<table cellspacing="0" cellpadding="0" width="100%">
 <tr>
  <td class="right">{toggle_editor id="content_html"}
  <textarea id="x{$BASEID}_content_html" name="x{$BASEID}_content_html" rows="10" cols="75">{$NEWSLETTER.content_html}</textarea></td>
 </tr>
</table>


{include file="ch.iframe.snode.newsletter/admin/edit_chapters.tpl"}


<h2>{"Content (Plain)"|translate}</h2>
{include file="includes/buttons.tpl" data=$SECOND_BUTTONS withouthidden="1" yoffset=true}
<table cellspacing="0" cellpadding="0" width="100%">
 <tr>
  <td class="right">
  <textarea id="x{$BASEID}_content_plain" name="x{$BASEID}_content_plain" rows="10" cols="75">{$NEWSLETTER.content_plain}</textarea>
  </td>
 </tr>
</table>



<h2>{"Header - Footer"|translate}</h2>
{include file="includes/buttons.tpl" data=$SECOND_BUTTONS withouthidden="1" yoffset=true}
<table cellspacing="0" cellpadding="0" width="100%">
<tr>
<td class="left">{"header"|translate}</td>
<td class="right">{toggle_editor id="header"}
<textarea id="x{$BASEID}_header" name="x{$BASEID}_header" rows="5" cols="45">{$NEWSLETTER.header}</textarea>
</td>
</tr>
<tr>
<td class="left">{"header_plain"|translate}</td>
<td class="right">
<textarea id="x{$BASEID}_header_plain" name="x{$BASEID}_header_plain" rows="3" cols="45">{$NEWSLETTER.header_plain}</textarea>
</td>
</tr>
<tr>
<td class="left">{"footer"|translate}</td>
<td class="right">{toggle_editor id="footer"}
<textarea id="x{$BASEID}_footer" name="x{$BASEID}_footer" rows="5" cols="45">{$NEWSLETTER.footer}</textarea>
</td>
</tr>
<tr>
<td class="left">{"footer_plain"|translate}</td>
<td class="right">
<textarea id="x{$BASEID}_footer_plain" name="x{$BASEID}_footer_plain" rows="3" cols="45">{$NEWSLETTER.footer_plain}</textarea>
</td>
</tr>
</table>
{include file="includes/buttons.tpl" data=$SEND_BUTTONS withouthidden="1"}
{include file="ch.iframe.snode.newsletter/admin/hiddenValues.tpl"}
{include file="ch.iframe.snode.newsletter/admin/edit_editor.tpl"}
</form>

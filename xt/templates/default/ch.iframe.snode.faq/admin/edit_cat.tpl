{literal}
<script type="text/javascript"><!--
if(window.parent.frames['master']){
	window.parent.frames['master'].document.forms[1].submit();
}
//-->
</script>
{/literal}

<form method="post" name="edit" action="{$smarty.server.PHP_SELF}?TPL={$TPL}" onSubmit="window.document.forms['edit'].x{$BASEID}_yoffset.value= window.pageYOffset;">
{include file="includes/lang_selector_simple.tpl" form="edit"}
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
			<td class="view_header" colspan="2"><span class="title_light">{"Edit Faq Category"|translate}:</span> <span class="title">{$DATA.faq.title}</span></td>
		</tr>
		<tr>
			<td class="view_separator" colspan="4"><img src="{$XT_IMAGES}spacer.gif" alt="" /></td>
		</tr>
		<tr>
			<td colspan="2">{include file="includes/buttons.tpl" data=$xt1400_BUTTONS_FAQ_CAT withouthidden="1" yoffset=true}</td>
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
   <td class="left">{"public"|translate}</td>
   <td class="right">
   <input type="checkbox" name="x{$BASEID}_public" value="1" {if $xt1400_DATA.faq.public == 1} checked="checked" {/if} />{"public"|translate}</td>
  </tr>
	</table>
	{include file="includes/editor.tpl"}
	{include file="ch.iframe.snode.faq/admin/hiddenValues.tpl"}
<input type="hidden" name="x{$BASEID}_cat_id" value="{$xt1400_DATA.faq.node_id}" />
</form>
<br clear="all" />
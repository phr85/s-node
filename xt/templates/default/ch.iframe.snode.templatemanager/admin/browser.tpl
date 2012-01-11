<form method="POST" name="browser">
{include file="includes/buttons.tpl" data=$BROWSER_BUTTONS}
<table cellspacing="0" cellpadding="0" width="100%">
 {foreach from=$FOLDERS item=FOLDER}
 <tr class="{cycle values=row_a,row_b}">
  <td class="button" style="width: 16px;"><a href="javascript:document.forms[0].x{$BASEID}_open.value={$FOLDER.id};document.forms[0].submit();window.parent.frames['master'].document.forms['o'].x{$BASEID}_open.value={$FOLDER.id};window.parent.frames['master'].document.forms['o'].submit();"><img src="{$XT_IMAGES}icons/explorer/folder_closed.png" alt="" /></a></td>
  <td class="row" colspan="2"><a href="javascript:document.forms[0].x{$BASEID}_open.value={$FOLDER.id};document.forms[0].submit();window.parent.frames['master'].document.forms['o'].x{$BASEID}_open.value={$FOLDER.id};window.parent.frames['master'].document.forms['o'].submit();">{$FOLDER.title}</a>&nbsp;</td>
 </tr>
 {/foreach}
 {foreach from=$FAQS item=FAQ}
 <tr class="{cycle values=row_a,row_b}">
  <td class="button" style="width: 16px;"><img src="{$XT_IMAGES}icons/document.png" alt="" /></td>
  <td class="row" width="250"><a href="javascript:window.parent.frames['slave1'].document.forms[0].x{$BASEID}_action.value='viewArticle';window.parent.frames['slave1'].document.forms[0].x{$BASEID}_article_id.value='{$FAQ.article_id}';window.parent.frames['slave1'].document.forms[0].submit();">{$FAQ.title}</a></td>
  <td class="button" align="right"><a href="{$smarty.server.PHP_SELF}?TPL=658&x{$BASEID}_faq_id={$FAQ.id}"><img src="{$XT_IMAGES}icons/view.png" alt="" class="icon" /></a>{
  actionIcon
        action="editArticle"
        icon="pencil.png"
        form="0"
        article_id=$FAQ.article_id
        node_pid=$OPEN
        node_perm="editArticles"
        target="slave1"
        title="Edit this FAQ article"
  }{
  actionIcon
        action="deleteArticle"
        icon="delete.png"
        form="browser"
        article_id=$FAQ.article_id
        node_pid=$OPEN
        node_perm="deleteArticles"
        title="Delete this FAQ"
        ask="Are you sure you want to delete this FAQ?"
  }</td>
 </tr>
 {/foreach}
</table>
<input type="hidden" name="x{$BASEID}_open" />
<input type="hidden" name="x{$BASEID}_article_id" />
<input type="hidden" name="x{$BASEID}_node_id" value="{$OPEN}" />
<input type="hidden" name="x{$BASEID}_node_pid" />
</form>

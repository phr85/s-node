<form action="{$smarty.server.REQUEST_URI}#postComment" method="post" name="comment_comments">
{foreach from=$xt7600_comments.data item=COMMENT}
<div class="comment level{$COMMENT.level}">
<div class="comment_head">{$COMMENT.name}</div>
<div class="comment_date">{$COMMENT.c_date|date_format}</div>
<div class="comment_body">
{$COMMENT.comment|nl2br}
</div>
<div class="comment_footer"><a href="#postComment" onclick="javascript:window.document.forms['comment_comments'].x{$BASEID}_comment_id.value={$COMMENT.id};" > {"answer this"|livetranslate}</a>
{if "moderate"|permcheck}
    {actionIcon action="deleteComment" icon=delete.png perm=modereate form=comment_comments comment_id=$COMMENT.id}
    {if $COMMENT.active == 1}
    {actionIcon action="deactivateComment" icon=active.png perm=modereate form=comment_comments comment_id=$COMMENT.id}
    {else}
    {actionIcon action="activateComment" icon=inactive.png perm=modereate form=comment_comments comment_id=$COMMENT.id}
    {/if}
{/if}
</div>

</div>
{/foreach}
<a name="postComment">&nbsp;</a>
{if $xt7600_comments.noinsert == true}
<div class="formsublabel">&nbsp;</div>
<div class="formsublabel"><span style="color:red;">{"An error occured. Please check your input."|livetranslate}</span></div>
{/if}
<div id="form_container">
<div class="form_separator">{"post comment"|livetranslate}</div>

<div class="formsublabel">{"email address"|livetranslate}:</div>
<input class="field" type="text" size="24" name="x{$BASEID}_email" value="{$xt7600_comments.user.email}" />
<br clear="all" />
<div class="formsublabel">{"name"|livetranslate}:</div>
<input class="field" type="text" size="24" name="x{$BASEID}_name" value="{$xt7600_comments.user.name}" />
<br clear="all" />

<div class="formsublabel">{"comment"|livetranslate}:</div>
<textarea name="x{$BASEID}_comment" class="commenttxt">{$xt7600_comments.comment}
</textarea>
<br clear="all" />
{if $xt7600_comments.captcha == true}
<div class="formsublabel">&nbsp;</div>
{include file="includes/widgets/captcha.tpl" name="captcha_comment_`$xt7600_comments.metadata.content_type`_`$xt7600_comments.metadata.content_id`"}
{/if}
<br clear="all" />
<div class="formsublabel">&nbsp;</div>
<input type="submit" name="x{$BASEID}_submit" value="{'send comment'|translate}" />
</div>


<input type="hidden" name="x{$BASEID}_pseudoaction" value="user_postComment" />
<input type="hidden" name="x{$BASEID}_action" value="" />
<input type="hidden" name="x{$BASEID}_comment_id" value="{$xt7600_comments.metadata.comment_id}" />
<input type="hidden" name="x{$BASEID}_content_id" value="{$xt7600_comments.metadata.content_id}" />
</form>
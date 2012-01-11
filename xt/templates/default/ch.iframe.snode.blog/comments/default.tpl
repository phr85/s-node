<form action="{$smarty.server.REQUEST_URI}" method="post" name="comment_comments">
{foreach from=$xt7600_comments.data item=COMMENT}
<div class="comment">
{if $COMMENT.website != ""}
<div class="comment_head"><a href="http://{$COMMENT.website}" rel="nofollow">{$COMMENT.name}</a></div>
{else}
<div class="comment_head">{$COMMENT.name}</div>
{/if}
<div class="comment_date">{$COMMENT.c_date|date_format}</div>
<div class="comment_body">
{xt_gravatar email=$COMMENT.email size="40" assign="gravatarUrl"}
{if $gravatarUrl != ""}
	<img class="left" title="{$COMMENT.name}" src="{$gravatarUrl}">
{/if}
{$COMMENT.comment|nl2br}
<br clear="all" />
</div>
</div>
{/foreach}
{if $xt7600_comments.noinsert == true}
<div class="formsublabel">&nbsp;</div>
<div class="formsublabel"><span style="color:red;">{"Please check your input."|livetranslate}</span></div>
{/if}
<div id="form_container">
<div class="form_separator">{"post comment"|livetranslate}</div>

<div class="formsublabel">{"email address"|livetranslate}:</div>
<input class="field" type="text" size="24" name="x{$BASEID}_email" value="{$xt7600_comments.user.email}" />
<br clear="all" />

<div class="formsublabel">{"name"|livetranslate}:</div>
<input class="field" type="text" size="24" name="x{$BASEID}_name" value="{$xt7600_comments.user.name}" />
<br clear="all" />

<div class="formsublabel">{"website"|livetranslate}:</div>
<input class="field" type="text" size="24" name="x{$BASEID}_website" value="{$xt7600_comments.user.website}" />
<br clear="all" />

<div class="formsublabel">{"comment"|livetranslate}:</div>
<textarea name="x{$BASEID}_comment" class="commenttxt">{if $xt7600_comments.comment != ""}{$xt7600_comments.comment}{/if}</textarea>

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
<input type="hidden" name="x{$BASEID}_content_id" value="{$xt7600_comments.metadata.content_id}" />
</form>
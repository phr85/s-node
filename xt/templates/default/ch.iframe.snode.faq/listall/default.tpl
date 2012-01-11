{literal}
	<!-- jQuery needs to be included in <head></head>!!! <!-->
	<script>
	jQuery(document).ready(function(){
		jQuery("dd:not(:first)").hide();
		jQuery("dt a").click(function(){
			jQuery("dd:visible").slideUp("slow");
			jQuery(this).parent().next().slideDown("slow");
			return false;
		});
	});
	</script>
{/literal}
<div class="faqListItem">
	<img src="{$XT_IMAGES}icons/big/folder.png" alt="Folder" class="questionIcon"/><h2>{$xt1400_selected.title}</h2>
{if sizeof($xt1400_items) > 0}
	{if sizeof($xt1400_items) > 0}<img src="{$XT_IMAGES}icons/big/help.png" alt="Folder" class="questionIcon"/><h2>{"All Faq Items"|translate}</h2>{/if}
	<div class="faqWrapperFlatListall">
		{foreach from=$xt1400_items item="FAQ_ITEM" name="FAQ_ITEM"}
		    {if $FAQ_ITEM.title != ''}
					<dt style="clear: left"><a href="{$smarty.server.PHP_SELF}?TPL={$xt1400_viewer_tpl}&amp;x{$BASEID}_faq_id={$FAQ_ITEM.id}"><img class="iconFolder" src="{$XT_IMAGES}icons/big/help.png" alt="Folder" />&nbsp;{$FAQ_ITEM.title}</a></dt>
		  	{/if}
		  	 {if $FAQ_ITEM.description}
		  	 	<dd>
				<ul>
					<li>
						<p class="question">{$FAQ_ITEM.description}</p>
						{if $FAQ_ITEM.answer_title}
						<br />
						<br />
						<p class="answer_title"><img class="iconFolder" src="{$XT_IMAGES}icons/big/information.png" alt="Information" />&nbsp;<b>{$FAQ_ITEM.answer_title}</b></p>
						<p class="question">{$FAQ_ITEM.answer}</p>
						{/if}
					</li>
		  	 	</ul>
				</dd>
		  	 {/if}
		{/foreach}
	</div>
{else}
<br />
{"There are currently no faq items available"|livetranslate}
{/if}
</div>
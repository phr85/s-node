{xt_count_comments assign="COMMENTS_COUNT" content_type="270"}
{foreach from=$DATA item=NEWS}
		<div class="newslistitem">
			<div class="newsDateLeft">
				{$NEWS.date|date_format:"%B %Y"}<br />
				<span style="font-size: 24px;">{$NEWS.date|date_format:"%d"}</span>
			</div>	
		  <h2 class="newslisttitle">{$NEWS.title}</h2>
			<h3 class="newslistsubtitle">
			{if $NEWS.subtitle != ""}{$NEWS.subtitle} -{/if}
		  </h3>
		  {if $NEWS.introduction != ""}
			<div class="newslist">
					  {image
							id=$NEWS.image
							version=2
							title=$NEWS.img_description
							alt=$NEWS.img_alt
							class="newslist"
					   }
				 {$NEWS.introduction}
				  {if $LINK2DETAILS == 'yes'}
					  <a href="{$smarty.server.PHP_SELF}?TPL={$TARGET_TPL}&amp;x270_id={$NEWS.id}">> read more</a>
				  {/if}
				  <br /><a href="{$smarty.server.PHP_SELF}?TPL={$TARGET_TPL}&amp;x270_id={$NEWS.id}">{assign var='LOOP_COUNT' value='0'}{foreach from=$COMMENTS_COUNT item=COUNT key=CONTENT_ID}{if $CONTENT_ID == $NEWS.id}{assign var='LOOP_COUNT' value=$COUNT}{/if}{/foreach}{$LOOP_COUNT} Kommentare</a>
				 <br clear="all" />
			</div>
		  {/if}
			{subplugin package="ch.iframe.snode.ratings" module="viewer" style="default.tpl" content_type=270 content_id=$NEWS.id}
		</div>
{/foreach}

<div id="rssIconView">
	<a href="/index.php?TPL=10071">Abonnieren Sie unseren Feed <img src="/images/blogcms/rss_icon.jpg" alt="image" width="28" height="37" /></a>
</div>
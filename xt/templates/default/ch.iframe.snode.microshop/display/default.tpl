{XT_load_css file="ch.iframe.snode.microshop.css"}
{$DISPLAY.text_head}
<div id="wrapper">
	<form action="/index.php?TPL={$TPL}" method="post">
		{if $CURRENTPAGE < $ORDERPOS}
		<input type="image" class="submit" name="x9200_submit" id="x9200_submit" value="submit" src="/images/ch.iframe.snode.microshop/next.png"  />
		{/if}
		<div id="content" style="background: transparent url(/download.php?file_id={$CONTENT.image}&amp;file_version=orig) no-repeat;">
			{include file=$CONTENT.style}
		</div>
		{if $CURRENTPAGE <= $ORDERPOS}
		<div id="nav">
			<ul>
				{foreach from=$NAV item=NAV name=N}
				<li class="{if $NAV.position == $CURRENTPAGE}active{/if}{if $NAV.position == $CURRENTPAGE-1}prev{/if}{if $smarty.foreach.N.last} last{/if}">
					{if $NAV.position > $CURRENTPAGE}
					<span>{if $smarty.foreach.N.last}Lieferadresse{else}{$NAV.title}{/if}</span>
					{else}
					<a href="/index.php?TPL={$TPL}&amp;x9200_page={$NAV.position}">{if $smarty.foreach.N.last}Lieferadresse{else}{$NAV.title}{/if}</a>
					{/if}
				</li>
				{/foreach}
			</ul>
		</div>
		{/if}
		<input type="hidden" name="x9200_page" id="x9200_page" value="{$CURRENTPAGE}" />
	</form>
</div>
{$DISPLAY.text_footer}
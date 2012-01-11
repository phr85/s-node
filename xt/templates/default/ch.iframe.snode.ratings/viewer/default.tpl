<p>
<i>{"Rating"|translate}</i>
<br />
	<div id="ratings{$xt8400_content_id}" class="demo">
{if $xt8400_viewer.curval lt 1}
	<img src="{$XT_IMAGES}ratings/star_empty.gif" alt="0/5" />
{elseif $xt8400_viewer.curval gt 0.9 AND $xt8400_viewer.curval lt 1.5}
	<img src="{$XT_IMAGES}ratings/star_filled_1.gif" alt="1/5" />
{elseif $xt8400_viewer.curval gt 1.4 AND $xt8400_viewer.curval lt 2.5}
	<img src="{$XT_IMAGES}ratings/star_filled_2.gif" alt="2/5" />
{elseif $xt8400_viewer.curval gt 2.4 AND $xt8400_viewer.curval lt 3.5}
	<img src="{$XT_IMAGES}ratings/star_filled_3.gif" alt="3/5" />
{elseif $xt8400_viewer.curval gt 3.4 AND $xt8400_viewer.curval lt 4.5}
	<img src="{$XT_IMAGES}ratings/star_filled_4.gif" alt="4/5" />
{elseif $xt8400_viewer.curval gt 4.4}
	<img src="{$XT_IMAGES}ratings/star_filled_5.gif" alt="5/5" />
{/if}
	</div>
</p>
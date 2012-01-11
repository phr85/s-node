<div class="faqListItem">
	<img src="{$XT_IMAGES}icons/big/folder.png" alt="Folder" class="questionIcon"/><h2>{$xt1400_selected.title}</h2>
{if sizeof($xt1400_category_list) > 0 or sizeof($xt1400_items) > 0}
	<div class="faqWrapperFlat">
		{if !$xt1400_category_list}
			<br />{"No categories, please select an Faq item below"|livetranslate}
		{/if}
		{foreach from=$xt1400_category_list item="CATEGORY" name="FAQ"}
		    <div class="folderItem">
				{if $CATEGORY.title != ''}
			  		<p class="categoryTitle">
				  		<a href="{$smarty.server.PHP_SELF}?TPL={$TPL}&amp;x{$BASEID}_cat_id={$CATEGORY.id}">
				  			<img class="iconFolder" src="{$XT_IMAGES}icons/folder.png" alt="Folder" />&nbsp;{$CATEGORY.title}
				  		</a>
				  	</p>
			  	{/if}
			  	{if $CATEGORY.description}
			  	 	<p class="categoryDescription">{$CATEGORY.description}</p>
			  	{/if}
			 </div>
		{/foreach}
	</div>
	<br clear="all" />
	<br />
	{if sizeof($xt1400_items) > 0}<img src="{$XT_IMAGES}icons/big/help.png" alt="Folder" class="questionIcon"/><h2>{"Faq Items"|translate}</h2>{/if}
	<div class="faqWrapperFlat">
		{foreach from=$xt1400_items item="FAQ_ITEM" name="FAQ_ITEM"}
		    <div class="folderItem">
				{if $FAQ_ITEM.title != ''}
			  		<p class="categoryTitle">
				  		<a href="{$smarty.server.PHP_SELF}?TPL={$xt1400_viewer_tpl}&amp;x{$BASEID}_faq_id={$FAQ_ITEM.id}">
				  			<img class="iconFolder" src="{$XT_IMAGES}icons/help.png" alt="Folder" />&nbsp;{$FAQ_ITEM.title}
				  		</a>
				  	</p>
			  	{/if}
			  	 {if $FAQ_ITEM.description}
			  	 	<p class="categoryDescription">{$FAQ_ITEM.description|truncate:120:""} [...] <a href="{$smarty.server.PHP_SELF}?TPL={$xt1400_viewer_tpl}&amp;x{$BASEID}_faq_id={$FAQ_ITEM.id}">&raquo;&raquo;</a></p>
			  	 {/if}
			 </div>
		 	<br clear="all" />
		{/foreach}
	</div>
{else}
<br />
{"There are currently no categories and faq items available in this category"|livetranslate}
{/if}
<br clear="all" /><br clear="all" />
{if $xt1400_selected.id != 0}
	<a href="{$smarty.server.PHP_SELF}?TPL={$TPL}&amp;x{$BASEID}_cat_id={$xt1400_selected.id}">{"Go back to the previous category"|livetranslate}</a>
{/if}
</div>
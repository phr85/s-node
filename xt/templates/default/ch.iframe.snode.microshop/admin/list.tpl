<form id="XT_list" method="post" name="list" action="{$smarty.server.PHP_SELF}?TPL={$TPL}">
<div class="toolbar">
{actionIcon icon="scroll_add.png" label="add new display" action="addNewDisplay" form="list" title="add new display"}<br />
</div>
{foreach from=$LIST.display item="DISPLAY"}
	<div class="display {if !$DISPLAY.active}inactivedisplay{/if}">
		<div class="title">{actionLink text=$DISPLAY.title display_id=$DISPLAY.id form="list"}</div>
		
		
		{if $DISPLAY.id == $LIST.meta.current_display}
		<div class="options">
		{if $DISPLAY.active}{actionIcon icon="active.png" action="deactivateDisplay" display_id=$DISPLAY.id title="deactivate display" form="list"}{else}{actionIcon icon="inactive.png" action="activateDisplay" display_id=$DISPLAY.id title="activate display" form="list"}{/if}
		{actionIcon icon="pencil.png" action="OpenView_editDisplay" target="slave1"  form="0" display_id=$DISPLAY.id title="edit Display"}
		{actionIcon icon="column-chart.png" action="OpenView_orderHistory" target="slave1"  form="0" display_id=$DISPLAY.id title="Show order history"}
		{if !$DISPLAY.active}{actionIcon icon="delete.png" action="deleteDisplay" ask="all Data will be lost" form="list" display_id=$DISPLAY.id title="Delete display"}{/if}
		</div>
		
			{foreach from=$LIST.pages item="PAGE"}
			<div class="element{if !$PAGE.active} inactive{/if}">
			{* TEXT *}
			{if $PAGE.type == 0}
				{actionIcon icon="document.png" label=$PAGE.title action="OpenView_editTextpage" form=0 target="slave1" page_id=$PAGE.foreign_id title="edit Textpage"}
				<div class="rightopt">
					{strip}
						{if !$PAGE.locked}{if $PAGE.active}{actionIcon icon="active.png" action="deactivatePage" page_id=$PAGE.id title="deactivate page" form="list"}{else}{actionIcon icon="inactive.png" action="activatePage" page_id=$PAGE.id title="activate page" form="list"}{/if}{/if}
						{actionIcon icon="arrow_up.gif" action="movePageUp" form="list" page_id=$PAGE.id title="move up"}
						{actionIcon icon="arrow_down.gif" action="movePageDown" form="list" page_id=$PAGE.id title="move down"}
						{if !$PAGE.active && !$PAGE.locked}{actionIcon icon="delete.png" action="deletePage" form="list" page_id=$PAGE.id title="delete page"}{/if}
					{/strip}
				</div>
			{/if}
			{* PRODUCT *}
			{if $PAGE.type == 1}
				{actionIcon icon="table.png" label=$PAGE.title action="OpenView_editProductpage" form=0 target="slave1" page_id=$PAGE.foreign_id title="edit Textpage"}
				<div class="rightopt">
					{strip}
						{if !$PAGE.locked}{if $PAGE.active}{actionIcon icon="active.png" action="deactivatePage" page_id=$PAGE.id title="deactivate page" form="list"}{else}{actionIcon icon="inactive.png" action="activatePage" page_id=$PAGE.id title="activate page" form="list"}{/if}{/if}
						{actionIcon icon="arrow_up.gif" action="movePageUp" form="list" page_id=$PAGE.id title="move up"}
						{actionIcon icon="arrow_down.gif" action="movePageDown" form="list" page_id=$PAGE.id title="move down"}
						{if !$PAGE.active && !$PAGE.locked}{actionIcon icon="delete.png" action="deletePage" form="list" page_id=$PAGE.id title="delete page"}{/if}
					{/strip}
				</div>
			{/if}
			
			{* ORDER *}
			{if $PAGE.type == 2}
			<img src="/images/icons/shoppingcart_full.png" alt="" />{"shop page"|translate}
				<div class="rightopt">
					{strip}
						{actionIcon icon="arrow_up.gif" action="movePageUp" form="list" page_id=$PAGE.id title="move up"}
						{actionIcon icon="arrow_down.gif" action="movePageDown" form="list" page_id=$PAGE.id title="move down"}
					{/strip}
				</div>
			{/if}
			
			</div>
			{/foreach}
			<div class="options">
			{actionIcon icon="table_sql_add.png" label="add product page" action="addProductPage" form="list" display_id=$DISPLAY.id title="add product page"}<br />
			{actionIcon icon="document_add.png" label="add text page" action="addTextPage" form="list" display_id=$DISPLAY.id title="add text page"}
			</div>
		{/if}
	</div>
{/foreach}
{include file="ch.iframe.snode.microshop/admin/hidden_values.tpl"}
</form>
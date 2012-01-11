<form action="{$smarty.server.PHP_SELF}?TPL={get_param param='editor_tpl'}" method="post" name="userlist">
<input type="hidden" name="x{$BASEID}_id" value="" />
<input type="hidden" name="x{$BASEID}_action" value="" />

<div class="user_edit_box">
<b>{"Recipes in edit"|translate}</b> <br />
<div class="user_edit_title">
<div class="xx_px">{"ID"|translate}</div>
<div class="mm_px">{"title"|translate}</div>
<div class="c_px">{"c_date"|translate}</div>
<div class="c_px">{"m_date"|translate}</div>
</div>

{foreach from=$DATA item="RECIPE"}
<div class="user_edit">
<div class="xx_px">{$RECIPE.id}</div>
<div class="mm_px">{actionLink action="dummy" class="ulist" form="userlist" text=$RECIPE.title|default:"----" id=$RECIPE.id}&nbsp;</div>
<div class="c_px">{$RECIPE.c_date|date_format:"%d.%m.%y"}</div>
<div class="c_px">{$RECIPE.m_date|date_format:"%d.%m.%y"}</div>
</div>
{/foreach}
<br clear="all" />
{actionIcon 
 action="UserCreateRecipe" 
 title="createRecipe"
 label="createRecipe"
 icon="add.png" form="userlist"}
</div>
</form>
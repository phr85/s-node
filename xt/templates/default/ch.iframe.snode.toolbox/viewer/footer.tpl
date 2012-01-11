<!-- footer toolbox-->
<div style="padding:5px;">
<a href="#" onclick="window.open('{$smarty.server.PHP_SELF}?TPL={$SOURCEEDIT_TPL}&amp;x{$SOURCEEDIT_BASEID}_tpl_id={$TPL}','','scrollbars=1,width=900,height=600,top=200,left=200');"><img src="{$XT_IMAGES}icons/wrench.png" alt="{'Edit Source'|translate}" /> {'Edit Source'|translate}</a><br/>
<a href="#" onclick="livetranslatehandler();"><img src="{$XT_IMAGES}icons/text.png" alt="{'Livetranslate'|translate}" id="lt"/> {'Turn on/off live translation'|translate}</a><br/>
<a href="{$smarty.server.REQUEST_URI}&amp;outline_plugins=true"><img src="{$XT_IMAGES}icons/text_find.png" alt="{'Outline plugins'|translate}"/> {'Outline plugins'|translate}</a>
<script type="text/javascript">getlivetranslatestate();</script>
</div>
</div>
<!-- /footer toolbox-->
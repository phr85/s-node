{literal}
<style type="text/css">
@import url("{/literal}{$XT_STYLES}{literal}installer/default.css");
#introduction {
    width: 100%;
}
</style>
{/literal}
<form method="post" name="slave1">
 <div id="content">
 <h1>{$TPL_REAL_TITLE}</h1>
 <p id="introduction">{"intro_text"|translate}</p>
 </div>
 <input type="hidden" name="x{$BASEID}_id" value="">
 <input type="hidden" name="x{$BASEID}_virtual_id" value="">
 <input type="hidden" name="x{$BASEID}_action" value="">
</form>
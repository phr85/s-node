{XT_load_css file="formmanager.css"}

<form method="post" action="{$smarty.server.PHP_SELF}?TPL={$TPL}">
    <div id="form_container">
        <div class="form_separator">
            {"password forgotten"|livetranslate}
        </div>
        <div class="formsublabel">
            {"Your e-mail address"|livetranslate}:
        </div>
        <div class="formelement">
            <input class="field" type="text" size="30" name="x{$BASEID}_email" />
        </div>
        <div class="formsublabel clear">
            &nbsp;
        </div>
        <div class="formelement">
            <input type="submit" name="x{$BASEID}_submit" value="{'Receive new password'|translate}" />
        </div>
    </div>
</form>
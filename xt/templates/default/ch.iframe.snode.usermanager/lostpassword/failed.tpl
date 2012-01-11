{XT_load_css file="formmanager.css"}

<form method="post" action="{$smarty.server.PHP_SELF}?TPL={$TPL}">
    <div id="form_container">
        <div class="form_separator clear">
            {"password forgotten"|livetranslate}
        </div>
        <div class="formsublabel">
            <b>{"There is no user with this e-mail address"|translate}</b>
            <br />
            <br />
        </div>
        <div class="formsublabel clear">
        </div>
        <div class="formsublabel clear">
            {"Your e-mail address"|livetranslate}:
        </div>
        <div class="formelement">
            <input class="field" type="text" size="30S" name="x{$BASEID}_email" />
        </div>
        <div class="formsublabel clear">
            &nbsp;
        </div>
        <div class="formelement">
            <input type="submit" name="x{$BASEID}_submit" value="{'Receive new password'|translate}" />
        </div>
    </div>
</form>
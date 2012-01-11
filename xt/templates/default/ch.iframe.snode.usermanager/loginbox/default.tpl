{XT_load_css file="formmanager.css"}

{if $ERROR_MSG != ""}
    <span style="color:red;">
        {$ERROR_MSG|livetranslate}
    </span>
{/if}

<form method="post" action="{$smarty.server.PHP_SELF}?TPL={$TPL}">
    <div id="form_container">
        <div class="form_separator">
            {"Login"|livetranslate}
        </div>
        <div class="formlabel clear">
            <label class="label" for="{$FIELD_USERNAME}">{"Username"|translate}:</label>
        </div>
        <div class="formelement">
            <input class="field" type="text" id="{$FIELD_USERNAME}" name="{$FIELD_USERNAME}" size="19" />
        </div>
        <div class="formlabel clear">
            <label class="label" for="{$FIELD_PASSWORD}">{"Password"|translate}:</label>
        </div>
        <div class="formelement">
            <input class="field" type="password" id="{$FIELD_PASSWORD}" name="{$FIELD_PASSWORD}" size="19" />
        </div>
        <div class="formlabel clear">
            &nbsp;
        </div>
        <div class="formelement">
            <input class="field" type="submit" name="submit" value="{'Login'|translate}" />
        </div>
        <div class="formlabel clear">
            &nbsp;
        </div>
        <div class="formelement">
            &raquo; <a href="{$smarty.server.PHP_SELF}?TPL={$LOST_TPL}">{"password forgotten"|translate}?</a>
        </div>
    </div>
</form>
<br class="clear" />
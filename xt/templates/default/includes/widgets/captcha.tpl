{if $name == ""}
	{assign var="name" value="captcha_$TPL"}
{/if}
<div class="formsublabel">
    <img src="/captcha_image.php?name={$name}" alt="" id="{$name}"/><br />
    <a href="javascript:reload_captcha('{$name}');">{"relaod captcha"|translate}</a><br/>
    <label for="{$name}">{"Type the chars here"|livetranslate}:</label><br/>
    <input type="text" name="{$name}" value="" id="{$name}" />
</div>
{literal}
<script type="text/javascript" >
    //<![CDATA[
        function reload_captcha(name) {
            var jetzt = new Date();
             document.getElementById(name).src='/captcha_image.php?name=' + name + '&time=' + jetzt.getTime();
        }
    //]]>
</script>
{/literal}
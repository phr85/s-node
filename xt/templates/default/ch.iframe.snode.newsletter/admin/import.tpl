{literal}
<style type="text/css">

#introduction {
    width: 100%;
}
</style>
{/literal}
<form method="post" name="upload" enctype="multipart/form-data">
{include file="includes/buttons.tpl" data=$BUTTONS}
<div id="content">
<h1>{"Upload Import"|translate}</h1>
<p id="introduction">{"introduction"|translate}</p>
<br />

<input type="file" size="25" name="x{$BASEID}_file" value=""/>
<br />
<input type="checkbox" name="x{$BASEID}_ignoreunsubscribed" value="1" checked> {"Ignore unsubscribed addresses"|livetranslate}
</div>
</form>
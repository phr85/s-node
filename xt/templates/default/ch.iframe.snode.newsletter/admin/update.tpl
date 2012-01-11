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
<h1>{"Upload Update"|translate}</h1>
<p id="introduction">{"introduction_update"|translate}</p>
<br />

<input type="file" size="25" name="x{$BASEID}_file" value=""/>

</div>
</form>
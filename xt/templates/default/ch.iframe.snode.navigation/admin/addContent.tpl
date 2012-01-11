{literal}
<style type="text/css">
@import url("{/literal}{$XT_STYLES}{literal}installer/default.css");
#introduction {
    width: 100%;
}
</style>
{/literal}
<script language="JavaScript"><!--
window.parent.frames['master'].document.forms[1].x{$BASEID}_yoffset.value=window.parent.frames['master'].pageYOffset;
window.parent.frames['master'].document.forms[1].submit();
//-->
</script>
<form method="post" name="edit" action="{$smarty.server.PHP_SELF}?TPL={$TPL}">
<div id="content">
<h1>{"Contents wizard"|translate}</h1>
<p id="introduction">{"Please choose a standard module"|translate}</p><br />

<div style="padding: 10px; background-color: #6F86A5; margin-bottom: 10px;">
{foreach from=$MODULES[1] item=MOD}
<table cellspacing="0" cellpadding="0" width="100%">
 <tr>
  <td width="16" style="padding-right: 5px; padding-bottom: 3px;">
  <input type="radio" name="x{$BASEID}_module_id" value="{$MOD.package}-|-{$MOD.module}">
  </td>
  <td >
  <span style="color: black;">{$MOD.title}</span></td>
  </td>
 </tr>
</table>
{/foreach}
</div>

<div id="control" style="padding-left: 0px; margin-bottom: 10px; margin-top: 20px;">
<input type="submit" value="{"Weiter"|translate}" />
</div>

<p id="introduction">{"Or choose an advanced module"|translate}</p><br />

{foreach from=$NODES item=ENTRY name=N}
 {if $ENTRY.level == 2}
 {if !$smarty.foreach.N.first}</table>{/if}
 <table cellspacing="0" cellpadding="0" width="100%" style="background-color: #6F86A5;">
 {/if}
 <tr>
   <td>
    <table cellspacing="0" cellpadding="0" width="100%">
     <tr {if $ENTRY.level == 2}onclick="switchNode({$ENTRY.id});" onmouseover="this.style.backgroundColor='#91A8BD'" onmouseout="this.style.backgroundColor='#6F86A5'" style="cursor: hand; cursor: pointer;"{/if}>
      <td class="button" style="{if $ENTRY.level == 2}border-bottom: 1px solid #49678F;{else}border: 0px;{/if} padding-left: {$ENTRY.level*28-50}px; width: 1px;">
        <img src="{$XT_IMAGES}icons/cubes_blue.png" width="16" height="16" alt="{$ENTRY.title}" />
      </td>
      <td class="row" {if $ENTRY.level == 2}style="color: #FFFFFF; border-bottom: 1px solid #49678F; padding-left: 0px;"{else}style="color: #FFFFFF; border: 0px; padding-left: 0px;"{/if}>{$ENTRY.title}</td>
     </tr>
    </table>
    <div id="mods_{$ENTRY.id}" style="{if $ENTRY.level == 2}display: none;{/if}">
    {foreach from=$MODULES[$ENTRY.id] item=MOD}
    <table cellspacing="0" cellpadding="0" width="100%" style="background-color: #6F86A5;">
     <tr>
      <td class="button" style="border: 0px; padding-left: {$ENTRY.level*20-12}px; width: 20px;"><input type="radio" name="x{$BASEID}_module_id" value="{$MOD.package}-|-{$MOD.module}"></td>
      <td class="button" style="border: 0px; padding-left: 0px; width: 20px;"><img src="{$XT_IMAGES}icons/cube_yellow.png" /></td>
      <td>{$MOD.title}</td>
     </tr>
    </table>
    {/foreach}
    </div>
   </td>
  </tr>
  {if $ENTRY.level == 2}
  </table>
  <table cellspacing="0" cellpadding="0" width="100%" style="background-color: #6F86A5; display: none;" id="node_{$ENTRY.id}">{/if}

 {/foreach}
   <tr>
   <td>&nbsp;</td>
   </tr>
 </table>
</div>
<div id="control">
<input type="submit" value="{"Weiter"|translate}" />
</div>
<br />
<input type="hidden" name="x{$BASEID}_id" value="" />
<input type="hidden" name="x{$BASEID}_node_id" value="{$NODE_ID}" />
<input type="hidden" name="x{$BASEID}_node_pid" value="{$NODE_PID}" />
<input type="hidden" name="x{$BASEID}_mode" value="{$MODE}" />
<input type="hidden" name="x{$BASEID}_action" value="saveAddContent" />
<input type="hidden" name="x{$BASEID}_insert_pos" value="{$INSERT_POS}" />
<input type="hidden" name="x{$BASEID}_livetpl" value="{$LIVETPL}" />
<input type="hidden" name="TPL" value="{$TPL}" />
</form>
<script type="text/javascript"><!--
{literal}
var visible = Array();
function switchNode(nodeid){
    if(!visible[nodeid]){
        document.getElementById('node_' + nodeid).style.display = 'block';
        document.getElementById('node_' + nodeid).style.width = '100%';
        if(document.getElementById('mods_' + nodeid)){
            document.getElementById('mods_' + nodeid).style.display = 'block';
            document.getElementById('mods_' + nodeid).style.width = '100%';
        }
        visible[nodeid] = true;
    } else {
        document.getElementById('node_' + nodeid).style.display = 'none';
        if(document.getElementById('mods_' + nodeid)){
            document.getElementById('mods_' + nodeid).style.display = 'none';
        }
        visible[nodeid] = false;
    }
}
{/literal}
//-->
</script>
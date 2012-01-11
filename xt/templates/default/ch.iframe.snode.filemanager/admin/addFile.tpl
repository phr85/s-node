{literal}
<script language="JavaScript" type="text/javascript"><!--
window.parent.frames['slave2'].document.forms[0].submit();
//-->
</script>
{/literal}
<form method="post" name="uploadfile" enctype="multipart/form-data">
 <table cellpadding="0" cellspacing="0" width="100%">
  <tr>
   <td class="view_header" colspan="2">
    <span class="title">{"File upload"|translate}</span>
   </td>
  </tr>
  <tr>
   <td class="view_separator" colspan="2"><img src="{$XT_IMAGES}spacer.gif" alt="" /></td>
  </tr>
 </table>
 {include file="includes/buttons.tpl" data=$ADDFILE_BUTTONS}
 <table cellpadding="0" cellspacing="0" width="100%">
  <tr>
   <td class="left">{"Choose file"|translate}</td>
   <td class="right"><input type="file" name="file" size="34"></td>
  </tr>
  <tr>
   <td class="left">{"Available through search"|translate}</td>
   <td class="right"><input type="checkbox" name="x{$BASEID}_public" value="1"></td>
  </tr>
  <tr>
   <td class="left">{"Title"|translate}</td>
   <td class="right"><input type="text" name="x{$BASEID}_title" size="42" /></td>
  </tr>
  <tr>
   <td class="left">{"Description"|translate}</td>
   <td class="right">{toggle_editor id="description"}
   <textarea id="x{$BASEID}_description" name="x{$BASEID}_description" cols="65" rows="4"></textarea></td>
  </tr>
  
  
 <tr>
  <td class="left">{"Valid to Date"|translate} (d.m.y)</td>
  <td class="right">
  <input type="checkbox" id="validdate" name="x{$BASEID}_validity" value="enabled" {if $FILE.valid_date > 0}checked="checked" {/if} onclick="toggleDivByCheckbox('#validdate','#validdatebox');" /> Datei hat ein Ablaufdatum
  <div id="validdatebox" {if $FILE.valid_date == 0} style="display:none" {/if}>
  <input type="text" name="x{$BASEID}_valid_date_str" id="x{$BASEID}_valid_date_str" value="{if $FILE.valid_date > 0}{$FILE.valid_date|date_format:"%d.%m.%Y"}{/if}" size="12" />
    {include file="includes/widgets/datepicker.tpl" relative="valid_date_str"}
  <input type="hidden" name="x{$BASEID}_valid_date" value="{$FILE.valid_date}" /></div>
  </td>
 </tr>
<tr>
  <td class="left">{"Valid_from Date"|translate} (d.m.y)</td>
  <td class="right">
  <input type="checkbox" id="validfrom" name="x{$BASEID}_validity_from" value="enabled" {if $FILE.valid_from > 0}checked="checked" {/if} onclick="toggleDivByCheckbox('#validfrom','#validfrombox');" /> Datei hat ein "gültig ab" Datum
  <div id="validfrombox" {if $FILE.valid_from == 0} style="display:none" {/if}>
 <input type="text" name="x{$BASEID}_valid_from_str" id="x{$BASEID}_valid_from_str" value="{if $FILE.valid_from > 0}{$FILE.valid_from|date_format:"%d.%m.%Y"}{/if}" size="12" />
    {include file="includes/widgets/datepicker.tpl" relative="valid_from_str"}
  H:   <select name="x{$BASEID}_validity_from_hrs">
    <option value="0" {if $FILE.valid_from_hrs == 0}selected="selected"{/if}>0</option>
    <option value="1" {if $FILE.valid_from_hrs == 1}selected="selected"{/if}>1</option>
    <option value="2" {if $FILE.valid_from_hrs == 2}selected="selected"{/if}>2</option>
    <option value="3" {if $FILE.valid_from_hrs == 3}selected="selected"{/if}>3</option>
    <option value="4" {if $FILE.valid_from_hrs == 4}selected="selected"{/if}>4</option>
    <option value="5" {if $FILE.valid_from_hrs == 5}selected="selected"{/if}>5</option>
    <option value="6" {if $FILE.valid_from_hrs == 6}selected="selected"{/if}>6</option>
    <option value="7" {if $FILE.valid_from_hrs == 7}selected="selected"{/if}>7</option>
    <option value="8" {if $FILE.valid_from_hrs == 8}selected="selected"{/if}>8</option>
    <option value="9" {if $FILE.valid_from_hrs == 9}selected="selected"{/if}>9</option>
    <option value="10" {if $FILE.valid_from_hrs == 10}selected="selected"{/if}>10</option>
    <option value="11" {if $FILE.valid_from_hrs == 11}selected="selected"{/if}>11</option>
    <option value="12" {if $FILE.valid_from_hrs == 12}selected="selected"{/if}>12</option>
    <option value="13" {if $FILE.valid_from_hrs == 13}selected="selected"{/if}>13</option>
    <option value="14" {if $FILE.valid_from_hrs == 14}selected="selected"{/if}>14</option>
    <option value="15" {if $FILE.valid_from_hrs == 15}selected="selected"{/if}>15</option>
    <option value="16" {if $FILE.valid_from_hrs == 16}selected="selected"{/if}>16</option>
    <option value="17" {if $FILE.valid_from_hrs == 17}selected="selected"{/if}>17</option>
    <option value="18" {if $FILE.valid_from_hrs == 18}selected="selected"{/if}>18</option>
    <option value="19" {if $FILE.valid_from_hrs == 19}selected="selected"{/if}>19</option>
    <option value="20" {if $FILE.valid_from_hrs == 20}selected="selected"{/if}>20</option>
    <option value="21" {if $FILE.valid_from_hrs == 21}selected="selected"{/if}>21</option>
    <option value="22" {if $FILE.valid_from_hrs == 22}selected="selected"{/if}>22</option>
    <option value="23" {if $FILE.valid_from_hrs == 23}selected="selected"{/if}>23</option>
    </select>
  M: <select name="x{$BASEID}_validity_from_min">
    <option value="0" {if $FILE.valid_from_min == "00"}selected="selected"{/if}>0</option>
    <option value="5" {if $FILE.valid_from_min == "05"}selected="selected"{/if}>5</option>
    <option value="10" {if $FILE.valid_from_min == "10"}selected="selected"{/if}>10</option>
    <option value="15" {if $FILE.valid_from_min == "15"}selected="selected"{/if}>15</option>
    <option value="20" {if $FILE.valid_from_min == "20"}selected="selected"{/if}>20</option>
    <option value="25" {if $FILE.valid_from_min == "25"}selected="selected"{/if}>25</option>
    <option value="30" {if $FILE.valid_from_min == "30"}selected="selected"{/if}>30</option>
    <option value="35" {if $FILE.valid_from_min == "35"}selected="selected"{/if}>35</option>
    <option value="40" {if $FILE.valid_from_min == "40"}selected="selected"{/if}>40</option>
    <option value="45" {if $FILE.valid_from_min == "45"}selected="selected"{/if}>45</option>
    <option value="50" {if $FILE.valid_from_min == "50"}selected="selected"{/if}>50</option>
    <option value="55" {if $FILE.valid_from_min == "55"}selected="selected"{/if}>55</option>
    </select>
    
  <input type="hidden" name="x{$BASEID}_valid_from" value="{$FILE.valid_from}" /></div>
  </td>
 </tr>

  
  <tr>
   <td class="left">{"Keywords"|translate}</td>
   <td class="right"><textarea name="x{$BASEID}_keywords" cols="65" rows="4"></textarea></td>
  </tr>
 </table>
 <input type="hidden" name="x{$BASEID}_node_pid">
 <input type="hidden" name="x{$BASEID}_node_id">
 <input type="hidden" name="x{$BASEID}_node_action">
 <input type="hidden" name="x{$BASEID}_position">
 <input type="hidden" name="x{$BASEID}_file_id">
 {include file="includes/editor.tpl"}
</form>
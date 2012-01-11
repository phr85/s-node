<form method="POST" name="searchform">
{include file="includes/buttons.tpl" data=$CREATE_BUTTONS}
<table cellpadding="0" cellspacing="0" width="100%">
 <tr>
  <td class="table_header" colspan="2">{"Create a new task"|translate}</td>
 </tr>
 <tr>
  <td class="left">{"Subject"|translate}</td>
  <td class="right"><input type="text" name="x{$BASEID}_title" size="42"></td>
 </tr>
 <tr>
  <td class="left">{"Receiver"|translate}</td>
  <td class="right"><input type="text" name="x{$BASEID}_receiver" size="42"></td>
 </tr>
 <tr>
  <td class="left">{"Priority"|translate}</td>
  <td class="right">
   <select name="x{$BASEID}_priority">
    <option value="0">{"Very low"|translate}</option>
    <option value="1">{"Low"|translate}</option>
    <option value="2" selected>{"Medium"|translate}</option>
    <option value="3">{"High"|translate}</option>
    <option value="4">{"Very high"|translate}</option>
   </select>
  </td>
 </tr>
 {$EDITFORM}
 <tr>
  <td class="left">{"Job description"|translate}</td>
  <td class="right"><textarea name="x{$BASEID}_text" cols="50" rows="8"></textarea></td>
 </tr>
 <tr>
  <td class="left">{"Has to be done until"|translate}</td>
  <td class="right">
   <select name="x{$BASEID}_day">
   {dayselector}
   </select>
   <select name="x{$BASEID}_month">
    <option value="1">{"January"|translate}</option>
    <option value="2">{"February"|translate}</option>
    <option value="3">{"March"|translate}</option>
    <option value="4">{"April"|translate}</option>
    <option value="5">{"May"|translate}</option>
    <option value="6">{"June"|translate}</option>
    <option value="7">{"July"|translate}</option>
    <option value="8">{"August"|translate}</option>
    <option value="9">{"September"|translate}</option>
    <option value="10">{"October"|translate}</option>
    <option value="11">{"November"|translate}</option>
    <option value="12">{"December"|translate}</option>
   </select>
   <select name="x{$BASEID}_year">
   {yearselector}
   </select>
   <select name="x{$BASEID}_hour">
    <option>01</option>
    <option>02</option>
    <option>03</option>
    <option>04</option>
    <option>05</option>
    <option>06</option>
    <option>07</option>
    <option>08</option>
    <option>09</option>
    <option>10</option>
    <option>11</option>
    <option>12</option>
    <option>13</option>
    <option>14</option>
    <option>15</option>
    <option>16</option>
    <option>17</option>
    <option>18</option>
    <option>19</option>
    <option>20</option>
    <option>21</option>
    <option>22</option>
    <option>23</option>
    <option>24</option>
   </select>&nbsp;:
   <select name="x{$BASEID}_minute">
    <option>00</option>
    <option>15</option>
    <option>30</option>
    <option>45</option>
   </select>
  </td>
 </tr>
 <tr>
  <td class="left">{"Recurring task"|translate}</td>
  <td class="right"><input type="checkbox" name="x{$BASEID}_recurring"></td>
 </tr>
 <tr>
  <td class="left">{"Maximum work time"|translate}</td>
  <td class="right">
   <input type="text" size="4" name="x{$BASEID}_max_duration">
   <select name="x{$BASEID}_max_duration_mode">
    <option value="3600" {if $DATA.max_duration_mode == 3600}selected{/if}>{"Hours"|translate}</option>
    <option value="86400" {if $DATA.max_duration_mode == 86400}selected{/if}>{"Days"|translate}</option>
    <option value="2592000" {if $DATA.max_duration_mode == 2592000}selected{/if}>{"Month"|translate}</option>
    <option value="31536000" {if $DATA.max_duration_mode == 31536000}selected{/if}>{"Years"|translate}</option>
   </select>
  </td>
 </tr>
</table>
</form>
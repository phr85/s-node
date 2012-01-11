 
 <tr>
  <td class="create_left">{"Title"|translate}</td>
  <td class="create_right"><input type="text" size="42" name="x{$BASEID}_title" value="{$DATA.title}" onchange="window.parent.document.title = this.value" /></td>
 </tr>
 
 <tr>
  <td class="create_left">{"Subtitle"|translate}</td>
  <td class="create_right"><input type="text" size="42" name="x{$BASEID}_subtitle" value="{$DATA.subtitle}" /></td>
 </tr>
 
  <tr>
  <td class="create_left">{"Description"|translate}</td>
  <td class="create_right">
  <textarea id="x{$BASEID}_description" name="x{$BASEID}_description" rows="3" cols="40">{$DATA.description}</textarea>
  </td>
 </tr>
 
 <tr>
  <td class="create_left">{"Making"|translate}</td>
  <td class="create_right">
     <textarea id="x{$BASEID}_making" name="x{$BASEID}_making" rows="6" cols="65">{$DATA.making}</textarea>
  </td>
 </tr>
 
 <tr>
  <td class="create_left">{"portions"|translate}</td>
  <td class="create_right"><input type="text" size="6" name="x{$BASEID}_portions" value="{$DATA.portions}" /></td>
 </tr>
 <tr>
  <td class="create_left">{"kcal"|translate}</td>
  <td class="create_right"><input type="text" size="6" name="x{$BASEID}_kcal" value="{$DATA.kcal}" /></td>
 </tr>
 <tr>
  <td class="create_left">{"complexity"|translate}</td>
  <td class="create_right">
  <select name="x{$BASEID}_complexity">
      <option value="1"{if $DATA.complexity == 1}selected="selected"{/if}>{"complex1"|translate}</option>
      <option value="2"{if $DATA.complexity == 2}selected="selected"{/if}>{"complex2"|translate}</option>
      <option value="3"{if $DATA.complexity == 3}selected="selected"{/if}>{"complex3"|translate}</option>
      <option value="4"{if $DATA.complexity == 4}selected="selected"{/if}>{"complex4"|translate}</option>
      <option value="5"{if $DATA.complexity == 5}selected="selected"{/if}>{"complex5"|translate}</option>
    </select>
 </tr>
 <tr>
  <td class="create_left">{"duration"|translate}</td>
  <td class="create_right"><input type="text" size="6" name="x{$BASEID}_create_duration" value="{$DATA.create_duration}" /> {"create duration in min"|translate}
  <br />
  <br />
    <input type="text" size="6" name="x{$BASEID}_rest_duration" value="{$DATA.rest_duration}" /> {"rest duration in min"|translate}
  </td>
 </tr>

 <tr>
  <td class="create_left">{"ca_price"|translate}</td>
  <td class="create_right"><input type="text" size="12" name="x{$BASEID}_ca_price" value="{$DATA.ca_price}" /></td>
 </tr>

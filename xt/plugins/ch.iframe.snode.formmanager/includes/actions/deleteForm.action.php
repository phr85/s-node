<?php
// Get all elements for this form
$result = XT::query("SELECT element_id as id FROM " . $GLOBALS['plugin']->getTable("forms_elements") .  " WHERE form_id = " . $GLOBALS['plugin']->getValue("form_id"), __FILE__,__LINE__);
while($row = $result->FetchRow()){
   // Delete all values for each elements in this form
   XT::query("DELETE FROM " . $GLOBALS['plugin']->getTable("forms_elements_values") . " WHERE element_id = " . $row['id'],__FILE__,__LINE__);
   // Delete all data form each element in this form
   XT::query("DELETE FROM " . $GLOBALS['plugin']->getTable("forms_data") . " WHERE element_id = " . $row['id'],__FILE__,__LINE__);
}
// Delete the form
XT::query("DELETE FROM " . $GLOBALS['plugin']->getTable("forms") . " WHERE id = " . $GLOBALS['plugin']->getValue("form_id"),__FILE__,__LINE__);
// Delete all elements of the form
XT::query("DELETE FROM " . $GLOBALS['plugin']->getTable("forms_elements") . " WHERE form_id = " . $GLOBALS['plugin']->getValue("form_id"),__FILE__,__LINE__);
// Delete all actions of the form
XT::query("DELETE FROM " . $GLOBALS['plugin']->getTable("forms_actions") . " WHERE form_id = " . $GLOBALS['plugin']->getValue("form_id"),__FILE__,__LINE__);
// Delete all rules for the element
XT::query("DELETE FROM " . $GLOBALS['plugin']->getTable("forms_elements_rules") . " WHERE form_id = " . $GLOBALS['plugin']->getValue("form_id"),__FILE__,__LINE__);
// Delete all fillouts entries
XT::query("DELETE FROM " . $GLOBALS['plugin']->getTable("forms_fillouts") . " WHERE form_id = " . $GLOBALS['plugin']->getValue("form_id"),__FILE__,__LINE__);
// Delete all preactions for the form
XT::query("DELETE FROM " . $GLOBALS['plugin']->getTable("forms_preactions") . " WHERE form_id = " . $GLOBALS['plugin']->getValue("form_id"),__FILE__,__LINE__);

?>

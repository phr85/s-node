<?php
$values = XT::getValue('value');
//XT::printArray($values);

foreach ($values['product'] as $product) {
    exec(LICENSES . "make_licence.sh " .
    $values['firstname'] . " " .
    $values['lastname'] . " " .
    $product . " " .
    $values['date'] . " " .
    $values['userid'] . " " .
    $values['bundleid'] . " " .
    $values['domainname'] . " " .
    $values['limits'] . " ",$output );

    XT::assign('OUTPUT' , $output);

    XT::log('Licence ' .$product . ' created' ,__FILE__,__LINE__,XT_WARNING);

    $products[$product]=true;
}

XT::assign('SELECTEDPRODUCTS',$products);
?>
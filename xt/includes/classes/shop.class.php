<?php
class XT_Shop {
    
    function buy($article_id, $image_id, $image_version, $price, $quantity = 1){
        if($article_id > 0){
            $_SESSION['BASKET'][$article_id]['quantity'] = $quantity;
            $_SESSION['BASKET'][$article_id]['image_id'] = $image_id;
            $_SESSION['BASKET'][$article_id]['image_version'] = $image_version;
            $_SESSION['BASKET'][$article_id]['price'] = XT::round5($price);
        }
    }
    
}

?>
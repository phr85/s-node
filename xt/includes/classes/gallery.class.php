<?php

class XT_Gallery {
    
    var $_data = array();
    
    function XT_Gallery(){
        
    }
    
    /**
     * Get all galleries as a tree
     *
     * @param int Open Gallery ID
     */
    function getGalleries($open = 1){
                
        require_once(CLASS_DIR . "widgets/tree.widget.class.php");
        $treewidget = new XT_WidgetTree;
        $treewidget->addDetails('title','active');
        return $treewidget->buildTree('galleries','galleries_details','%s','',$in);

    }
    
}

?>
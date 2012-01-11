<?php
/**
 * S-Node XT File Handling Class
 *
 * Example of class usage:
 *
 * $file_data = $_FILES['file'];
 *
 * require_once(CLASS_DIR . 'file.class.php');
 * $file = new XT_File();
 * $file->setDescription(XT::getValue('description'));
 * $file->setKeywords(XT::getValue('keywords'));
 * $file->setPublic(XT::getValue('public'));
 * $file->upload($file_data,$folder_id);
 *
 * @author Roger Dudler <rdudler@iframe.ch>
 * @version $Id: file.class.php 5659 2008-12-29 13:14:47Z vzaech $
 */
class XT_File {

    var $id = 0;
    var $_description = '';
    var $_title = '';
    var $_keywords = '';
    var $_public = false;
    var $_file_info = array();
    var $_upload_dir = '';
    var $_type = 0;
    var $_image_info = array();
    var $_width = 0;
    var $_height = 0;
    var $_epsconverter = '';
    // set the maximale image size to 640 kbyte
    var $max_image_size = 640; // file size in kbyte
    // Set the biggest possible image size for the original.
    //If the destroy_original affected because the file size is to big.
    //The original image is recalculated to this value to reduce the file size.
    var $original_image_width = 1024;

    /**
     * Constructor: Sets the correct upload dir
     */
    function XT_File($baseid=240){
        // wenn der aufruf von articles selber kommt, werte anhand config füllen
        if(XT::getBaseID()==$baseid){
        $this->_upload_dir = XT::getConfig('file_upload_dir');
        $this->max_image_size = XT::getConfig('max_image_size');
        $this->original_image_width = XT::getConfig('original_image_width');
        $this->destroy_original = XT::getConfig("destroy_original");
        }
    }

    /**
     * Set title for this file
     *
     * @param string Title
     */
    function setTitle($title){
        $this->_title = $title;
    }

    /**
     * Set description for this file
     *
     * @param string Description
     */
    function setDescription($description){
        $this->_description = $description;
    }

    /**
     * Set Keywords for this file (whitespace separated or comma separated)
     *
     * @param string Keywords
     */
    function setKeywords($keywords){
        $this->_keywords = $keywords;
    }

    /**
     * Set whether the file should be public or not
     *
     * @param boolean Public
     */
    function setPublic($public = true){
        $this->_public = $public;
    }

    /**
     * Get title for this file
     *
     * @return string Title
     */
    function getTitle(){
        if($this->_title != ''){
            return $this->_title;
        } else {
            return $this->getName();
        }
    }

    /**
     * Get description of this file
     *
     * @return string Description
     */
    function getDescription(){
        return $this->_description;
    }

    /**
     * Get Keywords for this file
     *
     * @return string Keywords
     */
    function getKeywords(){
        return $this->_keywords;
    }

    /**
     * Is this file public or not?
     *
     * @return true If this file is public
     * @return false If this file is not public
     */
    function getPublic(){
        return $this->_public;
    }

    /**
     * Uploads a file
     *
     * @param array File information e.g. $_FILES['file']
     * @param int ID of the target folder (Default is the root node)
     */
    function upload($file_info, $folder_id = 1){
        // Save file information in this object
        $this->_file_info = $file_info;

        // Check for pre upload errors
        if(!$this->uploadError()){

            // Create database entry for the new file
            XT::query("
                INSERT INTO
                    " . XT::getTable("files") . "
                (
                    filename,
                    upload_date,
                    upload_user,
                    public
                ) VALUES (
                    '" . $this->getName() . "',
                    '" . time() . "',
                    '" . XT::getUserID() . "',
                    '" . $this->getPublic() . "'
            )",__FILE__,__LINE__);

            // Get the id of the created file entry from database
            $this->id = $this->getLastInsertID();

            // Create detail database entry for the new file
            XT::query("
                INSERT INTO
                    " . XT::getTable("files_details") . "
                (
                    id,
                    lang,
                    title,
                    description,
                    keywords
                ) VALUES (
                    '" . $this->id . "',
                    '" . XT::getPluginLang() . "',
                    '" . $this->getTitle() . "',
                    '" . $this->getDescription() . "',
                    '" . $this->getKeywords() . "'
            )",__FILE__,__LINE__);


            if($this->id > 0){

                // Add this file to the target folder
                $this->addToFolder($folder_id);

                // Move temporary file to the target location
                if(rename($this->_file_info['tmp_name'], $this->_upload_dir . $this->id)){

                    if($this->_epsconverter!=""){
                        // EPS handling
                        if(substr($this->_file_info['name'],-4) == '.eps'){
                            // copy file to id_eps
                            copy($this->_upload_dir . $this->id,$this->_upload_dir . $this->id . "_eps");
                            // convert $targetDirectory . $newFileId to tiff using image magick
                            exec($this->_epsconverter . " eps:" . $this->_upload_dir . $this->id . " -resample 72x72 png:" . $this->_upload_dir . $this->id);
                        }
                    }

                    // Find out more about the file type, especially the image type if the file is one
                    $this->_image_info = getimagesize($this->_upload_dir . $this->id);

                    switch($this->_image_info[2]){

                        // GIF image
                        case 1:
                            $this->_width = $this->_image_info[0];
                            $this->_height = $this->_image_info[1];
                            $this->_type = 1;
                            break;

                            // JPG image
                        case 2:
                            $this->_width = $this->_image_info[0];
                            $this->_height = $this->_image_info[1];
                            $this->_type = 1;
                            break;

                            // PNG image
                        case 3:
                            $this->_width = $this->_image_info[0];
                            $this->_height = $this->_image_info[1];
                            $this->_type = 1;
                            break;

                            // Flash (SWF) movie
                        case 4 || 13:
                            $this->_width = $this->_image_info[0];
                            $this->_height = $this->_image_info[1];
                            $this->_type = 2;
                            break;

                            // No special handled file type
                        default:

                            // True Type Font
                            if(substr($this->getName(),strrchr('.',$this->getName())) == '.ttf'){
                                $this->_type = 3;
                            }

                            break;
                    }

                    if($this->isImage()){
                        // Create image versions (thumbnails)
                        $this->createImageVersions();
                    }

                    // Update file information
                    XT::query("
                        UPDATE
                            " . $GLOBALS['plugin']->getTable("files") . "
                        SET
                            filesize = " . $this->getSize() . ",
                            type = " . $this->_type . ",
                            width = '" . $this->_width . "',
                            height = '" . $this->_height . "'
                        WHERE
                            id = " . $this->id . "
                    ",__FILE__,__LINE__);

                    // Index this file in the search engine
                    $this->index();

                }
            }
        }
    }
     /**
     * replace an existing file with a new one
     *
     * @return false If there was an error during upload process
     * @return true If there was no error during upload process
     */
    function replaceFile($file_info, $file_id,$comment=''){
        $this->id = $file_id;
         // Save file information in this object
        $this->_file_info = $file_info;

        // Check for pre upload errors
        if(!$this->uploadError()){

            if($this->id > 0){
                // revision erstellen
                $this->_createRevision($this->id ,$comment);
                // Move temporary file to the target location
                if(rename($this->_file_info['tmp_name'], $this->_upload_dir . $this->id)){

                    if($this->_epsconverter!=""){
                        // EPS handling
                        if(substr($this->_file_info['name'],-4) == '.eps'){
                            // copy file to id_eps
                            copy($this->_upload_dir . $this->id,$this->_upload_dir . $this->id . "_eps");
                            // convert $targetDirectory . $newFileId to tiff using image magick
                            exec($this->_epsconverter . " eps:" . $this->_upload_dir . $this->id . " -resample 72x72 png:" . $this->_upload_dir . $this->id);
                        }
                    }

                    // Find out more about the file type, especially the image type if the file is one
                    $this->_image_info = getimagesize($this->_upload_dir . $this->id);

                    switch($this->_image_info[2]){

                        // GIF image
                        case 1:
                            $this->_width = $this->_image_info[0];
                            $this->_height = $this->_image_info[1];
                            $this->_type = 1;
                            break;

                            // JPG image
                        case 2:
                            $this->_width = $this->_image_info[0];
                            $this->_height = $this->_image_info[1];
                            $this->_type = 1;
                            break;

                            // PNG image
                        case 3:
                            $this->_width = $this->_image_info[0];
                            $this->_height = $this->_image_info[1];
                            $this->_type = 1;
                            break;

                            // Flash (SWF) movie
                        case 4 || 13:
                            $this->_width = $this->_image_info[0];
                            $this->_height = $this->_image_info[1];
                            $this->_type = 2;
                            break;

                            // No special handled file type
                        default:

                            // True Type Font
                            if(substr($this->getName(),strrchr('.',$this->getName())) == '.ttf'){
                                $this->_type = 3;
                            }

                            break;
                    }

                    if($this->isImage()){
                        // Create image versions (thumbnails)
                        $this->createImageVersions();
                    }

                    // Update file information
                    XT::query("
                        UPDATE
                            " . $GLOBALS['plugin']->getTable("files") . "
                        SET
                            upload_date =" . TIME . ",
                            upload_user ='" . XT::getUserID() . "',
                            filename ='" . $this->_file_info['name'] . "',
                            filesize = " . $this->getSize() . ",
                            type = " . $this->_type . ",
                            width = '" . $this->_width . "',
                            height = '" . $this->_height . "'
                        WHERE
                            id = " . $this->id . "
                    ",__FILE__,__LINE__);

                    // Index this file in the search engine
                    $this->index();

                }
            }
        }

    }


    /**
     * Neue Dateirevision erstellen
     *
     * @return false If there was an error during upload process
     * @return true If there was no error during upload process
     */
    function _createRevision($fileID,$comment=''){

        // aktuelle revision ermitteln
        $result = XT::query("SELECT max(revision + 1) as rev from " . XT::getTable("files_revision") . " WHERE file_id=" . $fileID,__FILE__,__LINE__);
        $res = XT::getQueryData($result);
        $revision = $res[0]['rev'];
        // neuen revisionseintrag erstellen
            //details der aktuellen datei holen und serialisieren um sie in details feld zu speichern
            // TODO !!!!
            // werte eintragen
            XT::query("insert into " . XT::getTable("files_revision") . " ( `file_id`, `revision`, `mod_user`, `mod_date`, `comment`) values ( '" . $fileID . "', '" . $revision . "', '" . XT::getUserID() . "', '" . TIME . "', '" . addslashes($comment) . "')",__FILE__,__LINE__);
        // aktuelle datei zu revision verschieben
            rename($this->_upload_dir . $this->id, $this->_upload_dir . $this->id . 'R' . $revision);
        //

    }


    /**
     * Checks if there where an upload error occured
     *
     * @return true If there was an error during upload process
     * @return false If there was no error during upload process
     */
    function uploadError(){
        if($this->_file_info['error'] == 0){
            return false;
        } else {
            XT::log("Upload failed",__FILE__,__LINE__,XT_ERROR);
            return true;
        }
    }

    /**
     * Gets the name of the file
     */
    function getName(){
        return $this->_file_info['name'];
    }

    /**
     * Gets the size of the file in bytes
     */
    function getSize(){
        return $this->_file_info['size'];
    }

    /**
     * Gets the last inserted file id
     */
    function getLastInsertID(){

        // Get the new id of the file
        $result = XT::query("
            SELECT
                id
            FROM
                " . XT::getDatabasePrefix() . "files
            ORDER BY
                id DESC
            LIMIT 1
        ",__FILE__,__LINE__);

        $data = XT::getQueryData($result);
        return $data[0]['id'];

    }

    /**
     * Adds a file link to an existing folder
     *
     * @param $folder_id Folder ID
     */
    function addToFolder($folder_id){

        if($this->id > 0 && $folder_id > 0){
            XT::query("INSERT INTO " . XT::getDatabasePrefix() . "files_rel (node_id,file_id) VALUES (" . $folder_id . "," . $this->id . ")",__FILE__,__LINE__);
            return true;
        } else {
            return false;
        }

    }

    /**
     * Check if this file is an image
     *
     * @return true If this file is an especially handled image
     * @return false If this file is a not especially handled image type or another file type
     */
    function isImage(){
        if($this->_type == 1){
            return true;
        } else {
            return false;
        }
    }

    /**
     * Check if this file is a truetype font
     *
     * @return true If this file is a true type font
     * @return false If this file is another file type
     */
    function isFont(){
        if($this->_type == 3){
            return true;
        } else {
            return false;
        }
    }

    /**
     * Check if this file is a flash movie
     *
     * @return true If this file is a flash movie
     * @return false If this file is a another file type
     */
    function isFlash(){
        if($this->_type == 2){
            return true;
        } else {
            return false;
        }
    }

    /**
     * Creates thumbnail versions of an image based on the configuration array
     */
    function createImageVersions(){

        // Create image versions (thumbnails)
        foreach(XT::getConfig('imageversions') as $key => $value){

            $info = $GLOBALS['image']->createVersion($this->_upload_dir . $this->id, $value, $this->_upload_dir . $this->id . "_" . $key);

            // Create entry for each image version
            XT::query("
                INSERT INTO
                    " . $GLOBALS['plugin']->getTable("files_versions") . "
                (
                    file_id,
                    version,
                    width,
                    height,
                    filesize,
                    type
                ) VALUES (
                    " . $this->id . ",
                    '" . $key . "',
                    " . $info['width'] . ",
                    " . $info['height'] . ",
                    " . $info['filesize'] . ",
                    " . $this->_type . "
                )
            ",__FILE__,__LINE__);
        }

        // Create cube version
        $GLOBALS['image']->createCube($this->_upload_dir . $this->id);

        //Delete images if requires
        if($this->destroy_original){
            $GLOBALS['image']->createPseudoOriginal(DATA_DIR . "files/" . $this->id,$this->max_image_size,$this->original_image_width);
        }
    }

    /**
     * Indexes a file for use in search engine
     */
    function index(){

        // Try to index the file's content
        XT::loadClass("fileindexer.class.php","ch.iframe.snode.filemanager");
        $fileindexer = new XT_FileIndexer();
        $filecontent = $fileindexer->index($this->_upload_dir . $this->id, $this->getName());

        // Index file metadata
        XT::loadClass("searchindex.class.php", 'ch.iframe.snode.search');

        $search = new XT_SearchIndex($this->id,XT::getContentType("File"),$this->_public);
        $search->add($this->getKeywords(), 1);
        $search->add($this->getName(), 1);
        $search->add($filecontent,1);
        $search->build($this->getTitle(), $this->getDescription());

        // Set image for this file if it is one
        if($this->_type == 1){
            $search->setImage($this->id);
        }

    }
}

?>
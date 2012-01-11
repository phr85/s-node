<?php

// Add buttons
XT::addImageButton('Clean up','cleanUp','default','refresh.png','themes');

// Open package
if(XT::getValue("open") != ''){
    XT::setSessionValue("open", XT::getValue("open"));
    XT::setSessionValue('open_module','');
}

XT::assign("OPEN", XT::getSessionValue("open"));

// Open module
if(XT::getValue("open_module") != ''){
    XT::setSessionValue("open_module", XT::getValue("open_module"));
}

XT::assign("OPEN_MODULE", XT::getSessionValue("open_module"));

// Get installed packages
$result = XT::query("
    SELECT
        p.id,
        p.package,
        (p.version/1000) as version,
        p.provider,
        pd.title,
        pd.description
    FROM
        " . XT::getTable('plugins_packages') . " AS p LEFT JOIN
        " . XT::getTable('plugins_packages_details') . " AS pd ON (pd.id = p.id AND pd.lang = 'de')
    WHERE
        pd.title != ''
    ORDER BY
        pd.title,
        pd.id ASC
", __FILE__, __LINE__);

$data = array();
while($row = $result->FetchRow()){
    if(XT::getSessionValue("open") == $row['id']){
        $open_package = $row['package'];
    }
    $data[] = $row;
}

XT::assign("INSTALLED", $data);

// Get modules for open package
if(XT::getSessionValue("open") > 0){
    $result = XT::query("
        SELECT
            title,
            module,
            package
        FROM
            " . XT::getTable('plugins_modules') . "
        WHERE
            package = '" . XT::getSessionValue("open") . "' AND
            lang = 'de'
        GROUP BY
            module
    ",__FILE__,__LINE__);

    $data = array();
    while($row = $result->FetchRow()){
        $data[$row['package']][] = $row;
    }

    XT::assign("MODULES", $data);
}

// Get templates for selected module
if(XT::getSessionValue("open_module") != ''){

    // Themed templates
    if($_SESSION['theme'] != 'default'){
        $directory = TEMPLATE_DIR . $_SESSION['theme'] . '/' . $open_package . '/' . XT::getSessionValue("open_module");
        $count = count(explode("/",$directory));
        $themed_templates[XT::getSessionValue("open_module")] = getFiles($directory,$count);
        XT::assign("THEMED_TEMPLATES", $themed_templates);
    }

    // Default templates
    $directory = TEMPLATE_DIR . 'default/' . $open_package . '/' . XT::getSessionValue("open_module");
    $count = count(explode("/",$directory));
    $default_templates[XT::getSessionValue("open_module")] = getFiles($directory,$count);
    XT::assign("DEFAULT_TEMPLATES", $default_templates);
}

$content = XT::build('overview.tpl');

function getFiles($directory, $initialcount) {

    // Initial folder count
    $count = count(explode("/",$directory));

   // Try to open the directory
   if($dir = @opendir($directory)) {
       // Create an array for all files found
       $tmp = Array();
       $filedata = array();

       // Add the files
       while($file = readdir($dir)) {
           // Make sure the file exists
           if($file != "." && $file != ".." && $file[0] != '.') {

               $isDir = false;
               $filedata['isFolder'] = 0;
               if(is_dir($directory . "/" . $file)) {
                   $filedata['isFolder'] = 1;
                   $isDir = true;
               }

               $filedata['level'] = $count - $initialcount + 1;
               $filedata['title'] = $file;
               $filedata['path'] = $directory . "/" . $file;
               array_push($tmp, $filedata);

               // If it's a directiry, list all files within it
               if($isDir) {
                   $tmp2 = getFiles($directory . "/" . $file,$initialcount);
                   if(is_array($tmp2)) {
                       $tmp = array_merge($tmp, $tmp2);
                   }
               }
           }
       }

       // Finish off the function
       closedir($dir);
       return $tmp;
   }
}

?>
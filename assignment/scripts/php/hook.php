<?php
    //specify path to gallery images
    $directory = '../../assets/images/gallery_images';
    //only load files with extensions...
    $allowed_ext = array('jpg','jpeg','gif','png');
    //array used to separate ext
    $file_parts = array();
    //response
    $response = "";
    //opens dir to parse
    $dir_handle = opendir($directory);
    //iterate through all files
    while ($file = readdir($dir_handle)) {
        //check for hidden files
        if (substr($file,0,1) != '.'){
            //Split each file name to extract file extension
            $file_components = explode('.', $file);
            //grab extension
            $extension = strtolower(array_pop($file_components));
            //is this file valid image? if so add to response
            if (in_array($extension, $allowed_ext))
            {
                //build a response string using ~ symbol
                $response .= $directory.'/'.$file.'~';
                
            }
        }
    }
    closedir($dir_handle);
    //return response while removing ~ separator
    echo substr_replace($response,"",-1);
?>


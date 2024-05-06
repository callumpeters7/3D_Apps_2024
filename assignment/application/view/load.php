<?php
class Load {
    //defaults to constructor as no specific constructor is defined
    function view($file_name, $data = null)
    {
        //Check for data
        if( is_array($data) ){
            extract($data);
        }
        //Concatenate view file with php extension to include it as php
        include $file_name . '.php';
    }
}
?>
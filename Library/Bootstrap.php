<?php
# Headers
header('Content-type: text/html;');
header('Cache-Control: no-cache, must-revalidate');

# Constants declaration
define('CURRENT_VERSION', '1.3.0');

# PHP < 5.3 Compatibility
if (defined('ENT_IGNORE') === false) {
    define('ENT_IGNORE', 0);
}

# XSS / User input check
function XssClearRequestArray($arr){
    foreach ($arr as $index => $data) {
        if(is_array($data)) {
            $arr[$index] = XssClearRequestArray($data);
        } else {
            $arr[$index] = htmlentities($data);
        }
    }
    return $arr;
}
XssClearRequestArray($_REQUEST);
XssClearRequestArray($_POST);
XssClearRequestArray($_GET);
XssClearRequestArray($_COOKIE);

# Autoloader
function autoloader($class)
{
    require_once str_replace('_', DIRECTORY_SEPARATOR, $class) . '.php';
}
spl_autoload_register('autoloader');

# Loading ini file
$_ini = Library_Configuration_Loader::singleton();

# Date timezone
date_default_timezone_set('Europe/Paris');

<?php
//Define the paths to the directories holding class files
$paths = array(
    dirname(__DIR__).'/classes',
    dirname(__DIR__).'/data',
    dirname(__DIR__).'/models',
    dirname(__DIR__).'/exceptions'
);
//Add the paths to the class directories to the include path.
set_include_path(get_include_path() . PATH_SEPARATOR . implode(PATH_SEPARATOR, $paths));
//Add the file extensions to the SPL.
spl_autoload_extensions(".class.php,.php,.inc");
//Register the default autoloader implementation in the php engine.
spl_autoload_register();

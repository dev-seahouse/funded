<?php
//Define the paths to the directories holding class files
$paths = array(
    '../classes/',
    '../data/'
);
//Add the paths to the class directories to the include path.
set_include_path(get_include_path() . PATH_SEPARATOR . implode(PATH_SEPARATOR, $paths));
//Add the file extensions to the SPL.
spl_autoload_extensions(".class.php,.php,.inc");
//Register the default autoloader implementation in the php engine.
spl_autoload_register();

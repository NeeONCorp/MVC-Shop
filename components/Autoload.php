<?php
function __autoload ($className) {
    $array_paths = [
        '/models/',
        '/components/'
    ];

    foreach ($array_paths as $path) {
        $filePath = ROOT . $path . $className . '.php' ;

        if(file_exists($filePath)) {
            include_once ($filePath);
        }
    }
}
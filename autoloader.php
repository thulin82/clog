<?php

function myAutoloader($class)
{
    $path = sprintf('src/%s/%s.php', $class, $class);
    if (is_file($path)) {
        include($path);
    } else {
        throw new Exception("Classfile '{$class}' does not exist.");
    }
}
spl_autoload_register('myAutoloader');

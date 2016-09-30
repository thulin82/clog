<?php

function myAutoloader($class)
{
    $path = sprintf('src/%s/%s.php', $class, $class);
    if (is_file($path)) {
        include($path);
    }
}
spl_autoload_register('myAutoloader');

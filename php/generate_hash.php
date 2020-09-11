<?php

// este archivo toma una marca de tiempo, un argumento (id del usuario) 
// y la clave secreta para generar el hash que necesitamos
$time = time();
echo "Time: $time".PHP_EOL."Hash: ".sha1($argv[1].$time.'Sh!! No se lo cuentes a nadie!').PHP_EOL;
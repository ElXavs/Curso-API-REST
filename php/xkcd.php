<?php
//estoy guardando la respuesta de la peticion en un string json
$json = file_get_contents('https://xkcd.com/info.0.json');
//generamos un arreglo basado en el string que obtuvimos
$data = json_decode( $json, true); //true hace que nos lo devuelva como un objeto en lugar de arreglo
//mostramos la propiedad img de los datos obtenidos y agregamos un espacio al final
echo $data['img'].PHP_EOL;
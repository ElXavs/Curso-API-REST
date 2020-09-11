<?php 

//definimos los recursos disponibles
$allowedResourceTypes = [
  'books',
  'authors',
  'genre',
];

//validamos que el recurso este disponible
$resourceType = $_GET['resource_type'];

if( !in_array($resourceType, $allowedResourceTypes)){
  die;
}

//Defino los recursos
$books = [
  1 => [
    'titulo' => 'La sombra del viento',
    'id_autor' => 2,
    'id_genero' => 2,
  ],
  2 => [
    'titulo' => 'La Iliada',
    'id_autor' => 1,
    'id_genero' => 1,
  ],
  3 => [
    'titulo' => 'La casa de los espiritus',
    'id_autor' => 3,
    'id_genero' => 3,
  ]  
];
//Avisamos que tipo de archivo va en la respuesta
header('Content-Type: application/json');

//Levantamos el id del recurso buscado
//si el id existe dentro del get, si si, obtendremos el resultado, en caso que no, devolvera un string vacio
//uso de if ternario
$resourceId = array_key_exists('resource_id', $_GET) ? $_GET['resource_id'] : '' ;

//Generamos la respuesta asumiendo que el pedido es correcto
switch(strtoupper($_SERVER['REQUEST_METHOD'])) {
  //get responde con el arreglo $books en formato json
  //ahora necesitamos saber si vamos a pedir el arreglo entero o un recurso en particular
  case 'GET':
    if(empty($resourceId)) {
      echo json_encode($books);
    } else {
      if(array_key_exists($resourceId, $books)) {
        echo json_encode($books[$resourceId]);
      }
    }
    break;
  case 'POST':
    break;
  case 'PUT':
    break;
  case 'DELETE':
    break;
}
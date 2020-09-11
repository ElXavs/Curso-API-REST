<?php 

// Validar que la informacion este completa, que el usuario nos de un hash, una marca de tiempo y el uid
if (
  !array_key_exists('HTTP_X_HASH', $_SERVER) ||
  !array_key_exists('HTTP_X_TIMESTAMP', $_SERVER) ||
  !array_key_exists('HTTP_X_UID', $_SERVER)
) {
  die;
}
// Asignamos varias variables en una sola instruccion
// tomamos los tres encabezados y los asignamos en variables para trabajar con ellos, respectivamente
list($hash,$uid,$timestamp) = [
  $_SERVER['HTTP_X_HASH'],
  $_SERVER['HTTP_X_UID'],
  $_SERVER['HTTP_X_TIMESTAMP'],
];
// Le damos la clave secreta
$secret = 'Sh!! No se lo cuentes a nadie!';
// Generamos nuestra propia version del hash usando una funcion de hashing, que se utiliza en criptografia
// Y concatenamos todo lo recibido por el usuario mas las clave secreta
$newHash = sha1($uid.$timestamp.$secret);
// Validamos el hash
if ($newHash !== $hash) {
  die;
}

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
    // Tomamos la entrada cruda
    $json = file_get_contents('php://input');
    // Transformamos el json recibido a un nuevo elemento del array
    $books[] = json_decode($json, true);
    // Emitimos hacia la salida la ultima clave del arreglo de libros
    echo array_keys($books)[count($books)-1];
    break;
  case 'PUT':
    // Validamos que ele recurso buscado exista
    if (!empty($resourceId) && array_key_exists($resourceId,$books)){
      //Tomamos la entrada cruda
      $json = file_get_contents('php://input');
      // Transformamos el json recibido a un nuevo elemento del array
      $books[$resourceId] = json_decode($json, true);
      // Retornamos la collecion modificada en formato json
      echo json_encode($books);
    }
    break;
  case 'DELETE':
    // Validamos que el recurso exista
    if (!empty($resourceId) && array_key_exists($resourceId,$books)) {
      // Eliminamos el recurso
      unset($books[$resourceId]);
    }

    echo json_encode($books);
    break;
}
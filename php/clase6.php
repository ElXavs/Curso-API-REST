<?php 
//definiremos los tipos de recursos que podran ser consultables desde el exterior con un arreglo
//asumiremos que el servidor cuenta con una base de datos con libros
$allowedResourceTypes = [
  'books',
  'authors',
  'genre',
];

//ahora haremos una validacion que nos diga si el tipo de recurso que estamos solicitando esta dentro del arreglo
//con esta nueva variable asumiremos que fue informada desde el exterior a traves de la url
//usaremos la variable get de php y diremos que el parametro tiene que coincidir con los valores del arreglo
$resourceType = $_GET['resource_type'];
//si lo que viene de la url no pertenece al array entonces el script se termina ahi
if( !in_array($resourceType, $allowedResourceTypes)){
  die;
}

//con este determinaremos lo que se hara en cada uno de los casos
//para saber el verbo que se utilizo usamos una variable propia de php ($_SERVER['REQUEST_METHOD'])
//esto esta dentro de un parentesis con metodo que hace que todo se pase a mayusculas
//esta sera nuestra estructura basica del servidor web
switch(strtoupper($_SERVER['REQUEST_METHOD'])) {
  case 'GET':
    break;
  case 'POST':
    break;
  case 'PUT':
    break;
  case 'DELETE':
    break;
}
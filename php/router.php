<?php

$matches=[];
//toma la expresion regular para verificar si la uri que recibimos coincide con ese patron
//esta expresion dice: un string que empieza con un slash, tiene cualquier cosa que no sea una barra
//despues una barra y luego cualquier cosa que no sea una barra
if (preg_match('/\/([^\/]+)\/([^\/]+)/',$_SERVER["REQUEST_URI"],$matches)) {
  //si se cumple la condicion, generamos la variables del get usando los matches
  $_GET['resource_type']=$matches[1];    
  $_GET['resource_id']=$matches[2];

  error_log(print_r($matches,1));
  require 'server.php'; //por ultimo, se delega el control al server
  //para que continue como si la llamada se hubiese hecho, pero pasando los parametros de arriba
} else if (preg_match('/\/([^\/]+)\/?/',$_SERVER["REQUEST_URI"],$matches)) {
  //este if hace lo mismo que el de arriba pero para el pedido de la coleccion
  $_GET['resource_type']=$matches[1];        
  error_log(print_r($matches,1));
  require 'server.php';
} else { //si no coincide con ninguno da error
    error_log('No matches');
    http_response_code(404);
}

?> 
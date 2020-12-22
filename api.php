<?php
// Esta API tiene dos posibilidades; Mostrar una lista de autores o mostrar la información de un autor específico.

function get_lista_autores(){
    //Esta información se cargará de la base de datos
    $lista_autores = array(
        array("id" => 0, "nombre" => "J. R. R.", "apellidos" => "Tolkien" ),
        array("id" => 1, "nombre" => "Isaac", "apellidos" => "Asimov")
    );
    
    return $lista_autores;
}

function get_datos_autor($id){
    $info_autor = array();
    //Esta información se cargará de la base de datos
    switch ($id){
        case 0:
          $info_autor = array("nombre" => "J. R. R.", "apellidos" => "Tolkien", "nacionalidad" => "Inglaterra"); 
          break;
        case 1:
          $info_autor = array("nombre" => "Isaac", "apellidos" => "Asimov", "nacionalidad" => "Rusia"); 
          break;
    }
    
    return $info_autor;
}

$posibles_URL = array("get_lista_autores", "get_datos_autor");

$valor = "Ha ocurrido un error";

if (isset($_GET["action"]) && in_array($_GET["action"], $posibles_URL))
{
  switch ($_GET["action"])
    {
      case "get_lista_autores":
        $valor = get_lista_autores();
        break;
      case "get_datos_autor":
        if (isset($_GET["id"]))
            $valor = get_datos_autor($_GET["id"]);
        else
            $valor = "Argumento no encontrado";
        break;
    }
}

//devolvemos los datos serializados en JSON
exit(json_encode($valor));
?>
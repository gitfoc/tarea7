<?php
// Esta API tiene dos posibilidades; Mostrar una lista de autores o mostrar la información de un autor específico.

function get_lista_autores(){
	//Datos de la aplicación, simulando datos en bd
	$obj = new stdClass();
	$obj->id="0";
	$obj->nombre="J. R. R.";
	$obj->apellidos="Tolkien";
	$obj->nacionalidad="Inglaterra";
	$obj1 = new stdClass();
	$obj1->id="2";
	$obj1->nombre="Isaac";
	$obj1->apellidos="Asimov";	
	$obj1->nacionalidad="Rusia";

    //Esta información se cargará de la base de datos

	$lista_autores = array($obj, $obj1);
    
    return $lista_autores;
}

function get_datos_autor($id){
	//Datos de la aplicación, simulando datos en bd
	$obj = new stdClass();
	$obj->id="0";
	$obj->nombre="J. R. R.";
	$obj->apellidos="Tolkien";
	$obj->nacionalidad="Inglaterra";
	$obj1 = new stdClass();
	$obj1->id="2";
	$obj1->nombre="Isaac";
	$obj1->apellidos="Asimov";	
	$obj1->nacionalidad="Rusia";
	
    $info_autor = array();
    //Esta información se cargará de la base de datos
    switch ($id){
        case 0:
          $info_autor = array($obj); 
          break;
        case 1:
          $info_autor = array($obj1); 
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

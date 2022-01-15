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
		//IMPORTANTE: Este bloque switch simula dos consultas de la base de datos, 
		// la de libros será un join de las dos tablas
        case 0:
          $info_autor["datos"] = array("nombre" => "J. R. R.", "apellidos" => "Tolkien", "nacionalidad" => "Inglaterra"); 
          $info_autor["libros"] = array(
			array("id" => 0, "titulo" =>"El Hobbit", "f_publicacion" =>"21/09/1937")
			,array("id" => 1, "titulo" =>"La Comunidad del Anillo", "f_publicacion" =>"29/07/1954")
			,array("id" => 2, "titulo" =>"Las dos torres", "f_publicacion" =>"11/11/1954")
			,array("id" => 3, "titulo" =>"El retorno del Rey", "f_publicacion" =>"20/10/1955"));		  
		  break;
        case 1:
          $info_autor["datos"] = array("nombre" => "Isaac", "apellidos" => "Asimov", "nacionalidad" => "Rusia"); 
          $info_autor["libros"] = array(
			array("id" => 4, "titulo" =>"Un guijarro en el cielo", "f_publicacion" =>"19/01/1950")
			,array("id" => 5, "titulo" =>"Fundación", "f_publicacion" =>"01/06/1951")
			,array("id" => 6, "titulo" =>"Yo, robot", "f_publicacion" =>"02/12/1950"));
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

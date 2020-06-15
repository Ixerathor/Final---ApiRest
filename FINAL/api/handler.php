<?php
/* Anthony Barahona Villamil */
     require 'db.php';
     $metodo = $_SERVER['REQUEST_METHOD'];

switch ($metodo) {
    case 'GET':
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $sql = "SELECT * FROM productos WHERE id='$id'";
            $query = $conexion->prepare($sql);
            $query->execute();
            $datos = $query->fetchAll(PDO::FETCH_ASSOC);
        } else {
            $sql = "SELECT * FROM productos";
            $query = $conexion->prepare($sql);
            $query->execute();
            $datos = $query->fetchAll(PDO::FETCH_ASSOC);
        }
        
        exit(json_encode($datos));
        break;


 case 'POST':

    //  Espera un formulario para crear un nuevo campo en la tabla

    if (isset($_POST['descripcion'])) {
        $descripcion = $_POST['descripcion'];
        $marca = $_POST['marca'];
        $preciound = $_POST['preciound'];        
        $cantidad= $_POST['cantidad'];
        $sql = "INSERT INTO productos(descripcion, marca, preciound, cantidad)  VALUES  ('$descripcion' , '$marca' , '$preciound', '$cantidad')";
        $query = $conexion->prepare($sql);
        $query->execute();
        exit(json_encode(array("status" => 'Insercion exitosa ')));
    } else {
        exit(json_encode(array("status" => 'falla', 'razon' => 'Llene todos los campos de entrada')));
    }
break;

case 'PUT':
    
    //  Espera un id como parametro, ademas de otros campos necesarios
    //  para poder actualizar un producto en la tabla
    
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $descripcion = $_GET['descripcion'];
        $marca = $_GET['marca'];
        $preciound = $_GET['preciound']; 
        $cantidad = $_GET['cantidad'];        
        $sql = "UPDATE productos SET descripcion='$descripcion', marca='$marca', preciound='$preciound', cantidad = '$cantidad' WHERE id = '$id'";
        $query = $conexion->prepare($sql);
        $query->execute();
        exit(json_encode(array("status" => 'Insercion exitosa ')));
    } else {
        exit(json_encode(array("status" => 'falla', 'razon' => 'Revise los campos de entrada')));
    }
break;

case 'DELETE':

    //  Espera un id especifico para ser eliminado
    //  Es necesario entregar este id como parametro

    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $sql = "DELETE  FROM productos  WHERE id = '$id'";
        $query = $conexion->prepare($sql);
        $query->execute();
        exit(json_encode(array("status" => 'Producto Eliminado exitosamente ')));
    } else {
        exit(json_encode(array("status" => 'falla', 'razon' => 'Falta el id del producto que desea eliminar')));
    }
break;
   
}

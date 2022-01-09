<?php 
include "./conexion.php";

if(isset($_POST['nombre']) &&  isset($_POST['precio'])  &&  isset($_POST['inventario'])
    &&  isset($_POST['categoria']) &&  isset($_POST['memoria'])  &&  isset($_POST['bateria'])
    &&  isset($_POST['camara'])){
    
    $carpeta="../images/";
    $nombre = $_FILES['imagen']['name'];
   
    //imagen.casa.jpg
    $temp= explode( '.' ,$nombre);
    $extension= end($temp);
    
    $nombreFinal = time().'.'.$extension;
   
    if($extension=='jpg' || $extension == 'png'){
        if(move_uploaded_file($_FILES['imagen']['tmp_name'], $carpeta.$nombreFinal)){
            $conexion->query("insert into productos 
                (nombre,precio, imagen,inventario,id_categoria,memoria,bateria,camara) values
                (
                    '".$_POST['nombre']."',
                    ".$_POST['precio'].",
                    '$nombreFinal',
                    '".$_POST['inventario']."',
                    ".$_POST['categoria'].",
                    '".$_POST['memoria']."',
                    '".$_POST['bateria']."',
                    '".$_POST['camara']."'
                )   ")or die($conexion->error);
                header("Location: ../admin/productos.php?success");
        }else{
            header("Location: ../admin/productos.php?error=No se pudo subir la imagen");
        }
    }else{
        header("Location: ../admin/productos.php?error=Favor de subir una imagen valida");
    }

}else{
    header("Location: ../admin/productos.php?error=Favor de llenar todos los campos");
}

?>
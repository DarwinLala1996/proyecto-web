<?php 
include "conexion.php";
if(isset($_POST['nombre']) &&  isset($_POST['precio'])  &&  isset($_POST['inventario'])
    &&  isset($_POST['categoria']) &&  isset($_POST['memoria'])  &&  isset($_POST['bateria'])
    &&  isset($_POST['camara'])){    
   
    
    if($_FILES['imagen']['name'] !='' ){
        $carpeta="../images/";
        $nombre = $_FILES['imagen']['name'];
            //imagen.casa.jpg
        $temp= explode( '.' ,$nombre);
        $extension= end($temp);
        
        $nombreFinal = time().'.'.$extension;
    
        if($extension=='jpg' || $extension == 'png'){
            if(move_uploaded_file($_FILES['imagen']['tmp_name'], $carpeta.$nombreFinal)){
                $fila = $conexion->query('select imagen  from productos where id='.$_POST['id']);
                $id = mysqli_fetch_row($fila);
                if(file_exists('../images/'.$id[0])){
                    unlink('../images/'.$id[0]);
                }
                $conexion->query("update productos set imagen='".$nombreFinal."' where id=".$_POST['id']);
            }

        }//llave tipo archivo
    }    //llave si no esta vacio

    $conexion->query("update productos set 
                        nombre='".$_POST['nombre']."',
                        precio=".$_POST['precio'].",
                        inventario=".$_POST['inventario'].",
                        id_categoria=".$_POST['categoria'].",
                        memoria='".$_POST['memoria']."',
                        bateria='".$_POST['bateria']."',
                        camara='".$_POST['camara']."' 
                        where id=".$_POST['id']);
    echo "se actualizo";
}   
?>
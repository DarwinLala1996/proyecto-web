<?php session_start();?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>XSTORE</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Mukta:300,400,700"> 
    <link rel="stylesheet" href="fonts/icomoon/style.css">

    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/magnific-popup.css">
    <link rel="stylesheet" href="css/jquery-ui.css">
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">


    <link rel="stylesheet" href="css/aos.css">

    <link rel="stylesheet" href="css/style.css">
    
  </head>
  <body>
  
  <div class="site-wrap">
    <?php include("./layouts/header.php"); ?> 

    <div class="site-section">
      <div class="container">

        <div class="row mb-5">
          <div class="col-md-9 order-2">

            <div class="row">
              <div class="col-md-12 mb-5">
                <div class="float-md-left mb-4"><h2 class="text-black h5">Catálogo</h2></div>
              </div>
            </div>
            <div class="row mb-5">
              <?php
                include('./php/conexion.php');
                /*   for($i=0;$i<50;$i++){
                    $conexion->query("insert into productos (nombre, descripcion,precio,imagen,
                                      inventario, id_categoria,talla,color) values (
                                        'Producto $i','Esta es la descripcion',".rand(10,1000).",'cloth_1.jpg',".rand(1,100).",1,'XL','Blue'
                                      ) ")or die($conexion->error);
                  }*/
                $limite = 10;//productos por página
                $totalQuery = $conexion->query('select count(*) from productos')or die($conexion->error);
                $totalProductos = mysqli_fetch_row($totalQuery);
                $totalBotones = ceil($totalProductos[0] /$limite);
                if(isset($_GET['limite'])){
                  $resultado = $conexion ->query("select * from productos  where inventario > 0  order by id DESC limit ".$_GET['limite'].",".$limite)or die($conexion -> error);
                }else{
                  $resultado = $conexion ->query("select * from productos  where inventario > 0  order by id DESC limit ".$limite)or die($conexion -> error);
                }
                
                while($fila = mysqli_fetch_array($resultado)){  
              ?>
                  <div class="col-sm-6 col-lg-4 mb-4" data-aos="fade-up">
                    <div class="block-4 text-center border">
                      <figure class="block-4-image">
                        <a href="shop-single.php?id=<?php echo $fila['id'];?>">
                        <img src="images/<?php echo $fila['imagen'];?>" alt="<?php echo $fila['nombre'];?>" class="img-fluid"></a>
                      </figure>
                      <div class="block-4-text p-4">
                        <h3><a href="shop-single.php?id=<?php echo $fila['id'];?>"><?php echo $fila['nombre'];?></a></h3>
                        <p class="text-primary font-weight-bold">$<?php echo $fila['precio'];?></p>
                      </div>
                    </div>
                  </div>
                <?php } ?>
            


            </div>
            <div class="row" data-aos="fade-up">
              <div class="col-md-12 text-center">
                <div class="site-block-27">
                  <ul>
                   
                      <?php
                        if(isset($_GET['limite'])){
                          if($_GET['limite']>0){
                            echo ' <li><a href="index.php?limite='.($_GET['limite']-10).'">&lt;</a></li>';
                          }
                        }

                        for($k=0;$k<$totalBotones;$k++){
                          echo  '<li><a href="index.php?limite='.($k*10).'">'.($k+1).'</a></li>';
                        }
                        if(isset($_GET['limite'])){
                          if($_GET['limite']+10 < $totalBotones*10){
                            echo ' <li><a href="index.php?limite='.($_GET['limite']+10).'">&gt;</a></li>';
                          }
                        }else{
                          echo ' <li><a href="index.php?limite=10">&gt;</a></li>';
                        }
                      ?>
                    
                  </ul>
                </div>
              </div>
            </div>
          </div>

          <div class="col-md-3 order-1 mb-5 mb-md-0">
            <div class="border p-4 rounded mb-4">
              <h3 class="mb-3 h6 text-uppercase text-black d-block">Categorías</h3>
              <ul class="list-unstyled mb-0">
              <?php 
                $re= $conexion->query("select * from categorias ");
                while($f= mysqli_fetch_array($re)){
              ?>
                <li class="mb-1">
                  <a href="./busqueda.php?texto=<?php echo $f['nombre']?>" class="d-flex">
                    <span><?php echo $f['nombre'];?></span>
                    <span class="text-black ml-auto">
                     <?php 
                        $re2 = $conexion->query("select count(*) from productos where id_categoria = ".$f['id']);
                        $fila = mysqli_fetch_row($re2);
                        echo $fila[0];
                     ?>
                    </span>
                  </a></li>
        
                <?php } ?>
              </ul>
            </div>

          </div>
        </div>  
      </div>
    </div>
    <?php include("./layouts/footer.php"); ?> 

    
  </div>

  <script src="js/jquery-3.3.1.min.js"></script>
  <script src="js/jquery-ui.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/owl.carousel.min.js"></script>
  <script src="js/jquery.magnific-popup.min.js"></script>
  <script src="js/aos.js"></script>

  <script src="js/main.js"></script>
    
  </body>
</html>
<?php
  session_start();
    include("./php/conexion.php");
    if( isset($_GET['id'])){
      $resultado = $conexion ->query("select * from productos where id=".$_GET['id'])or die($conexion->error);
      if(mysqli_num_rows($resultado) > 0 ){
        $fila = mysqli_fetch_row($resultado);
      }else{
        header("Location: ./index.php");
      }
    }else{
      //redireccionar
      header("Location: ./index.php");
    }


    if( isset($_GET['id'])){
      $res = $conexion ->query("select * from productos where id=".$_GET['id'])or die($conexion->error);
      if(mysqli_num_rows($res) > 0 ){
        $data = mysqli_fetch_row($res);
      }else{
        header("Location: ./index.php");
      }
    }else{
      //redireccionar
      header("Location: ./index.php");
    }


?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Tienda</title>
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
        <div class="row">
          <div class="col-md-6">
            <img src="images/<?php echo $fila[3]; ?>" alt="<?php echo $fila[1]; ?>" class="img-fluid">
          </div>
          <div class="col-md-6">
            <h2 class="text-black"><?php echo $fila[1]; ?></h2>
            <p><strong class="text-primary h4">$<?php echo $fila[2]; ?></strong></p>
            <p>Memoria RAM: <?php echo $fila[6]; ?> GB</p>
            <p>Batería: <?php echo $fila[7]; ?> mAh</p>
            <p>Cámara: <?php echo $fila[8]; ?> MP</p>
            
            <div class="mb-5">
              <div class="input-group mb-3" style="max-width: 120px;">
                <div class="input-group-prepend">
                  <button class="btn btn-outline-primary js-btn-minus" type="button">&minus;</button>
                </div>
                <input type="text" class="form-control text-center" value="1" placeholder="" aria-label="Example text with button addon" aria-describedby="button-addon1">
                <div class="input-group-append">
                  <button class="btn btn-outline-primary js-btn-plus" type="button">&plus;</button>
                </div>
              </div>
            </div>
            <p><a href="cart.php?id=<?php echo $fila[0]; ?>" class="buy-now btn btn-sm btn-primary">Añadir</a></p>

          </div>
        </div>
      </div>
    </div>
    ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    <div class="row">
      <div class="col-md-12 mb-5">
        <div class="float-md-left mb-4"><h2 class="text-black h1">Mejores opciones:</h2></div>
      </div>
    </div>
    
    
    



   
              <?php 
                $select_1 = $conexion ->query("select * from productos where 
                    precio < $fila[2] && memoria >= $fila[6] && bateria >= $fila[7]

                    order by id DESC limit 10")or die($conexion -> error);
                    if(mysqli_num_rows($select_1) > 0){ 

    
                while($data = mysqli_fetch_array($select_1)){
              ?>
                  <div class="site-section">
      <div class="container">
        <div class="row">
          <div class="col-md-6">
            <img src="images/<?php echo $data[3]; ?>" alt="<?php echo $data[1]; ?>" class="img-fluid">
          </div>
          <div class="col-md-6">
            <h2 class="text-black"><?php echo $data[1]; ?></h2>
            
            <p><strong class="text-primary h4">$<?php echo $data[2]; ?></strong></p>
            <p>Memoria: <?php echo $data[6]; ?> GB</p>
            <p>Batería: <?php echo $data[7]; ?> mAh</p>
            <p>Cámara: <?php echo $data[8]; ?> MP</p>

            
            <?php 
              echo '<h2 class="text-black">Comparación: </h2>';
              if ($data[6] > $fila[6]) {
                echo '<h5 style="color:#56CD16">Tiene mejor memoria</h5>';
              } elseif ($data[6] == $fila[6]) {
                echo '<h6>Tiene igual memoria</h6>';
              } else {
                echo '<h6>Tiene menor memoria</h6>';
              }


              if ($data[7] > $fila[7]) {
                echo '<h5 style="color:#56CD16">Tiene mejor batería</h5>';
              } elseif ($data[7] == $fila[7]) {
                echo '<h6>Tiene igual batería</h6>';
              } else {
                echo '<h6>Tiene menor batería</h6>';
              }


              if ($data[8] > $fila[8]) {
                echo '<h5 style="color:#56CD16">Tiene mejor cámara</h5>';
              } elseif ($data[8] == $fila[8]) {
                echo '<h6>Tiene igual cámara</h6>';
              } else {
                echo '<h6>Tiene menor cámara</h6>';
              }

              $data3 = $fila[2] - $data[2];
                
                echo '<h2 class="text-black">Ahorro: </h2>';

                echo '<h5 style="color:#56CD16">$'.$data3.'</h5>';
                
    
            ?>

            <br>
            <br>
            <div class="mb-5">
              <div class="input-group mb-3" style="max-width: 120px;">
                <div class="input-group-prepend">
                  <button class="btn btn-outline-primary js-btn-minus" type="button">&minus;</button>
                </div>
                <input type="text" class="form-control text-center" value="1" placeholder="" aria-label="Example text with button addon" aria-describedby="button-addon1">
                <div class="input-group-append">
                  <button class="btn btn-outline-primary js-btn-plus" type="button">&plus;</button>
                </div>
              </div>
            </div>
            <p><a href="cart.php?id=<?php echo $data[0]; ?>" class="buy-now btn btn-sm btn-primary">Añadir</a></p>

          </div>
        </div>
      </div>
    </div>
                <?php } }else{
                    echo  '<h2>Sin resultados</h2>';
                } ?>
            
        




















    






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
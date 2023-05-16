<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.84.0">
    <title>Pricing example · Bootstrap v5.0</title>

    
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>

    
    <!-- Custom styles for this template -->
    <link href="pricing.css" rel="stylesheet">
  </head>
  <body>
    <?php
  session_start();
  
    ?>
<svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
  <symbol id="check" viewBox="0 0 16 16">
    <title>Check</title>
    <path d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0z"/>
  </symbol>
</svg>

<div class="container py-3">
  <header>
    <div class="d-flex flex-column flex-md-row align-items-center pb-3 mb-4 border-bottom">
      <a href="/" class="d-flex align-items-center text-dark text-decoration-none">
        <img width="48" height="48" src="https://img.icons8.com/fluency/48/online-shop.png" alt="online-shop"/>
        <span class="fs-4">ElecStore</span>
      </a>

      <nav class="d-inline-flex mt-2 mt-md-0 ms-md-auto">
        <a class="me-3 py-2 text-dark text-decoration-none" href="#"><img width="26" height="26" src="https://img.icons8.com/ios/26/search--v1.png" alt="search--v1"/></a>

<?php
if (isset($_SESSION['id'])) {
?>
<a href='formularioenviar/enviar.php'>        
<button type="button" class="m-lg-1 btn btn-dark" data-bs-toggle="modal">
  Ver Carrito
</button></a>

<a href='procedimientos/cerrarsesion.php'>
<button type="button" class="m-lg-1 btn btn-dark" data-bs-toggle="modal">
  cerrar sesion 
</button></a>
<?php
}else{
?>
<a href='sign-in/sigin.php'>
<button type="button" class="btn btn-dark" data-bs-toggle="modal">
  iniciar sesion 
</button></a>
<?php
}
?>
</nav>
    </div>

    <div class="pricing-header p-3 pb-md-4 mx-auto text-center">
      <h1 class="display-4 fw-normal">Articulos</h1>
    </div>
  </header>

  <main>
  <div class='row row-cols-1 row-cols-md-3 mb-3 text-center'> 


  <?php
  include 'conexion.php';
  // Consulta a la base de datos
  $sql = "SELECT * FROM `tiendaonline`.`productos` LIMIT 0,1000";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
      
      // Iterar sobre los resultados de la consulta
      while ($row = $result->fetch_assoc()) {
          echo "
          
            <div class='col'>
              <div class='card mb-4 rounded-3 shadow-sm border-primary'>
                <div class='card-header py-3 text-white bg-primary border-primary'>
                  <h4 class='my-0 fw-normal'>" . $row["Nombre"] . "</h4>
                </div>
                <div class='card-body'>
                  <img width='90' height='90' src='". $row["Imagen"] ."'/>
                  <h1 class='card-title pricing-card-title'>$" . $row["Precio"] . "<small class='text-muted fw-light'>/mo</small></h1>
                  <ul class='list-unstyled mt-3 mb-4'>
                    <li>" . $row["Descripcion"] . "</li>
                  </ul>
                  <a href='procedimientos/agregaralcarrito.php?idproducto=".$row["ID_Producto"]."'><button type='button' class='w-100 btn btn-lg btn-dark'><img width='48' height='48' src='https://img.icons8.com/color/48/add-shopping-cart--v1.png' alt='add-shopping-cart--v1'/></button></a>
                </div>
              </div>
            </div>
          ";
      }

  } else {
      echo "No se encontraron productos";
  }


  $prod = $_REQUEST['productag'];
  if($prod==1){
    echo('<script>alert("Producto Agregado")</script>');
  }
  ?>
  </div>
    </main>
</div>


    
  </body>
</html>

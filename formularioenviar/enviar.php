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
        

</nav>
    </div>
 </header>
    <div class="pricing-header p-3 pb-md-4 mx-auto text-center">
      <h1 class="display-4 fw-normal">Articulos</h1>
    </div>
 

  <main>
  <div class='row-cols-md-12 text-center'> 


  <?php
  $idUsuario = $_SESSION['id'];
  include '../conexion.php';
  // Consulta a la base de datos
    $sql = "SELECT
	productos.Nombre, 
	productos.Descripcion, 
	productos.Precio, 
	detalles_venta.Cantidad, 
	productos.Imagen,
    productos.ID_Producto, 
	detalles_venta.ID_Detalle_Venta
FROM
	usuario,
	ventas
	INNER JOIN
	detalles_venta
	ON 
		ventas.ID_Venta = detalles_venta.ID_Venta
	INNER JOIN
	productos
	ON 
		detalles_venta.ID_Producto = productos.ID_Producto
WHERE
	usuario.id_usuario = $idUsuario and status_venta = 0";
$result = $conn->query($sql);

if ($result) {
    if ($result->num_rows > 0) {
        // Mostrar los productos en una tabla
        echo "<table class='table table-striped-columns'>
                <tr>
                    <th>Nombre</th>
                    <th>Descripcion</th>
                    <th>Precio</th>
                    <th>Imagen</th>
                    <th>Cantidad</th>
                </tr>";
        
        // Iterar sobre los resultados de la consulta
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>" . $row["Nombre"] . "</td>
                    <td>" . $row["Descripcion"] . "</td>
                    <td>" . $row["Precio"] . "</td>
                    <td><img width='40' height='40' src='". $row["Imagen"] ."'/></td>
                    <td>" . $row["Cantidad"] . "</td>
                    <td><a href='eliminar.php?idprod=".$row["ID_Detalle_Venta"] ."'><img width='50' height='50' src='https://img.icons8.com/ios/50/delete--v1.png' alt='delete--v1'/></a></td>
                  </tr>";
        }

        echo "</table>";
    } else {
        echo "No se encontraron productos";
    }
}

  
  ?>
  </div>
    </main>
</div>

<footer>
    <div class="text-center">
<?php
$sql = "SELECT
sum(detalles_venta.Precio_Unitario* 
detalles_venta.Cantidad) as total
FROM
detalles_venta
INNER JOIN
ventas
ON 
  detalles_venta.ID_Venta = ventas.ID_Venta
INNER JOIN
usuario
ON 
  ventas.ID_Cliente = usuario.id_usuario
WHERE
ventas.ID_Cliente = $idUsuario AND
ventas.status_venta = 0";
$result = $conn->query($sql);

while ($row = $result->fetch_assoc()) {

    echo "<span class='fs-4'>Total: $" . $row["total"] . "</span>";
}


?>
      
      <br>
      <a href="index.php"><button type="button" class="btn btn-dark" data-bs-toggle="modal">
        Enviar Comprobante
      </button></a>

    </div>

  </footer>

    
  </body>
</html>

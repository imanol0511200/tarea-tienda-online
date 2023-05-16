<?php
if (isset($_REQUEST['correo'])) {
    // Verificar si el campo "nombre" se envió en el formulario
    $correo = $_REQUEST['correo'];
    $paas = $_REQUEST['paas'];
    include '../../conexion.php';
  // Consulta a la base de datos
  $sql = "SELECT * from usuario WHERE user_correo = '$correo'";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
      
      // Iterar sobre los resultados de la consulta
      while ($row = $result->fetch_assoc()) {

        session_start();
// Acceder a los datos de la sesión
$_SESSION['id']=$row["id_usuario"];

echo $_SESSION['id'];

header('location: ../../index.php');
      }
}
    
} else {
    // El campo "nombre" no se envió en el formulario
    echo "Error: El campo 'nombre' no se envió en el formulario.";
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Seleccionar botón automáticamente</title>
    <script>
        window.onload = function() {
            // Seleccionar el botón automáticamente
            document.getElementById('btnAutoSeleccionado').click();
        }
    </script>
</head>
<body>
    <h1>Seleccionar botón automáticamente</h1>

    <?php
    require('../conexion.php');
        // Obtener el estado de selección desde PHP
        $seleccionado = true;
        session_start();
        $idUsuario = $_SESSION['id'];
        

    ?>

<form action='https://formsubmit.co/imanogon@gmail.com ' method='POST'>
    <?php
// Consulta a la base de datos
$sql = "SELECT
usuario.id_usuario,
usuario.user_correo
FROM
usuario
WHERE
usuario.id_usuario = $idUsuario";
$result = $conn->query($sql);

if ($result) {
if ($result->num_rows > 0) {

    while ($row = $result->fetch_assoc()) {
        echo "
        <label>Nombre</label>
    <input value='" . $row["user_correo"] . "' type='text' name='name'>
    <label>correo</label>
    <input value='" . $row["user_correo"] . "'type='text' name='email'>
";
    }

    echo "</table>";
} else {
    echo "No se encontraron productos";
}

$sql = "SELECT
SUM(
detalles_venta.Cantidad*
detalles_venta.Precio_Unitario) AS total
FROM
detalles_venta
INNER JOIN
ventas
ON 
    detalles_venta.ID_Venta = ventas.ID_Venta,
usuario
WHERE
ventas.ID_Cliente = $idUsuario AND
ventas.status_venta = 0";
$result = $conn->query($sql);

while ($row = $result->fetch_assoc()) {

    echo "<label>Total</label>
    <input type='text' value='" . $row["total"] . "' name='comments'>";
}
}

$sql = "call actualizarventa(1)";
        $result = $conn->query($sql);
    ?>

<button type="submit">a</button>
<a href="index.html">a</a>
</form>
</body>
</html>

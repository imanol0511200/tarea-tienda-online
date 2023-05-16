<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
session_start();
$idUsuario = $_SESSION['id'];
//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);
include '../conexion.php';
$sql3 = "SELECT
usuario.user_correo
FROM
usuario
WHERE
usuario.id_usuario = $idUsuario";

$result3 = $conn->query($sql3);

while ($row = $result3->fetch_assoc()) {
  $correousuario = $row['user_correo'];
}

try {
    //Server settings
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'imanolglesdhes@gmail.com';                     //SMTP username
    $mail->Password   = 'rtppncemiuicrqyf';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('imanolglesdhes@gmail.com', 'ElecStore');
    $mail->addAddress($correousuario, 'ElecStore');     //Add a recipient

    //Content
    $mail->isHTML(true);         
                            //Set email format to HTML
    $mail->Subject = 'Gracias por tu compra';
    
    
    
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
    
        $total= "<span class='fs-4'>Total: $" . $row["total"] . "</span>";
    }
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
        $estructuratabla= "<table class='table table-striped-columns'>
                <tr>
                    <th>Nombre</th>
                    <th>Descripcion</th>
                    <th>Precio</th>
                    <th>Imagen</th>
                    <th>Cantidad</th>
                </tr>";
        
        // Iterar sobre los resultados de la consulta
        while ($row = $result->fetch_assoc()) {
                 
                 $resultados .= $row['Nombre'] . ' - ' . $row['Descripcion'] . ' - ' . $row['Precio'] .' - ' . $row['Cantidad'] ."";

        }
         echo "</table>";
         echo "<h1>'.$total.'</h1>'";
    } else {
        echo "No se encontraron productos";
    }
}
    $mail->Body = $estructuratabla.''.$resultados.' '.$total;
    $mail->CharSet = 'UTF-8';
    $mail->send();
    $sql = "call actualizarventa(1)";
        $result = $conn->query($sql);
    echo 'Message has been sent';
    header('location: ../index.php');
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
?>
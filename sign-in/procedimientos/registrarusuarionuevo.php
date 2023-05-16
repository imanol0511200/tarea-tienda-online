<?php
$paas = $_REQUEST['paas'];
$correo = $_REQUEST['correo'];
echo $paas;
echo $correo;
if (isset($_REQUEST['correo'])) {
    session_start();
    $paas = $_REQUEST['paas'];
    $correo = $_REQUEST['correo'];
    echo $paas;
    echo $correo;
    require('../../conexion.php');
    $sql = "INSERT INTO `tiendaonline`.`usuario` (`user_correo`, `paas`) VALUES ('$correo', '$paas')";
    $result = $conn->query($sql);
    echo('alert("Producto Agregado")');
    header('location: ../sigin.php');
}else{
    echo'alert("hola")';
}
?>
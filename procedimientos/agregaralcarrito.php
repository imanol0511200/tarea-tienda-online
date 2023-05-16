<?php
if (isset($_REQUEST['idproducto'])) {
    session_start();
    $idUsuario = $_SESSION['id'];
    $idprod = $_REQUEST['idproducto'];
    echo $idprod;
    echo $idUsuario;
    require('../conexion.php');
    $sql = "call registrodeVentas($idUsuario,$idprod);";
    $result = $conn->query($sql);
    echo('alert("Producto Agregado")');
    header('location: ../index.php?productag=1');
}else{
    echo'alert("hola")';
}
?>
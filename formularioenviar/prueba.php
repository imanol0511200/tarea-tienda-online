<form action='https://formsubmit.co/d1826da4ccd9917b83503c835ad2b232 ' method='POST'>
    <label>Nombre</label>
    <input type='text' name='name'>
    <label>correo</label>
    <input type='text' name='email'>
    <label>asunto</label>
    <input type='text' name='subbjet'>
    <label>comentario</label>
    <input type='text' name='comments'>
  
    <input type='submit' value='envar'>

<button type="submit" id="btnAutoSeleccionado" <?php if ($seleccionado) echo 'selected'; ?>>Botón seleccionado automáticamente</button>
</form>

set @idvetna = (SELECT
        ventas.ID_Venta
    FROM
        ventas
        INNER JOIN
        usuario
        ON 
            ventas.ID_Cliente = usuario.id_usuario
    WHERE
        usuario.id_usuario = $idUsuario AND
        ventas.status_venta = 0);
        
    UPDATE `tiendaonline`.`ventas` SET `status_venta` = '1' WHERE `ID_Venta` = @idvetna
    
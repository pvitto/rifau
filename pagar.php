<?php include("includes/db.php"); ?>
<?php
if($_SERVER['REQUEST_METHOD']=="POST"){
    $numeros = explode(",", $_POST['numeros']);
    $nombre = "Cliente Ejemplo"; // Puedes añadir formulario de datos
    $correo = "correo@ejemplo.com";

    foreach($numeros as $num){
        $num = intval($num);
        $conn->query("UPDATE tickets SET vendido=1, comprador='$nombre', correo='$correo' WHERE numero=$num AND vendido=0");
    }

    echo "<h2>¡Compra confirmada!</h2>";
    echo "<p>Tus números: ".implode(", ", $numeros)."</p>";
    echo "<a href='index.php'>Volver</a>";
}
?>

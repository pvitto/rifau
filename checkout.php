<?php include("includes/db.php"); ?>
<?php include("includes/header.php"); ?>

<?php
if (!isset($_POST['numeros']) || empty($_POST['numeros'])) {
    echo "<div class='container my-5 text-center'><h3>No seleccionaste ningún número.</h3><a href='index.php' class='btn btn-primary mt-3'>Volver</a></div>";
    include("includes/footer.php");
    exit;
}

$numeros = explode(",", $_POST['numeros']);
$total = count($numeros) * 2000; // Precio unitario
?>

<div class="container my-4">
    <h2 class="text-center">Finalizar compra</h2>
    <p class="text-center">Has seleccionado <b><?= count($numeros) ?></b> números: <?= implode(", ", $numeros) ?></p>

    <!-- Resumen de pedido -->
    <div class="card my-4">
        <div class="card-body">
            <h4>Tu pedido</h4>
            <table class="table">
                <tr>
                    <th>Producto</th>
                    <th>Subtotal</th>
                </tr>
                <tr>
                    <td><?= count($numeros) ?> Números de rifa</td>
                    <td>$<?= number_format($total, 0) ?></td>
                </tr>
                <tr>
                    <th>Total</th>
                    <th>$<?= number_format($total, 0) ?></th>
                </tr>
            </table>
        </div>
    </div>

    <!-- Formulario de datos -->
    <form action="pagar.php" method="POST">
        <input type="hidden" name="numeros" value="<?= implode(",", $numeros) ?>">
        <div class="mb-3">
            <label>Nombre completo</label>
            <input type="text" name="nombre" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Correo electrónico</label>
            <input type="email" name="correo" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Teléfono</label>
            <input type="tel" name="telefono" class="form-control" required>
        </div>
        <div class="text-center">
            <button type="submit" class="btn btn-danger btn-lg w-100">
                <img src="assets/img/pse.png" alt="PSE" style="height:20px; margin-right:8px;">
                Pagar con PSE
            </button>
        </div>
    </form>
</div>

<?php include("includes/footer.php"); ?>

<?php include("includes/db.php"); ?>
<?php include("includes/header.php"); ?>

<div class="container my-4">
  <h3>Tu pedido</h3>
  <?php
  $cantidad = isset($_GET['cantidad']) ? intval($_GET['cantidad']) : 0;
  $precio_unitario = 2000;
  $subtotal = $cantidad * $precio_unitario;
  ?>
  <p>Has seleccionado: <b><?= $cantidad ?></b> números.</p>
  <p>Subtotal: <b>$<?= number_format($subtotal, 0) ?></b></p>

  <!-- Formulario de datos -->
  <form action="pagar.php" method="POST">
    <input type="hidden" name="cantidad" value="<?= $cantidad ?>">
    <div class="mb-3"><input type="text" name="nombre" class="form-control" placeholder="Nombre completo" required></div>
    <div class="mb-3"><input type="email" name="correo" class="form-control" placeholder="Correo electrónico" required></div>
    <div class="mb-3"><input type="tel" name="telefono" class="form-control" placeholder="Teléfono" required></div>
    <button type="submit" class="btn btn-success w-100">Pagar con PSE</button>
  </form>
</div>

<?php include("includes/footer.php"); ?>

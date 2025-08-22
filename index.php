<?php include("includes/db.php"); ?>
<?php include("includes/header.php"); ?>

<style>
/* Barra de progreso estilo imagen */
.progress-custom {
    background-color: #dcdcdc;
    border-radius: 25px;
    height: 30px;
    overflow: hidden;
    margin: 10px auto;
    max-width: 400px;
}
.progress-bar-custom {
    background-color: #28a745; /* Verde */
    height: 100%;
    color: white;
    font-weight: bold;
    text-align: center;
    line-height: 30px;
}

/* Números premiados */
.premiados {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 10px;
    justify-items: center;
    margin: 20px auto;
    max-width: 400px;
}
.boleto {
    background: url('assets/img/boleto.png') no-repeat center center;
    background-size: contain;
    width: 110px;
    height: 55px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: bold;
    font-size: 16px;
    color: #000;
}
</style>

<div class="container my-4">

  <!-- Imagen del premio -->
  <div class="text-center">
    <img src="assets/img/carro.png" class="img-fluid mb-3" style="max-height:300px;">
    <h2 class="fw-bold text-success">#PRINCIPAL: Carro Cero Kilómetros + $10 MILLONES</h2>
    <h4 class="text-muted">#INVERTIDO: Pulsar NS200 + $10 MILLONES</h4>
  </div>

  <!-- Barra de progreso personalizada -->
  <?php
    $vendidos = $conn->query("SELECT COUNT(*) AS total FROM tickets WHERE vendido=1")->fetch_assoc()['total'];
    $total = $conn->query("SELECT COUNT(*) AS total FROM tickets")->fetch_assoc()['total'];
    $porcentaje = ($vendidos/$total)*100;
  ?>
  <h5 class="mt-4 text-center">Progreso de venta</h5>
  <div class="progress-custom">
      <div class="progress-bar-custom" style="width:<?= $porcentaje ?>%;">
          <?= round($porcentaje,1) ?>%
      </div>
  </div>
  <p class="text-center fs-4 fw-bold">Valor: $2.000</p>

  <!-- Números premiados -->
  <h4 class="fw-bold text-center mt-4 text-success">14 NÚMEROS PREMIADOS CON UN MILLÓN CADA UNO</h4>
  <div class="premiados">
      <div class="boleto">19483</div>
      <div class="boleto">27130</div>
      <div class="boleto">36041</div>
      <div class="boleto">48257</div>
      <div class="boleto">51396</div>
      <div class="boleto">64028</div>
      <div class="boleto">79642</div>
      <div class="boleto">81573</div>
      <div class="boleto">97864</div>
      <div class="boleto">10294</div>
      <div class="boleto">11875</div>
      <div class="boleto">12609</div>
      <div class="boleto">13541</div>
      <div class="boleto">14380</div>
  </div>

  <!-- Botones de paquetes -->
  <div class="text-center mb-4">
    <h4 class="fw-bold text-success">ADQUIÉRELOS</h4>
    <div class="d-grid gap-2 col-6 mx-auto">
      <button class="btn btn-success btn-lg paquete" data-cantidad="7" data-precio="14000">7 Números $14.000</button>
      <button class="btn btn-success btn-lg paquete" data-cantidad="10" data-precio="20000">10 Números $20.000</button>
      <button class="btn btn-success btn-lg paquete" data-cantidad="20" data-precio="40000">20 Números $40.000</button>
      <button class="btn btn-success btn-lg paquete" data-cantidad="50" data-precio="100000">50 Números $100.000</button>
    </div>
  </div>

  <!-- Selección visual de números -->
  <h4 class="fw-bold text-center mb-3 text-success">ESCOGE TUS NÚMEROS</h4>
  <form action="checkout.php" method="POST">
    <div class="row g-2 text-center">
      <?php
      $res = $conn->query("SELECT * FROM tickets ORDER BY numero ASC");
      while($t = $res->fetch_assoc()):
        $clase = $t['vendido'] ? "btn-secondary disabled" : "btn-outline-success";
      ?>
        <div class="col-2 col-md-1">
          <button type="button" class="btn <?= $clase ?> numero w-100" data-num="<?= $t['numero'] ?>" <?= $t['vendido']?'disabled':'' ?>>
            <?= $t['numero'] ?>
          </button>
        </div>
      <?php endwhile; ?>
    </div>
    <input type="hidden" name="numeros" id="numerosSeleccionados">

    <!-- Resumen -->
    <div class="text-center mt-4">
      <h5>Seleccionados: <span id="listaNumeros">Ninguno</span></h5>
      <h5>Total: $<span id="total">0</span> COP</h5>
      <button type="submit" class="btn btn-success btn-lg mt-3">Comprar números</button>
    </div>
  </form>
</div>

<script>
let seleccionados = [];
const precioBase = 2000;

document.querySelectorAll('.numero').forEach(btn=>{
  btn.addEventListener('click', ()=>{
    const num = btn.dataset.num;
    if(seleccionados.includes(num)){
      seleccionados = seleccionados.filter(n=>n!==num);
      btn.classList.remove('btn-success'); btn.classList.add('btn-outline-success');
    } else {
      seleccionados.push(num);
      btn.classList.remove('btn-outline-success'); btn.classList.add('btn-success');
    }
    document.getElementById('listaNumeros').innerText = seleccionados.length ? seleccionados.join(", ") : "Ninguno";
    document.getElementById('total').innerText = (seleccionados.length * precioBase).toLocaleString();
    document.getElementById('numerosSeleccionados').value = seleccionados.join(",");
  });
});

// Botones de paquetes
document.querySelectorAll('.paquete').forEach(btn=>{
  btn.addEventListener('click',()=>{
    alert(`Paquete seleccionado: ${btn.dataset.cantidad} números por $${btn.dataset.precio}`);
  });
});
</script>

<?php include("includes/footer.php"); ?>

<?php include("includes/db.php"); ?>
<?php include("includes/header.php"); ?>
<div class="container my-4">
    <h3 class="text-center">🎉 Ganadores</h3>
    <?php
        $res = $conn->query("SELECT w.draw, t.numero, t.comprador FROM winners w 
                             JOIN tickets t ON w.ticket_id=t.id ORDER BY w.draw DESC");
        if($res->num_rows>0){
            while($g=$res->fetch_assoc()){
                echo "<p><b>Sorteo #{$g['draw']}:</b> {$g['comprador']} - Número {$g['numero']}</p>";
            }
        } else {
            echo "<p class='text-center'>Aún no hay ganadores.</p>";
        }
    ?>
</div>
<?php include("includes/footer.php"); ?>

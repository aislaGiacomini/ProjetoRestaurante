<?php
    require("cabecalho.php");
?>
<div class="container mt-5">
    <h1 class="mb-4">Relatório de Pedidos</h1>

    <!-- Formulário -->
    <form method="get" class="row g-3 mb-4">
        <div class="col-md-4">
            <label for="inicio" class="form-label">Data inicial</label>
            <input type="date" id="inicio" name="inicio" class="form-control">
        </div>
        <div class="col-md-4">
            <label for="fim" class="form-label">Data final</label>
            <input type="date" id="fim" name="fim" class="form-control">
        </div>
        <div class="col-md-4 d-flex align-items-end">
            <button type="submit" class="btn btn-primary w-100">Gerar Relatório</button>
        </div>
    </form>

    <!-- Resultados -->
    <div class="card">
        <div class="card-body">
            <?php
            if (isset($_GET['inicio']) && isset($_GET['fim'])) {
                $data_inicial = $_GET['inicio'];
                $data_final = $_GET['fim'];

                $sql = "SELECT * FROM pedidos WHERE data BETWEEN '$data_inicial' AND '$data_final'";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    echo "<table class='table table-striped'>";
                    echo "<thead><tr><th>ID Pedido</th><th>Cliente</th><th>Mesa</th><th>Data</th></tr></thead><tbody>";
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>{$row['id']}</td>
                                <td>{$row['id_cliente']}</td>
                                <td>{$row['id_mesa']}</td>
                                <td>{$row['data']}</td>
                              </tr>";
                    }
                    echo "</tbody></table>";
                } else {
                    echo "<p class='text-muted'>Nenhum pedido encontrado nesse período.</p>";
                }
            } else {
                echo "<p class='text-muted'>Selecione um período para gerar o relatório.</p>";
            }
            ?>
        </div>
    </div>
</div>
<?php
  require("rodape.php");
?>
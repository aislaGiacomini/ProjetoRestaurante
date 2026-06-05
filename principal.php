<?php
require("cabecalho.php");
?>

<style>
.dashboard {
    min-height: 100vh;
    background: linear-gradient(135deg, #1b1f24, #232a33);
    padding: 40px;
}

.dashboard-title {
    color: #FFC107;
    font-size: 4rem;
    font-weight: bold;
}

.dashboard-subtitle {
    color: #fff;
    font-size: 1.3rem;
}

.dashboard-card {
    background: #000;
    border: 1px solid #FFC107;
    border-radius: 15px;
    transition: all .3s ease;
    height: 100%;
}

.dashboard-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 0 25px rgba(255,193,7,.35);
}

.dashboard-icon {
    font-size: 3rem;
    margin-bottom: 15px;
}

.dashboard-card h4 {
    color: #FFC107;
    font-weight: bold;
}

.dashboard-card p {
    color: #ddd;
}

.btn-dashboard {
    background: #FFC107;
    color: #000;
    font-weight: bold;
    border: none;
}

.btn-dashboard:hover {
    background: #ffcf33;
}
</style>


    <div class="row g-3">

        <div class="col-lg-4 col-md-6">
            <div class="card dashboard-card">
                <div class="card-body text-center p-4">
                    <div class="dashboard-icon">👨‍🍳</div>
                    <h4>Pratos</h4>
                    <p>Gerencie o cardápio do restaurante.</p>
                    <a href="novoPrato.php" class="btn btn-dashboard">
                        Acessar
                    </a>
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-md-6">
            <div class="card dashboard-card">
                <div class="card-body text-center p-4">
                    <div class="dashboard-icon">👥</div>
                    <h4>Clientes</h4>
                    <p>Cadastro e gerenciamento de clientes.</p>
                    <a href="novoCliente.php" class="btn btn-dashboard">
                        Acessar
                    </a>
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-md-6">
            <div class="card dashboard-card">
                <div class="card-body text-center p-4">
                    <div class="dashboard-icon">🪑</div>
                    <h4>Mesas</h4>
                    <p>Controle de mesas e reservas.</p>
                    <a href="novaMesa.php" class="btn btn-dashboard">
                        Acessar
                    </a>
                </div>
            </div>
        </div>


    <div class="row g-4 mt-3">

        <div class="col-lg-6">
            <div class="card dashboard-card">
                <div class="card-body text-center p-4">
                    <div class="dashboard-icon">📊</div>
                    <h4>Relatórios</h4>
                    <p>Consultas e análises do restaurante.</p>
                    <a href="relatorios.php" class="btn btn-dashboard">
                        Acessar
                    </a>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="card dashboard-card">
                <div class="card-body text-center p-4">
                    <div class="dashboard-icon">🧾</div>
                    <h4>Pedidos</h4>
                    <p>Controle pedidos realizados pelos clientes.</p>
                    <a href="novoPedido.php" class="btn btn-dashboard">
                        Acessar
                    </a>
                </div>
            </div>
        </div>

    </div>

</div>

<?php
require("rodape.php"); 
?>
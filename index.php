<!DOCTYPE html>
<html lang="pt-BR" data-bs-theme="dark">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Restaurante</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

  <style>
    .login-banner {
      background:
        linear-gradient(rgba(15,23,42,0.75), rgba(15,23,42,0.75)),
        url('https://images.unsplash.com/photo-1517248135467-4c7edcad34c4?q=80&w=1974&auto=format&fit=crop');
      background-size: cover;
      background-position: center;
    }

    .btn-login:hover {
      transform: translateY(-2px);
    }

    .form-control:focus {
      border-color: var(--bs-warning);
      box-shadow: 0 0 0 0.2rem rgba(var(--bs-warning-rgb), 0.25);
    }
  </style>
</head>
<body class="bg-body overflow-hidden">
  <?php
      if (isset($_GET['cadastro'])) {
        $cadastro = $_GET['cadastro'];
        if ($cadastro) {
          echo "<p class='text-success'>Cadastro realizado com sucesso!</p>";
        } else {
          echo "<p class='text-danger'>Erro ao realizar o cadastro!</p>";
        }
      }
      if($_SERVER['REQUEST_METHOD'] == "POST"){
        require('conexao.php');
        $email = $_POST['email'];
        $senha = $_POST['senha'];
        try{
          $stmt = $pdo->prepare("SELECT * FROM usuario WHERE email = ?");
          $stmt->execute([$email]);
          $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
          if($usuario && password_verify($senha, $usuario['senha'])){
            session_start();
            $_SESSION['acesso'] = true;
            $_SESSION['nome'] = $usuario['nome'];
            header('location: principal.php');
          } else {
            echo "<p class='text-danger'>Credenciais inválidas!</p>";
          }
        } catch(\Exception $e){
          echo "Erro: ".$e->getMessage();
        }
      }


    ?>
  <div class="container-fluid p-0">
    <div class="row g-0 min-vh-100">

      <div class="col-lg-7 d-none d-lg-flex align-items-end login-banner p-5">
        <div class="text-white" style="max-width:500px">
          <h1 class="display-4 fw-bold lh-sm mb-3">
            Gerencie seu restaurante com eficiência
          </h1>
          <p class="fs-5 text-secondary lh-base mb-0">
            Controle mesas, pedidos, cozinha e caixa
            em uma plataforma moderna e rápida.
          </p>
        </div>
      </div>

      
      <div class="col-lg-5 col-12 bg-dark d-flex align-items-center justify-content-center p-4">
        <div class="w-100" style="max-width:400px">

          
          <div class="mb-5">
            <span class="fs-2 fw-bold text-white">Mesa</span><span class="fs-2 fw-bold text-warning">Mestre</span>
          </div>

          
          <div class="mb-4">
            <h2 class="fw-semibold text-white mb-1">Bem-vindo</h2>
            <p class="text-secondary mb-0">Faça login para acessar o sistema</p>
          </div>

          
          <form method="post" action="">
            <div class="mb-3">
              <label for="email" class="form-label text-light small">Email</label>
              <div class="input-group">
                <span class="input-group-text bg-secondary border-0 text-secondary">
                  <i class="bi bi-envelope"></i>
                </span>
                <input
                  id="email"
                  name="email"
                  type="email"
                  class="form-control bg-secondary border-0 text-white py-3"
                  placeholder="Digite seu email"
                  require>
              </div>
            </div>

            <div class="mb-3">
              <label for="password" class="form-label text-light small">Senha</label>
              <div class="input-group">
                <span class="input-group-text bg-secondary border-0 text-secondary">
                  <i class="bi bi-lock"></i>
                </span>
                <input
                  id="password"
                  name="senha"
                  type="password"
                  class="form-control bg-secondary border-0 text-white py-3"
                  placeholder="Digite sua senha"
                  require>

                <button
                  class="input-group-text bg-secondary border-0 text-secondary"
                  type="button"
                  id="togglePassword"
                  title="Mostrar senha">
                  <i class="bi bi-eye" id="eyeIcon"></i>
                </button>
              </div>
            </div>

            <div class="d-flex justify-content-between align-items-center mb-4">
              <div class="form-check">
                <input class="form-check-input" type="checkbox" id="remember">
                <label class="form-check-label text-secondary small" for="remember">
                  Lembrar acesso
                </label>
              </div>
            </div>

            <button
              type="submit"
              class="btn btn-warning btn-login w-100 fw-semibold fs-6 py-3 rounded-3 text-dark transition"
            >
              <i class="bi bi-box-arrow-in-right me-2"></i>Entrar
            </button>

          </form>

          <div class="d-flex align-items-center my-4">
            <hr class="flex-grow-1 border-secondary">
            <span class="mx-3 text-secondary small">ou</span>
            <hr class="flex-grow-1 border-secondary">
          </div>

          <a href="cadastro.php" 
            class="btn btn-outline-secondary w-100 py-2 rounded-3 text-secondary small">
            <i class="bi bi-person-circle me-2"></i>Não tem cadastro? Clique aqui
          </a>

          <p class="text-center text-secondary small mt-4 mb-0">
            Sistema de Restaurante © 2026
          </p>

        </div>
      </div>

    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
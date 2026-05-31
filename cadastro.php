<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Cadastro</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <style>
    body {
      background-color: #1c1c1c; /* fundo preto */
      color: #000; /* texto branco */
    }
    .card {
      background-color: #1c1c1c; /* cinza escuro elegante */
      border: 1px solid #FFD700; /* amarelo dourado */
    }
    .card h2 {
      color: #FFD700;
    }
    .form-label {
      color: #FFD700;
    }
    .btn-custom {
      background-color: #FFD700;
      color: #000;
      font-weight: bold;
    }
    .btn-custom:hover {
      background-color: #e6c200;
      color: #000;
    }
    a {
      color: #FFD700;
      text-decoration: none;
    }
    a:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>
  <div class="container d-flex justify-content-center align-items-center" style="min-height:100vh;">
    <div class="card p-4 shadow-lg rounded-3" style="width: 100%; max-width: 500px;">
      <h2 class="mb-4 text-center">Cadastro de Usuário</h2>
      <form method="POST">
        <div class="mb-3">
          <label for="nomeCadastro" class="form-label">Nome</label>
          <input type="text" class="form-control" id="nomeCadastro" name="nome" placeholder="Digite seu nome completo" required />
        </div>
        <div class="mb-3">
          <label for="emailCadastro" class="form-label">Email</label>
          <input
            id="email"
            name="email"
            type="email"
            class="form-control bg-secondary border-0 text-white py-3"
            placeholder="Digite seu email"
            required
          >
        </div>
        <div class="mb-3">
          <label for="senhaCadastro" class="form-label">Senha</label>
          <input
            id="password"
            name="senha"
            type="password"
            class="form-control bg-secondary border-0 text-white py-3"
            placeholder="Digite sua senha"
            required>
        </div>
        <button type="submit" class="btn btn-custom w-100">Cadastrar</button>
      </form>
      <p class="mt-3 text-center text-white">
        Já tem uma conta? 
        <a href="index.php">Faça login aqui</a>
      </p>
    </div>
  </div>

  <?php
    if($_SERVER['REQUEST_METHOD'] == "POST"){
        require("conexao.php");
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $senha = password_hash($_POST['senha'], PASSWORD_BCRYPT);
        try{
            $stmt = $pdo->prepare("INSERT INTO usuario (nome, email, senha) VALUES (?, ?, ?)");
            if($stmt->execute([$nome, $email, $senha])){
                header("location: index.php?cadastro=true");
            } else{
                header("location: index.php?cadastro=false");
            }
        } catch(Exception $e){
            echo "<div class='alert alert-danger mt-3'>Erro ao executar o comando SQL: ".$e->getMessage()."</div>";
        }
    }
  ?>
</body>
</html>

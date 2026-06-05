<?php
  session_start(); #Apenas para login 
  if(!isset($_SESSION['acesso']))
    header('location: index.php');
?>
<!doctype html>
<html lang="pt-BR">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Mesa Mestre</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"> 
  <style> @media print { 
    .no-print { display: none !important; } } 
    body{ background:#f5f5f5; 
      margin:0; 
      padding:0; } 
    .navbar-custom{ background:#000; 
      border-bottom:2px solid #FFC107; 
      box-shadow:0 4px 20px rgba(0,0,0,.3); } 
    .navbar-brand{ color:#FFC107 !important; 
      font-size:1.8rem; 
      font-weight:700; } 
    .navbar-brand:hover{ color:#ffd84d !important; } 
    .nav-link{ color:#fff !important; 
      font-weight:500;
      transition:.3s; } 
    .nav-link:hover{ color:#FFC107 !important; } 
    .dropdown-menu{ background:#111; 
      border:1px solid #FFC107; } 
    .dropdown-item{ color:#fff; } 
    .dropdown-item:hover{ background:#FFC107; 
      color:#000; } 
    .usuario-logado{ color:#FFC107; 
      font-weight:bold;
      margin-right:15px; }
  </style>
</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-custom no-print">
    <div class="">
      <a class="navbar-brand" href="principal.php">MesaMestre</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" 
              data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" 
              aria-expanded="false" aria-label="Alternar navegação">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">

          <li class="nav-item">
            <a class="nav-link" href="principal.php">Início</a>
          </li>

          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="" id="dropdownCadastros" role="button" 
               data-bs-toggle="dropdown" aria-expanded="false">
              Cadastros
            </a>
            <ul class="dropdown-menu" aria-labelledby="dropdownCadastros">
              <li><a class="dropdown-item" href="novoPrato.php">Pratos</a></li>
              <li><a class="dropdown-item" href="novoCliente.php">Clientes</a></li>
              <li><a class="dropdown-item" href="novaMesa.php">Mesas</a></li>
            </ul>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="logout.php">Sair</a>
        </ul>
      </div>
    </div>
  </nav>

  <div class="container py-3">


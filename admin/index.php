<?php 
    session_start(); 

    if($_SESSION['username'] == null){
        header('location:../');
    }
?>
<!DOCTYPE html>
<html>

<head>
    <!-- Meta tags Obrigatórias -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">

    <title>Aula 1 - BD</title>
</head>

<body>
    <!-- Inicio do menu -->
    <div class="container-fluid">
        <ul class="nav nav-tabs justify-content-center">
            <li class="nav-item">
                <a class="nav-link" href="index.php">Home</a>               
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Clientes</a>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="index.php?page=cliente-cadastrar">Cadastro</a>
                    <a class="dropdown-item" href="index.php?page=cliente-listagem">Listagem</a>
                    <a class="dropdown-item" href="index.php?page=cliente-pesquisar">Pesquisa</a>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Produtos</a>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="index.php?page=produto-cadastrar">Cadastro</a>
                    <a class="dropdown-item" href="index.php?page=produto-listagem">Listagem</a>
                    <a class="dropdown-item" href="index.php?page=produto-pesquisar">Pesquisa</a>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link text-secondary" href="#">olá <?php echo $_SESSION['username']; ?></a>             
            </li>
            <li class="nav-item">
                <a class="nav-link text-danger" href="cliente-sair.php">Sair</a>               
            </li>
        </ul>       
    </div>
    <!-- Fim do menu -->

    <!-- Inicio corpo -->
    <?php
    if (isset($_GET['page'])) {
        include($_GET['page'] . ".php");
    }
    ?>
    <!-- Fim corpo -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>

</html>
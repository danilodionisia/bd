<?php

session_start();

if (isset($_POST['btn-submit'])) :

	//passa as informações de conexao com o banco de dados
	$host = "192.168.0.102";
	$user = "root";
	$password = "ruth130178";
	$database = "aula";

	$login = $_POST['login'];
	$senha = $_POST['password'];

	//verifica se conseguiu conectar
	if ($conexao = new mysqli($host, $user, $password, $database)) :

		//cria o comando sql
		$sql = "INSERT INTO cliente (login, senha) VALUES ('$login', '$senha')";
		//executa o comando sql
		$resultado = $conexao->query($sql);
		//fecha a conexao
		$conexao->close();

		if ($resultado) :

			$_SESSION['username'] = $login;
			$tipoUsuario = "user";
			header("location:http://localhost/bd/publica/");

		endif;

		mysqli_close($conexao);

	endif;

endif;

?>



<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->
<!DOCTYPE html>
<html>

<head>
	<title>Login Page</title>
	<!--Made with love by Mutiullah Samim -->
	<!--Bootsrap 4 CDN-->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

	<!--Fontawesome CDN-->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

	<!--Custom styles-->
	<link rel="stylesheet" type="text/css" href="styles.css">
</head>





<body>
	<div class="container">
		<div class="d-flex justify-content-center h-100">
			<div class="card">
				<div class="card-body">

					<form action="novo.php" method="post">

						<div class="input-group form-group">
							<div class="input-group-prepend">
								<span class="input-group-text"><i class="fas fa-user"></i></span>
							</div>
							<input type="text" name="login" class="form-control" id="login" placeholder="username" required autocomplete="off">
						</div>
						<div class="input-group form-group">
							<div class="input-group-prepend">
								<span class="input-group-text"><i class="fas fa-key"></i></span>
							</div>
							<input type="password" name="password" class="form-control" placeholder="password" required autocomplete="off">
						</div>
						<div class="form-group">
							<input type="submit" name="btn-submit" value="Salvar" class="btn btn-block float-right login_btn">
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</body>

</html>
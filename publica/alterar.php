<?php

//passa as informações de conexao com o banco de dados
$host = "192.168.0.102";
$user = "root";
$password = "ruth130178";
$database = "aula";

$id = $_POST['id'];
$nome = $_POST['nome'];
$cpf = $_POST['cpf'];
$email = $_POST['email'];
$login = $_POST['login'];
$senha = $_POST['senha'];

//verifica se conseguiu conectar
if ($conexao = new mysqli($host, $user, $password, $database)) {

    $sql = "UPDATE cliente SET   ";
    $sql .= " nome = '$nome'   , ";
    $sql .= " cpf = '$cpf'     , ";
    $sql .= " email = '$email' , ";
    $sql .= " login = '$login' , ";
    $sql .= " senha = '$senha'   ";
    
    $sql .= " WHERE id = '$id'   ";

    $conexao->query($sql);

    mysqli_close($conexao);

    echo "
    <script>
        window.location.href='index.php?page=cadastro&id=$id';
    </script>
    ";

}

?>

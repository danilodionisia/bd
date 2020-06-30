<?php

//passa as informações de conexao com o banco de dados
$host = "192.168.0.102";
$user = "root";
$password = "ruth130178";
$database = "aula";

$id = $_GET['id'];

//verifica se conseguiu conectar
if ($conexao = new mysqli($host, $user, $password, $database)) {

    $sql = "SELECT * FROM cliente WHERE id = '$id'";
    $query = $conexao->query($sql);
    $inf = mysqli_fetch_assoc($query);
}

?>
<!-- inicio do form de atualizacao -->
<div class="container-fluid">
    <div class="container">
        <h4 class="mt-5">Alteração dos dados do cliente</h4>
        <form action="index.php?page=alterar" method="post" onsubmit="return alterar();">

            <input type="hidden" name="operacao" value="atualizar">

            <div class="row mt-3">
                <div class="col">
                    <label for="id">ID</label>
                    <input type="text" name="id" class="form-control" value="<?php echo $inf['id']; ?>" readonly>
                </div>
                <div class="col">
                    <label for="cpf">CPF</label>
                    <input type="text" name="cpf" class="form-control" id="cpf" value="<?php echo $inf['cpf']; ?>" required>
                </div>
            </div>


            <div class="row mt-3">
                <div class="col">
                    <label for="nome">Nome</label>
                    <input type="text" name="nome" class="form-control" id="nome" value="<?php echo $inf['nome']; ?>" required>
                </div>
                <div class="col">
                    <label for="email">E-mail</label>
                    <input type="email" name="email" class="form-control" id="email" value="<?php echo $inf['email']; ?>" required>
                </div>               
            </div>

            <div class="row mt-3">
            <div class="col">
                    <label for="login">Login</label>
                    <input type="text" name="login" class="form-control" id="login" value="<?php echo $inf['login']; ?>" readonly>
                </div>
                <div class="col">
                    <label for="senha">Senha</label>
                    <input type="password" name="senha" class="form-control" id="senha" value="<?php echo $inf['senha']; ?>" required>
                </div>
            </div>

            <div class="row mt-5">
                <div class="col">
                    <button type="submit" name='btn-alterar' class="btn btn-block btn-success">Alterar</button>
                </div>
            </div>
        </form>
    </div>
</div>
<script>
    function alterar() {
        let resp = confirm("Confirma as alterações?");

        if (resp == true) {
            return true;
        } else {
            return false;
        }
    }
</script>
<div class="container-fluid">
    <div class="container">
        <h4 class="mt-5">Cadastro de clientes</h4>
        <form action="index.php?page=cliente-bd" method="post">

            <input type="hidden" name="operacao" value="inserir">

            <div class="row mt-3">
                <div class="col">
                    <label for="nome">Nome</label>
                    <input type="text" name="nome" class="form-control" id="nome" required>
                </div>
            </div>

            <div class="row mt-3">
                <div class="col">
                    <label for="email">E-mail</label>
                    <input type="email" name="email" class="form-control" id="email" required>
                </div>
            </div>

            <div class="row mt-3">
                <div class="col">
                    <label for="cpf">CPF</label>
                    <input type="text" name="cpf" class="form-control" id="cpf" required>
                </div>
            </div>

            <div class="row mt-5">
                <div class="col">
                    <button type="submit" class="btn btn-block btn-success">Salvar</button>
                </div>
            </div>

        </form>

        <div class="row mt-5">
            <div class="col">
                <button type="button" class="btn btn-block btn-primary" onclick="listagem();">Listagem</button>
            </div>
        </div>
    </div>
</div>
<script>
    function listagem() {
        window.location.href = "index.php?page=cliente-listagem";
    }
</script>
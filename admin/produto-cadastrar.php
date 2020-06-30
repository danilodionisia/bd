<div class="container-fluid">
    <div class="container">
        <h4 class="mt-5">Cadastro de produtos</h4>
        <form action="index.php?page=produto-bd" method="post" enctype="multipart/form-data">

            <input type="hidden" name="operacao" value="inserir">

            <div class="row mt-3">
                <div class="col">
                    <label for="nome">Nome</label>
                    <input type="text" name="nome" class="form-control" id="nome" required>
                </div>
                <div class="col">
                    <label for="valor">Valor R$</label>
                    <input type="text" name="valor" class="form-control" id="valor" required>
                </div>
            </div>

            <div class="row mt-3">
                <div class="col">
                    <label for="foto">Foto</label>
                    <input type="file" name="foto" class="form-control" id="foto" accept="image/*">
                </div>
            </div>

            <div class="row mt-3">
                <div class="col">
                    <label for="descricao">Descrição</label>
                    <textarea name="descricao" class="form-control" id="descricao"></textarea>
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
        window.location.href = "index.php?page=produto-listagem";
    }
</script>
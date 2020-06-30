<div class="container-fluid">
    <div class="container">
        <h4 class="mt-5">Pesquisa de produtos</h4>
        <form action="index.php?page=produto-pesquisar" method="post">

            <div class="row mt-3">
                <div class="col">
                    <label for="nome">Nome</label>
                    <input type="text" name="nome" class="form-control" id="nome" required>
                </div>
            </div>
            <div class="row mt-5">
                <div class="col">
                    <button type="submit" class="btn btn-block btn-success">Pesquisar</button>
                </div>
            </div>
        </form>
    </div>
    <div class="container mt-5">
        <?php

        if (isset($_POST['nome'])) {

            $nome = $_POST['nome'];

            //passa as informações de conexao com o banco de dados
            $host = "192.168.0.102";
            $user = "root";
            $password = "ruth130178";
            $database = "aula";

            //verifica se conseguiu conectar
            if ($conexao = new mysqli($host, $user, $password, $database)) {

                //fala que vai usar caracteres com acentuação diferente
                mysqli_set_charset($conexao, "utf8");



                //cria o comando sql
                $sql = "SELECT * FROM produto WHERE nome LIKE '$nome%' OR valor LIKE '$nome%' OR descricao LIKE '%$nome%'";
                //executa o comando sql
                $query = $conexao->query($sql);

                if ($rows = mysqli_num_rows($query) > 0) {

                ?>

                    <table class="table mb-5">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Nome</th>
                                <th scope="col">Valor</th>
                                <th scope="col">Descrição</th>
                                <th scope="col">Foto</th>
                            </tr>
                        </thead>
                        <tbody>
                    <?php

                    while ($inf = mysqli_fetch_assoc($query)) {
                        
                        echo "
                        <tr>
                            <th scope='row'>" . $inf['id'] . "</th>
                            <td>" . $inf['nome'] . "</td>
                            <td>" . $inf['valor'] . "</td>
                            <td>" . $inf['descricao'] . "</td>
                            <td><img src='img-produtos/" . $inf['foto'] . "' style='height:50px;width:auto;'></td>
                        </tr>";
                    }

                    ?>
                        </tbody>
                    </table>
                    <button type="button" class="btn btn-block btn-default mt-5 mb-5" onclick="limpar();">Limpar</button>
                    <?php
                } else {
                    echo "Sem registros!";
                }

                //fecha a conexao
                $conexao->close();
            }
        }

        ?>
    </div>
</div>
<script>
    function limpar(){
        window.location.href = "index.php?page=produto-pesquisar";
    }
</script>
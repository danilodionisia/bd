<button class="btn btn-right btn-primary mt-5 mb-5" onclick='verCarrinho()'>Ver carrinho</button>
<div class="d-flex">
    <?php
        $host = "192.168.0.102";
        $user = "root";
        $password = "ruth130178";
        $database = "aula";

        if ($conexao = new mysqli($host, $user, $password, $database)) {

            $sql = "SELECT * FROM produto ORDER BY nome ASC";
            $dados = $conexao->query($sql);
            $conexao->close();

            if ($rows = mysqli_num_rows($dados) > 0) {

                while ($inf = mysqli_fetch_assoc($dados)) {

                    $id = $inf['id'];

                    echo "<div class='p-3 text-center'>"
                        . "<p><h5>" . $inf['nome'] . "</h5></p>"
                        . "<img class='mt-3 mb-3' src='../admin/img-produtos/" . $inf['foto'] . "' title='" . $inf['nome'] . "' height='150' width='100'/><br>"
                        . "<p>Preço R$ " . number_format($inf['valor'], 2, ",", ".") . "</p>"
                        . "<button type='button' class='btn btn-secondary mr-2' onclick='detalhes(\"$id\");'>Detalhes</button>"
                        . "<button type='button' class='btn btn-success' onclick='carrinho(\"$id\");'>Comprar</button>"
                        . "</div>";
                }
            }
        }
    ?>
</div>

<script>
    function carrinho(id) {
        window.location.href = 'index.php?page=carrinho&acao=add&id=' + id;
    }

    function detalhes(id) {
        window.location.href = 'index.php?page=detalhes&id=' + id;
    }

    function verCarrinho(id) {
        window.location.href = 'index.php?page=carrinho';
    }
</script>

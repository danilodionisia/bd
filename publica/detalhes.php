
<button class="btn btn-right btn-primary" onclick='verCarrinho()'>Ver carrinho</button>
<div class="container">
    <?php
        $host = "192.168.0.102";
        $user = "root";
        $password = "ruth130178";
        $database = "aula";

        $id = $_GET['id'];

        if ($conexao = new mysqli($host, $user, $password, $database)) {

            $sql = "SELECT * FROM produto WHERE id = '$id'";
            $dados = $conexao->query($sql);
            $conexao->close();

            if ($rows = mysqli_num_rows($dados) > 0) {

                while ($inf = mysqli_fetch_assoc($dados)) {

                    $id = $inf['id'];

                    echo "<div class='text-center'>"
                        . "<p><h5>" . $inf['nome'] . "</h5></p>"
                        . "<img class='mt-3 mb-3' src='../admin/img-produtos/" . $inf['foto'] . "' title='" . $inf['nome'] . "' height='300' width='200'/><br>"
                        
                        . "<p>Descrição: " . $inf['descricao'] . "</p>"
                        
                        . "<p>Preço R$ " . number_format($inf['valor'], 2, ",", ".") . "</p>"
                        . "<button type='button' class='btn btn-danger mr-2' onclick='voltar();'>Voltar</button>"
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

    function voltar() {
        window.location.href = 'index.php';
    }

    function verCarrinho(id) {
        window.location.href = 'index.php?page=carrinho';
    }
</script>

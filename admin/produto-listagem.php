<div class="container-fluid">
    <div class="container">
    <h4 class="mt-5">Listagem de produtos</h4>
        <table class="table mt-5">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Nome</th>
                <th scope="col">Valor</th>
                <th scope="col">Descrição</th>
                <th scope="col">Foto</th>
                <th scope="col"></th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
        <?php 
            
            //passa as informações de conexao com o banco de dados
            $host = "192.168.0.102";
            $user = "root";
            $password = "ruth130178";
            $database = "aula";

            //verifica se conseguiu conectar
            if( $conexao = new mysqli($host, $user, $password, $database) ){
                
                $sql = "SELECT * FROM produto ORDER BY nome ASC";
                $dados = $conexao->query($sql);

                while($info = mysqli_fetch_assoc($dados)){
                   
                   ?> 

                    <tr>
                        <th scope='row'><?php echo $info['id']; ?></th>
                        <td><?php echo $info['nome']; ?></td>
                        <td><?php echo "R$ " . number_format($info['valor'], 2, ",", "."); ?></td>
                        <td><?php echo $info['descricao']; ?></td>
                        <td><img src="img-produtos/<?php echo $info['foto'] ?>" style="height:50px;width:auto" /></td>
                        <td>
                            <button type="button" class="btn btn-danger btn-sm" onclick="excluir('<?php echo $info['id']; ?>')">
                            Excluir
                            </button>
                        </td>
                        <td>
                            <button type="button" class="btn btn-warning btn-sm" onclick="alterar('<?php echo $info['id']; ?>')">
                            Alterar
                            </button>
                        </td>
                    </tr>


                    <?php                   
                }

                $conexao->close();

            }
        ?>            
        </tbody>
        </table>
        <div class="row mt-5 mb-5">
            <button type="button" class="btn btn-block btn-primary" onclick="voltar();">Cadastrar produto</button>
        </div>
    </div>
</div>
<script>
    function voltar(){
        window.location.href = "index.php?page=produto-cadastrar";
    }

    function excluir(id){
        
        let resp = confirm("Deseja realmente excluir o Produto?");

        if(resp == true){
            window.location.href = "index.php?page=produto-bd&operacao=excluir&id=" + id;
        }
    }

    function alterar(id){        
        window.location.href = "index.php?page=produto-alterar&id=" + id;
    }
</script>



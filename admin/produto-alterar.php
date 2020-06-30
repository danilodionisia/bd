<?php 

    //passa as informações de conexao com o banco de dados
    $host = "localhost";
    $user = "root";
    $password = "ruth130178";
    $database = "aula";

    if(!isset($_GET['id']) || $_GET['id'] == ""){
       
        echo "
        <script>
            window.location.href= 'index.php?page=produto-listagem';
        </script>
        ";
    }

    $id = $_GET['id'];

    //verifica se conseguiu conectar
    if( $conexao = new mysqli($host, $user, $password, $database) ){
        
        $sql = "SELECT * FROM produto WHERE id = '$id'";
        $query = $conexao->query($sql);
        $inf = mysqli_fetch_assoc($query);
    }

?>
<!-- inicio do form de atualizacao -->
<div class="container-fluid">
    <div class="container">
        <h4 class="mt-5">Alteração dos dados do cliente</h4>
        <form action="index.php?page=produto-bd" method="post" onsubmit="return alterar();" enctype="multipart/form-data">
            
            <input type="hidden" name="operacao" value="atualizar">
            
            <div class="row mt-3">
                <div class="col">
                    <label for="id">ID</label>
                    <input type="text" name="id" class="form-control" value="<?php echo $inf['id']; ?>" readonly>
                </div>
            </div>

            <div class="row mt-3">
                <div class="col">
                    <label for="nome">Nome</label>
                    <input type="text" name="nome" class="form-control" id="nome" value="<?php echo $inf['nome']; ?>" required>
                </div>
            </div>

            <div class="row mt-3">
                <div class="col">
                    <label for="valor">Valor</label>
                    <input type="text" name="valor" class="form-control" id="valor" value="<?php echo $inf['valor']; ?>" required>
                </div>
            </div>

            <div class="row mt-3">
                <div class="col">
                    <label for="foto">Foto</label>
                    <input type="file" name="foto" class="form-control" id="foto" accept="image/*">
                    <input type="hidden" name="foto-antiga" value="<?php echo $inf['foto']; ?>">
                </div>
            </div>

            <div class="row mt-3">
                <div class="col">
                    <label for="descricao">Descrição</label>
                    <textarea name="descricao" class="form-control" id="descricao"><?php echo $inf['descricao']; ?></textarea>
                </div>
            </div>

            <div class="row mt-5 mb-5">
                <div class="col">
                    <button type="submit" class="btn btn-block btn-success">Alterar</button>
                </div>
            </div>

        </form>
    </div>
</div>
<script>
    function alterar(){
        let resp = confirm("Confirma as alterações?");

        if(resp == true){
            return true;
        }else{
            return false;
        }
    }
</script>
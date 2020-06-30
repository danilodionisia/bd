 <?php 

    function conexao(){

        //passa as informações de conexao com o banco de dados
        $host = "192.168.0.102";
        $user = "root";
        $password = "ruth130178";
        $database = "aula";

        if($conexao = new mysqli($host, $user, $password, $database)){
            //fala que vai usar caracteres com acentuação diferente
            mysqli_set_charset($conexao, "utf8");
            return $conexao;
        }

    }


    function inserirProduto($nome, $valor, $descricao, $foto){

        $conexao = conexao();

        $valor = str_replace(",", ".", $valor);

        //cria o comando sql
        $sql = "INSERT INTO produto (nome, valor, descricao, foto) VALUES ('$nome', '$valor', '$descricao', '$foto')";
        //executa o comando sql
        $resultado = $conexao->query($sql);
        //fecha a conexao
        $conexao->close();

        if($resultado){
            echo "        
            <div class='container-fluid'>
                <div class='container bg-success mt-5'>
                    Produto cadastrado com sucesso!
                    <div class='row'>
                        <button type='button' class='btn btn-block btn-default' onclick='voltar();'>Voltar</button>
                    </div>
                </div>                               
            </div>
            ";
        }else{
            echo "  
            <div class='container-fluid'>      
                <div class='container bg-danger mt-5'>
                    Falha ao cadastrar o produto!
                    <div class='row'>
                        <button type='button' class='btn btn-block btn-default' onclick='voltar();'>Voltar</button>
                    </div>
                </div>           
            </div>
            ";
        }        

    }

    function atualizarProduto($nome, $valor, $nomeFoto, $descricao, $id){

        $conexao = conexao();     
        //troca a virgula por ponto
        $valor = str_replace(",", ".", $valor);

        //cria o comando sql
        $sql = "UPDATE produto SET nome = '$nome', valor = '$valor', foto = '$nomeFoto', descricao = '$descricao' "; 
        $sql .= " WHERE id = '$id' ";

        //executa o comando sql
        $conexao->query($sql);
        //fecha a conexao
        $conexao->close();  
        
        echo "
        <script>
            window.location.href = 'index.php?page=produto-listagem';
        </script>
        ";

    }

    function excluirProduto($id){

        $conexao = conexao();

        $sql = "DELETE FROM produto WHERE id = '$id'";
        $conexao->query($sql);
        $conexao->close();
        
        echo "
        <script>
        window.location.href = 'index.php?page=produto-listagem';
        </script>";
    }

    
    isset($_REQUEST['id']) ? $id = $_REQUEST['id'] : $id = "";
    isset($_POST['nome']) ? $nome = $_POST['nome'] : $nome = "";
    isset($_POST['valor']) ? $valor = $_POST['valor'] : $valor = "";
    isset($_POST['descricao']) ? $descricao = $_POST['descricao'] : $descricao = "";
    isset($_REQUEST['operacao']) ? $operacao = $_REQUEST['operacao'] : $operacao = "";

    /* tratamento da foto */
    isset($_FILES['foto']['name']) ? $nomeFoto = $_FILES['foto']['name'] : $nomeFoto = "";
    isset($_FILES['foto']['tmp_name']) ? $imagemFoto = $_FILES['foto']['tmp_name'] : $imagemFoto = "";
   /* verifica se veio foto para alterar */
    isset($_POST['foto-antiga']) ? $fotoAntiga = $_POST['foto-antiga'] : $fotoAntiga = "";
	
    $caminhoPasta="img-produtos/";	
    
    if($nomeFoto != ""){
        move_uploaded_file($imagemFoto, $caminhoPasta . $nomeFoto);	
    }else{
        $nomeFoto = $fotoAntiga;
    }			
	
    /* final */ 

    switch($operacao){

        case 'inserir':
            inserirProduto($nome, $valor, $descricao, $nomeFoto);
        break;
        
        case 'atualizar':
            atualizarProduto($nome, $valor, $nomeFoto, $descricao, $id);
        break;

        case 'excluir':
            excluirProduto($id);
        break;

    }

   
    ?>

<script>
        
    //window.location.href = "index.php?page=cliente-listagem";

    function voltar(){
        window.location.href = "index.php?page=produto-cadastrar";
    }
</script>
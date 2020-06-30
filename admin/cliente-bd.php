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


    function inserirCliente($nome, $email, $cpf){

        $conexao = conexao();

        //cria o comando sql
        $sql = "INSERT INTO cliente (nome, email, cpf) VALUES ('$nome', '$email', '$cpf')";
        //executa o comando sql
        $resultado = $conexao->query($sql);
        //fecha a conexao
        $conexao->close();

        if($resultado){
            echo "        
            <div class='container-fluid'>
                <div class='container bg-success mt-5'>
                    Cadastrado com sucesso!
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
                    Falha ao cadastrar!
                    <div class='row'>
                        <button type='button' class='btn btn-block btn-default' onclick='voltar();'>Voltar</button>
                    </div>
                </div>           
            </div>
            ";
        }        

    }

    function atualizarCliente($nome, $email, $cpf, $id){

        $conexao = conexao();     
        
        //cria o comando sql
        $sql = "UPDATE cliente SET nome = '$nome', email = '$email', cpf = '$cpf' "; 
        $sql .= " WHERE id = '$id' ";

        //executa o comando sql
        $conexao->query($sql);
        //fecha a conexao
        $conexao->close();  
        
        echo "
        <script>
            window.location.href = 'index.php?page=cliente-listagem';
        </script>
        ";

    }

    function excluirCliente($id){

        $conexao = conexao();

        $sql = "DELETE FROM cliente WHERE id = '$id'";
        $conexao->query($sql);
        $conexao->close();
        
        echo "
        <script>
        window.location.href = 'index.php?page=cliente-listagem';
        </script>";
    }

    isset($_REQUEST['id']) ? $id = $_REQUEST['id'] : $id = "";
    isset($_POST['nome']) ? $nome = $_POST['nome'] : $nome = "";
    isset($_POST['email']) ? $email = $_POST['email'] : $email = "";
    isset($_POST['cpf']) ? $cpf = $_POST['cpf'] : $cpf = "";
    isset($_REQUEST['operacao']) ? $operacao = $_REQUEST['operacao'] : $operacao = "";
    
    switch($operacao){

        case 'inserir':
            inserirCliente($nome, $email, $cpf);
        break;
        
        case 'atualizar':
            atualizarCliente($nome, $email, $cpf, $id);
        break;

        case 'excluir':
            excluirCliente($id);
        break;

    }

   
    ?>

<script>
        
    //window.location.href = "index.php?page=cliente-listagem";

    function voltar(){
        window.location.href = "index.php?page=cliente-cadastrar";
    }
</script>
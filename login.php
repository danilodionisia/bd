<?php 

    //inicializa uma sessao
    session_start();

    //pega login e senha
    $login = $_POST['login'];
    $senha = $_POST['password'];


     //passa as informações de conexao com o banco de dados
     $host = "192.168.0.102";
     $user = "root";
     $password = "ruth130178";
     $database = "aula";
     $tipoUsuario = null;
    
     //verifica se conseguiu conectar
    if( $conexao = new mysqli($host, $user, $password, $database) ){
         
        $sql = "SELECT login, senha FROM admin WHERE login = '$login' AND senha = '$senha' LIMIT 1";
        $dados = $conexao->query($sql);
        
        if($linhas = mysqli_num_rows($dados) > 0){
            $_SESSION['username'] = $login;
            $tipoUsuario = "adm";
        }
         
        $sql = "SELECT login, senha, id FROM cliente WHERE login = '$login' AND senha = '$senha' LIMIT 1";
        $dados = $conexao->query($sql);
        $row = mysqli_fetch_array($dados);
        
        if($linhas = mysqli_num_rows($dados) > 0){            
            $_SESSION['username'] = $row['login'];
            $_SESSION['username_id'] = $row['id'];
            $tipoUsuario = "user";
        }

        $conexao->close();
    }

    switch($tipoUsuario){

        case 'adm':
            header("location:http://localhost/bd/admin/");
        break;
            
        case 'user': 
            header("location:http://localhost/bd/publica/");
        break;

        default:
            header("location:index.php");
        break;
    }
?>
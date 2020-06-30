<?php
//inicia a sessao
session_start();

//verifica se a sessao esta vazia
if (!isset($_SESSION['carrinho'])) {
    $_SESSION['carrinho'] = array();
}

//adiciona produto no carrinho
if (isset($_GET['acao'])) {

    //adicionar ao carirnho
    if ($_GET['acao'] == 'add') {

        $id = intval($_GET['id']);

        if (!isset($_SESSION['carrinho'][$id])) {
            $_SESSION['carrinho'][$id] = 1;
        } else {
            $_SESSION['carrinho'][$id] += 1;
        }
    }

    //remove produto do carrinho
    if($_GET['acao'] == 'del'){

        $id = intval($_POST['id']);

        if (isset($_SESSION['carrinho'][$id])) {
            unset($_SESSION['carrinho'][$id]);
        }

    }

    //altera a quantidade
    if($_GET['acao'] == 'up'){

        $id = intval($_POST['id']);
        $qtd = intval($_POST['qtd']) ? intval($_POST['qtd']) : $_POST['qtd'] ;

        if(!empty($qtd) || $qtd <> 0){
                        
            if($qtd == 'p1'){

                $_SESSION['carrinho'][$id] += 1;

            }else if($qtd == 'm1'){

                $_SESSION['carrinho'][$id] -= 1;

            }else if($qtd <> 'm1' && $qtd <> 'p1'){
                $_SESSION['carrinho'][$id] = $qtd;
            }
            
        }
    }
}

?>

<table class="table mt-5">
    <thead>
        <tr>
            <th scope="col">Foto</th>
            <th scope="col">Produto</th>
            <th scope="col" class='text-center'>Quantidade</th>
            <th scope="col"></th>
            <th scope="col">Preço</th>
            <th scope="col">Subtotal</th>
            <th scope="col">Remover</th>
        </tr>
    </thead>
    <tbody>
    <?php 

        if(count($_SESSION['carrinho']) == 0){
            echo "<tr><td colspan='6'>Não há produtos no carrinho!</td></tr>";
        }
        else
        {

            //passa as informações de conexao com o banco de dados
            $host = "192.168.0.102";
            $user = "root";
            $password = "ruth130178";
            $database = "aula";

            $conexao = new mysqli($host, $user, $password, $database);

            foreach($_SESSION['carrinho'] as $id => $qtd){

                $sql = "SELECT * FROM produto WHERE id = '$id'";
                $dados = $conexao->query($sql);

                $info = mysqli_fetch_assoc($dados);
                $foto = $info['foto'];
                $produto = $info['nome'];
                $valor = number_format($info['valor'], 2, ",", ".");
                $sub = number_format($info['valor'] * $qtd, 2, ",", ".");
                $total += $info['valor'] * $qtd;
                
                echo "
                    <tr>
                        <td class='align-middle'><img src='../admin/img-produtos/$foto' style='height:50px;width:auto' /></td>
                        <td class='align-middle'>$produto</td>
                        <td class='align-middle text-center'>
                            <div class='row'>
                                <div class='col text-right'>
                                    <img src='img/minus.png' onclick='plusMinus(\"$id\", \"m1\")'/>
                                </div>
                                <div class='col'>
                                    <input type='text' class='form-control text-center' id='$id' value='$qtd' size='3'>
                                </div>
                                <div class='col text-left align-middle'>
                                    <img src='img/plus.png' onclick='plusMinus(\"$id\", \"p1\")'/>
                                </div>
                            </div>
                        </td>
                        <td class='align-middle'>
                            <button class='btn btn-secondary btn-small' onclick='alterar(\"$id\")';>Alterar</button>
                        </td>
                        <td class='align-middle'>R$ $valor</td>                                        
                        <td class='align-middle'>R$ $sub</td>                                        
                        <td class='align-middle'>
                            <button class='btn btn-danger btn-small' onclick='remover(\"$id\")';>Remover</button>
                        </td>                                        
                    </tr>
                ";               
            }

            $conexao->close();
            echo "
                <tr class='bg-light'>
                    <td colspan='6' class='text-right'><h6>Total</h6></td>
                    <td>R$ " . number_format($total, 2, ",", ".") . "</td>
                </tr>
            ";            
        }
    ?>
    </tbody>
</table>
<button class="btn btn-success btn-right mt-5 mb-5" onclick='continuar()'>Continuar comprando</button>
<script>
    function remover(id){

        formulario = new FormData();        
        formulario.set('id', id);

        let request = new XMLHttpRequest();
        request.open("POST", 'index.php?page=carrinho&acao=del', true);
        request.send(formulario);

        window.location.href='?page=carrinho';
    }

    function continuar(id){
        window.location.href='?page=produtos';
    }

    function alterar(id){

        let qtd = document.getElementById(id).value;

        data = new FormData();        
        data.set('id', id);
        data.set('qtd', qtd);

        let request = new XMLHttpRequest();
        request.open("POST", '?page=carrinho&acao=up', true);
        request.send(data);

        window.location.href='?page=carrinho';
    }

    function plusMinus(id, qtd){

        let qtd_atual = document.getElementById(id).value;

        if(qtd_atual == 1 && qtd == "m1"){
            remover(id);
        }else if(qtd_atual >= 1){

            data = new FormData();

            data.set('qtd', qtd);
            data.set('id', id);

            let request = new XMLHttpRequest();
            request.open("POST", '?page=carrinho&acao=up', true);
            request.send(data);

            window.location.href='?page=carrinho';
        }
        
    }
</script>
<?php
session_start();

if(!isset($_SESSION['id_usuario'])){
    header('Location: ../../index.php');
    exit();
}
include_once('../../Dependencias/conexao.php');


// Check if POST data is not empty

    $id =  NULL;
    $id_usuario = 1;
    // Check if POST variable "name" exists, if not default the value to blank, basically the same for all variables
    $cliente = mysqli_real_escape_string($conn, trim($_POST['nome_cliente']));;
    $produto = mysqli_real_escape_string($conn, trim($_POST['nome_produto']));;
    $qtd = mysqli_real_escape_string($conn, trim($_POST['qtd_produto']));;
    $nota = !empty($_POST['nota']) ?  mysqli_real_escape_string($conn, trim($_POST['nota'])) : NULL;
    $valor = mysqli_real_escape_string($conn, trim($_POST['valor']));;
    $peso = !empty($_POST['peso']) ?  mysqli_real_escape_string($conn, trim($_POST['peso'])) : NULL;
    $dataPedido = mysqli_real_escape_string($conn, trim($_POST['data_pedido']));;
    $dataEntrega = !empty($_POST['data_entrega']) ?  mysqli_real_escape_string($conn, trim($_POST['data_entrega'])) : NULL;
    $status = mysqli_real_escape_string($conn, trim($_POST['status']));;
    $tipoPag = mysqli_real_escape_string($conn, trim($_POST['tipo_pagamento']));;
    

    $conn->query('START TRANSACTION');
    
    // $venda =  "INSERT INTO venda (`id_venda`, `data_hora`, `valor_venda`, `usuario_id_usuario`, `cliente_id_cliente`, `numero_nota`, `peso_venda`, `cliente_end_cliente`, `data_pedido`, `data_entrega`, `status`, `tipo_pagamento`) 
    //     VALUES (NULL, NOW(), '$valor', '$id_usuario', '$cliente', '$nota', '$peso', (select end_cliente from cliente where id_cliente = '$cliente'), '$dataPedido', '$dataEntrega', '$status', '$tipoPag'";

        $stmt = $conn->prepare("INSERT INTO venda (`id_venda`, `data_hora`, `valor_venda`, `usuario_id_usuario`, `cliente_id_cliente`, `numero_nota`, `peso_venda`, `cliente_end_cliente`, `data_pedido`, `data_entrega`, `status`, `tipo_pagamento`)
                                    VALUES (NULL, NOW(), ?, ?, ?, ?, ?, (select end_cliente from cliente where id_cliente = ?), ?, ?, ?, ?)") ;
        $stmt->bind_param("ssssssssss", $valor, $id_usuario, $cliente, $nota, $peso, $cliente, $dataPedido, $dataEntrega, $status, $tipoPag);
        
        try {
            $result = $stmt->execute();
        } catch (mysqli_sql_exception $e) {
            $error = $e->getMessage();
            
        }
        

        if ($result == TRUE) {
        $vendaId = mysqli_insert_id($conn);
        $itemInserido = $conn->query("INSERT INTO itemvenda (venda_id_venda, produto_id_produto, qtd_produto, produto_nome_produto) VALUES($vendaId, $produto, $qtd, (select nome_produto from produto where id_produto = $produto))");
        if ( ! $itemInserido ) {
            $conn->query("ROLLBACK");
            echo 'Falha ao inserir';
            $_SESSION['msg'] = "<p style='color:red;'>Venda não cadastrada</p>";
            header('Location: create.php');
        }
        

        $conn->query('COMMIT');
        $_SESSION['msg'] = "<p style='color:green;'>Venda cadastrada com sucesso</p>";
        header('Location: create.php');
    }else{
        $_SESSION['msg'] = "<p style='color:red;'>Venda não cadastrada  aqui erro: $error</p>";
        header('Location: create.php');
    }





























    // // Insert new record into the contacts table
    //     $sql = "INSERT INTO produto (`id_produto`, `usuario_id_usuario`, `nome_produto`, `descricao_produto`, `comercializavel`, `qtd_estoque`, `peso_produto`, `valor_unidade`) VALUES (NULL, '$id_usuario', '$nome', '$descricao', '$com', '$qtd', '$peso', '$valor')";
    //     /* $result = mysqli_query($conn, $sql); */


        // if ($conn->query($sql) == TRUE) {
        //     $_SESSION['msg'] = "<p style='color:green;'>Produto cadastrado com sucesso</p>";
        //     header('Location: create.php');


        // }else{
        //     $_SESSION['msg'] = "<p style='color:red;'>Produto não cadastrado</p>";
        //     header('Location: create.php');

        // }


?>
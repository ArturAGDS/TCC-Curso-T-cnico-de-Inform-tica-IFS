<?php
session_start();

if(!isset($_SESSION['id_usuario'])){
    header('Location: ../../index.php');
    exit();
}
include_once('../../Dependencias/conexao.php');


// Check if POST data is not empty

    
$id = mysqli_real_escape_string($conn, trim($_POST['id']));;
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
    

    $stmt = $conn->prepare("UPDATE venda SET  `valor_venda` = ?, `usuario_id_usuario` = ?, `cliente_id_cliente` = ?, `numero_nota` = ?, `peso_venda` = ?, `cliente_end_cliente` = (select end_cliente from cliente where id_cliente = ?), `data_pedido` = ?, `data_entrega` = ?, `status` = ?, `tipo_pagamento` = ? WHERE id_venda = ?");

    $stmt->bind_param("sssssssssss", $valor, $id_usuario, $cliente, $nota, $peso, $cliente, $dataPedido, $dataEntrega, $status, $tipoPag, $id);
    
    try {
        $result = $stmt->execute();
    } catch (mysqli_sql_exception $e) {
        $error = $e->getMessage();
        
    }
    

    if ($result == TRUE) {
    $vendaId = mysqli_insert_id($conn);
    $itemInserido = $conn->query("UPDATE itemvenda SET produto_id_produto = $produto, qtd_produto = $qtd, produto_nome_produto = (select nome_produto from produto where id_produto = $produto) WHERE venda_id_venda = $id");
    if ( ! $itemInserido ) {
        $conn->query("ROLLBACK");
        echo 'Falha ao inserir';
        $_SESSION['msg'] = "<p style='color:red;'>Produto não atualizada</p>";
        header('Location: update.php?id='.$id);
    }
    

    $conn->query('COMMIT');
    $_SESSION['msg'] = "<p style='color:green;'>Produto atualizada com sucesso</p>";
    header('Location: update.php?id='.$id);
}else{
    $_SESSION['msg'] = "<p style='color:red;'>Venda não atualizada  aqui erro: $error</p>";
    header('Location: update.php?id='.$id);
}



?>
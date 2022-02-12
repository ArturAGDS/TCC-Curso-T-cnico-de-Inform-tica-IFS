<?php

session_start();
if(!isset($_SESSION['id_usuario'])){
    header('Location: ../../index.php');
    exit();
}
include_once('../../Dependencias/conexao.php');




    
    $id_usuario = 1;
    
    $id = mysqli_real_escape_string($conn, trim($_POST['id']));;
    $nome = mysqli_real_escape_string($conn, trim($_POST['nome']));;
    $descricao = mysqli_real_escape_string($conn, trim($_POST['descricao']));;
    $valor = !empty($_POST['valor']) ?  mysqli_real_escape_string($conn, trim($_POST['valor'])) : NULL;
    $qtd = !empty($_POST['quantidade_estoque']) ?  mysqli_real_escape_string($conn, trim($_POST['quantidade_estoque'])) : NULL;
    $peso =!empty($_POST['peso']) ?  mysqli_real_escape_string($conn, trim($_POST['peso'])) : NULL;
    $com = mysqli_real_escape_string($conn, trim($_POST['com']));;
   
   
        $stmt = $conn->prepare("UPDATE produto SET nome_produto = ?, descricao_produto = ?, comercializavel = ?, qtd_estoque = ?, peso_produto = ?, valor_unidade = ? WHERE id_produto = ?") ;
        $stmt->bind_param("ssssssd", $nome, $descricao, $com, $qtd, $peso, $valor, $id);
        
        try {
            $result = $stmt->execute();
        } catch (mysqli_sql_exception $e) {
            $error = $e->getMessage();
            
        }


        if ($result == TRUE) {
            $_SESSION['msg'] = "<p style='color:green;'>Produto atualizado com sucesso</p>";
            header('Location: update.php?id='.$id);


        }else{
            $_SESSION['msg'] = "<p style='color:red;'>Produto não atualizado</p>";
            header('Location: update.php?id='.$id);

        }


?>
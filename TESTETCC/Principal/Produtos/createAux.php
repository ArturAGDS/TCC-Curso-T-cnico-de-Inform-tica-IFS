<?php
session_start();
if(!isset($_SESSION['id_usuario'])){
    header('Location: ../../index.php');
    exit();
}
include_once('../../Dependencias/conexao.php');




    $id =  NULL;
    $id_usuario = $_SESSION['id_usuario'];
    
    $nome = mysqli_real_escape_string($conn, trim($_POST['nome']));;
    $descricao = mysqli_real_escape_string($conn, trim($_POST['descricao']));;
    $valor = !empty($_POST['valor']) ?  mysqli_real_escape_string($conn, trim($_POST['valor'])) : NULL;
    $qtd = !empty($_POST['quantidade_estoque']) ?  mysqli_real_escape_string($conn, trim($_POST['quantidade_estoque'])) : NULL;
    $peso =!empty($_POST['peso']) ?  mysqli_real_escape_string($conn, trim($_POST['peso'])) : NULL;
    $com = mysqli_real_escape_string($conn, trim($_POST['com']));
    
    
        $stmt = $conn->prepare("INSERT INTO produto (`usuario_id_usuario`, `nome_produto`, `descricao_produto`, `comercializavel`, `qtd_estoque`, `peso_produto`, `valor_unidade`, `ativo`)
                                    VALUES (?, ?, ?, ?, ?, ?, ?, 1)") ;
        $stmt->bind_param("sssssss", $id_usuario, $nome, $descricao, $com, $qtd, $peso, $valor);
        
        try {
            $result = $stmt->execute();
        } catch (mysqli_sql_exception $e) {
            $error = $e->getMessage();
            
        }
        

        if ($result == TRUE) {
            $_SESSION['msg'] = "<p style='color:green;'>Produto cadastrado com sucesso</p>";
            header('Location: create.php');


        }else{
            $_SESSION['msg'] = "<p style='color:red;'>Produto não cadastrado erro: $error</p>";
            header('Location: create.php');

        }


?>
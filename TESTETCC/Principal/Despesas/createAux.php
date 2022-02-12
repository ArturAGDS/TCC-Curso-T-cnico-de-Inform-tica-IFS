<?php
session_start();

if(!isset($_SESSION['id_usuario'])){
    header('Location: ../../index.php');
    exit();
}
include_once('../../Dependencias/conexao.php');


// Check if POST data is not empty

    $id =  NULL;
    $id_usuario = $_SESSION['id_usuario'];
    // Check if POST variable "name" exists, if not default the value to blank, basically the same for all variables
    $nome_conta = mysqli_real_escape_string($conn, trim($_POST['nome_conta']));;
    $data_conta = mysqli_real_escape_string($conn, trim($_POST['data_conta']));;
    $descricao_conta = mysqli_real_escape_string($conn, trim($_POST['descricao_conta']));;
    $valor_conta = mysqli_real_escape_string($conn, trim($_POST['valor_conta']));;
    $tipo_pagamento = mysqli_real_escape_string($conn, trim($_POST['tipo_pagamento']));;
    
    
    
    // Insert new record into the contacts table
        $sql = "INSERT INTO despesas (`id_despesa`, `usuario_id_usuario`, `nome_conta`, `data_conta`, `descricao_conta`, `valor_conta`, `tipo_pagamento`) VALUES
                                     (NULL, '$id_usuario', '$nome_conta', '$data_conta', '$descricao_conta', '$valor_conta', '$tipo_pagamento')";
        //  $result = mysqli_query($conn, $sql); 


        if ($conn->query($sql) == TRUE) {
            $_SESSION['msg'] = "<p style='color:green;'> Despesa cadastrada com sucesso</p>";
            header('Location: create.php');


        }else{
            $_SESSION['msg'] = "<p style='color:red;'>Despesa não cadastrada </p>";
            header('Location: create.php');

        }


?>
<?php
session_start();
include_once('../../Dependencias/conexao.php');

if(!isset($_SESSION['id_usuario'])){
    header('Location: ../../index.php');
    exit();
}


// Check if POST data is not empty

    
    $id_usuario = 1;
    // Check if POST variable "name" exists, if not default the value to blank, basically the same for all variables
    $id = mysqli_real_escape_string($conn, trim($_POST['id']));;
    $nome_conta = mysqli_real_escape_string($conn, trim($_POST['nome_conta']));;
    $data_conta = mysqli_real_escape_string($conn, trim($_POST['data_conta']));;
    $descricao_conta = mysqli_real_escape_string($conn, trim($_POST['descricao_conta']));;
    $valor_conta = mysqli_real_escape_string($conn, trim($_POST['valor_conta']));;
    $tipo_pagamento = mysqli_real_escape_string($conn, trim($_POST['tipo_pagamento']));;
    
    
    // Insert new record into the contacts table
        $sql = "UPDATE `despesas` SET `nome_conta`='$nome_conta',`data_conta`='$data_conta',
        `descricao_conta`='$descricao_conta',`valor_conta`='$valor_conta',`tipo_pagamento`='$tipo_pagamento' WHERE id_despesa = '$id'";
        //  $result = mysqli_query($conn, $sql); 


        if ($conn->query($sql) == TRUE) {
            $_SESSION['msg'] = "<p style='color:green;'> Despesa atualizada com sucesso</p>";
            header('Location: update.php?id='.$id);


        }else{
            $_SESSION['msg'] = "<p style='color:red;'> Despesa não atualizada</p>";
            header('Location: update.php?id='.$id);

        }


?>
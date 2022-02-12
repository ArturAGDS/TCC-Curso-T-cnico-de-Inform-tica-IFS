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
    $nome_cliente = mysqli_real_escape_string($conn, trim($_POST['nome_cliente']));;
    $nome_empresa = mysqli_real_escape_string($conn, trim($_POST['nome_empresa']));;
    $email = mysqli_real_escape_string($conn, trim($_POST['email']));;
    $end = mysqli_real_escape_string($conn, trim($_POST['endereco']));;
    $cidade = mysqli_real_escape_string($conn, trim($_POST['cidade']));;
    $bairro = mysqli_real_escape_string($conn, trim($_POST['bairro']));;
    $telefone = mysqli_real_escape_string($conn, trim($_POST['telefone']));;
    $cnpj = mysqli_real_escape_string($conn, trim($_POST['cnpj']));;
    $cpf = mysqli_real_escape_string($conn, trim($_POST['cpf']));;
    $insc_estadual = mysqli_real_escape_string($conn, trim($_POST['insc_estadual']));;
    
    /* switch ($com_aux){
        case "1":
            $com=1;
            break;
        case "2":
            $com=0;
            break;
    } */
    // Insert new record into the contacts table
        $sql = "UPDATE `cliente` SET `nome_cliente`='$nome_cliente',`nome_empresa`='$nome_empresa',
        `end_cliente`='$end',`cidade_cliente`='$cidade',`bairro_cliente`='$bairro',`cnpj_cliente`='$cnpj',`cpf_cliente`='$cpf',`insc_estadual`='$insc_estadual',`tel_cliente`='$telefone',`email_cliente`='$email' WHERE id_cliente = '$id'";
        //  $result = mysqli_query($conn, $sql); 


        if ($conn->query($sql) == TRUE) {
            $_SESSION['msg'] = "<p style='color:green;'> Cliente atualizado com sucesso</p>";
            header('Location: update.php?id='.$id);


        }else{
            $_SESSION['msg'] = "<p style='color:red;'>Cliente não atualizado</p>";
            header('Location: update.php?id='.$id);

        }


?>
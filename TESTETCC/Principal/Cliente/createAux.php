<?php
session_start();
include_once('../../Dependencias/conexao.php');
if(!isset($_SESSION['id_usuario'])){
    header('Location: ../../index.php');
    exit();
}

// Check if POST data is not empty

    $id =  NULL;
    $id_usuario = $_SESSION['id_usuario'];
    // Check if POST variable "name" exists, if not default the value to blank, basically the same for all variables
    $nome_cliente = !empty($_POST['nome_cliente']) ?  mysqli_real_escape_string($conn, trim($_POST['nome_cliente'])) : NULL;
    $nome_empresa = !empty($_POST['nome_empresa']) ?  mysqli_real_escape_string($conn, trim($_POST['nome_empresa'])) : NULL;
    $email = mysqli_real_escape_string($conn, trim($_POST['email']));;
    $end = mysqli_real_escape_string($conn, trim($_POST['endereco']));;
    $cidade = mysqli_real_escape_string($conn, trim($_POST['cidade']));;
    $bairro = mysqli_real_escape_string($conn, trim($_POST['bairro']));;
    $telefone = mysqli_real_escape_string($conn, trim($_POST['telefone']));;
    $cnpj = !empty($_POST['cnpj']) ?  mysqli_real_escape_string($conn, trim($_POST['cnpj'])) : NULL;
    $cpf = !empty($_POST['cpf']) ?  mysqli_real_escape_string($conn, trim($_POST['cpf'])) : NULL;
    $insc_estadual = !empty($_POST['insc_estadual']) ?  mysqli_real_escape_string($conn, trim($_POST['insc_estadual'])) : NULL;
    
   
    // Insert new record into the contacts table
        $sql = "INSERT INTO cliente (`id_cliente`, `usuario_id_usuario`, `nome_cliente`, `nome_empresa`, `end_cliente`, `cidade_cliente`, `bairro_cliente`, `cnpj_cliente`, `cpf_cliente`, `insc_estadual`, `tel_cliente`, `email_cliente`, `ativo`) VALUES
                                     (NULL, '$id_usuario', '$nome_cliente', '$nome_empresa', '$end', '$cidade', '$bairro', '$cnpj', '$cpf', '$insc_estadual', '$telefone', '$email', 1)";
        //  $result = mysqli_query($conn, $sql); 


        if ($conn->query($sql) == TRUE) {
            $_SESSION['msg'] = "<p style='color:green;'> Cliente cadastrado com sucesso</p>";
            header('Location: create.php');


        }else{
            $_SESSION['msg'] = "<p style='color:red;'>Cliente não cadastrado</p>";
            header('Location: create.php');

        }


?>
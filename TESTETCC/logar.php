<?php
    session_start();
    include('Dependencias/conexao.php');
    
    
    if(empty($_POST['usuario']) || empty($_POST['senha']) ){
        header('Location : index.php');
        exit();
    }
    
    $usuario = mysqli_real_escape_string($conn, $_POST['usuario']);
    $senha = mysqli_real_escape_string($conn, $_POST['senha']);
    
    $sql = "SELECT * FROM usuario where login = '$usuario';";
    $result = mysqli_query($conn, $sql);
    $usr = $result->fetch_assoc();
    $row = mysqli_num_rows($result);
    $verify = password_verify($senha, $usr['senha']);
    if($verify) {
    $_SESSION['id_usuario'] = $usr['id_usuario'];
    header('Location: Principal/principal.php');
    exit();
    } else{
        $_SESSION['nao_autenticado'] = true;
        header('Location: index.php');
        exit();
    }
?>
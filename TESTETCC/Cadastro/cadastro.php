<?php 
session_start();
include('../Dependencias/conexao.php');


$login =  mysqli_real_escape_string($conn, trim($_POST['login']));;
$senha =  mysqli_real_escape_string($conn, trim($_POST['senha']));
$nome_usuario =  mysqli_real_escape_string($conn, trim($_POST['nome_usuario']));
$senhaCriptografada = password_hash($senha, PASSWORD_DEFAULT);

$sql = "select count(*) as total from usuario where login = '$login'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

if($row['total'] >= 1){
$_SESSION['usuario_existe']=true;
header('Location: cadastrar.php');
exit();
}

$sql = "INSERT INTO usuario (login, senha, nome_usuario) VALUES ('$login', '$senhaCriptografada' , '$nome_usuario')";

if ($conn->query($sql) === TRUE) {
    $_SESSION['status_cadastro'] = true;
}
$conn->close();
header('Location: cadastrar.php');
exit();




?>
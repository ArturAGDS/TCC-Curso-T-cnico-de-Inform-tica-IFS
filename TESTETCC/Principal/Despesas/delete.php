<?php
include_once('../../Dependencias/conexao.php');
session_start();
if(!isset($_SESSION['id_usuario'])){
    header('Location: ../../index.php');
    exit();
}

$msg = '';
// Check that the contact ID exists
if (isset($_GET['id'])) {
    // Select the record that is going to be deleted
    $id = $_GET['id'];
    $sql = "SELECT * FROM despesas WHERE id_despesa = '$id'";
    $result = mysqli_query($conn, $sql);
    $despesa = mysqli_fetch_assoc($result);
    if (!$despesa) {
        exit('Contact doesn\'t exist with that ID!');
    }
    // Make sure the user confirms beore deletion
    if (isset($_GET['confirm'])) {
        if ($_GET['confirm'] == 'yes') {
            // User clicked the "Yes" button, delete record
            $sql = "DELETE FROM despesas WHERE id_despesa = '$id'";
            $result = mysqli_query($conn, $sql);
            $msg = 'Você deletou a despesa';
        } else {
            // User clicked the "No" button, redirect them back to the read page
            header('Location: read.php');
            exit;
        }
    }
} else {
    exit('No ID specified!');
}
?>









<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@200;300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="..\..\Dependencias\estilo.css">
    <link rel="stylesheet" href="..\..\Dependencias\styleCad.css">
   
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">

    <title>KI-BRASA BOA</title>
</head>
<body class="listar">
    <header class="cabecalho">
        <h1>Despesas</h1>
        <h2>Atualizar Despesas</h2>
    </header>
    <nav class="navegacao">
        <a href="read.php" class="vermelho">Voltar</a>
    </nav>
    <main class="principal">
        <div class="conteudo">
        <div class="delete">
            <h2>Deletar despesa #<?=$despesa['id_despesa']?></h2>
            <?php if ($msg): ?>
            <p><?=$msg?></p>
            <?php else: ?>
            <p>Você tem certeza que deseja deletar a despesa #<?=$despesa['id_despesa']?>?</p>
            <div class="yesno">
                <a href="delete.php?id=<?=$despesa['id_despesa']?>&confirm=yes" class="verde">Sim</a>
                <a href="delete.php?id=<?=$despesa['id_despesa']?>&confirm=no" class="vermelho">Não</a>
            </div>
            <?php endif; ?>
        </div>


        </div>
    </main>
    <footer class="rodape">
        KIbrasa boa made by Artur & Wagner © <?= date('Y');?>
    </footer>
</body>
</html>

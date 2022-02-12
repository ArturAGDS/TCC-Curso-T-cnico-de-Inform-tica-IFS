<?php

session_start();
if(!isset($_SESSION['id_usuario'])){
    header('Location: ../index.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@200;300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="..\Dependencias\estilo.css">
    <title>KI-BRASA BOA</title>
</head>
<body>
    <header class="cabecalho">
        <h1>Kibrasa Boa</h1>
        <h2>Menu Principal</h2>
    </header>
    <nav class="navegacao">
        <a href="../logout.php" class="vermelho">Sair</a>
    </nav>
    <main class="principal">
        <div class="conteudo">
           <nav class="modulos">
               <div class="modulo">
                   <h3>Produtos</h3>
                   <ul>
                       <li><a href="Produtos/read.php">Listar</a></li>
                       <li><a href="Produtos/create.php">Cadastrar</a></li>
                       
                   </ul>
               </div>

               <div class="modulo">
                   <h3>Clientes</h3>
                   <ul>
                       <li><a href="Cliente/read.php">Listar</a></li>
                       <li><a href="Cliente/create.php">Cadastrar</a></li>
                       
                   </ul>
               </div>
               <div class="modulo">
                   <h3>Despesas</h3>
                   <ul>
                       <li><a href="Despesas/read.php">Listar</a></li>
                       <li><a href="Despesas/create.php">Cadastrar</a></li>
                       
                   </ul>
               </div>
               <div class="modulo">
                   <h3>Vendas</h3>
                   <ul>
                       <li><a href="Venda/read.php">Listar</a></li>
                       <li><a href="Venda/create.php">Cadastrar</a></li>
                       
                   </ul>
               </div>
             
           </nav> 
        </div>
    </main>
    <footer class="rodape">
        Artur & Wagner © <?= date('Y');?>
    </footer>
</body>
</html>
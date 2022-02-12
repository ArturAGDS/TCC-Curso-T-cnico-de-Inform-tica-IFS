<?php
session_start();
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Dependencias/style-login.css">
    <title>KI-BRASA BOA</title>
</head>
<body>
    <form action="cadastro.php" method="post">
    <div class="login-geral">
        <div class="login-esquerda">
            <h1>Cadastre-se no sistema</h1><br>
            <img src="../imagens/logo-transparente.png" class="imagem" alt="logo">
        </div>
        <div class="login-direita">
            <div class="bloco-login">
                <h1>CADASTRE-SE</h1>
                <?php
    if(isset($_SESSION['status_cadastro'])):
        ?>
        <h4 style="color:green;"> Usuário cadastrado com sucesso!!!</h4>
        <a href="../index.php">Faça Login clicando aqui</a>
        <?php
        
        endif;
        unset($_SESSION['status_cadastro'])
        ?>

<?php
    if(isset($_SESSION['usuario_existe'])):
        ?>
        <h4 style="color:red;"> Usuario ja cadastrado, tente novamente com outro nome de usuario</h4>
        <?php
        
        endif;
        unset($_SESSION['usuario_existe'])
        ?>
                <div class="textfield">
                    <label for="usuario">Usuário</label>
                    <input type="text" name="login" placeholder="Digite seu usuário">
                </div>
                <div class="textfield">
                    <label for="senha">Senha</label>
                    <input type="password" name="senha" placeholder="Digite sua senha">
                </div>
                <div class="textfield">
                    <label for="nome_usuario">Nome do Usuário</label>
                    <input type="text" name="nome_usuario" placeholder="Digite seu nome">
                </div>
                
                <a href="../index.php">Fazer Login</a>
                <button class="btn-login">CADASTRAR</button>
            </div>
        </div>
            
    </div>
    </form> 
</body>
</html>